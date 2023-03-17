let usernameInput = $('#username');
let roomInput = $('#roomInput');

roomInput.on( "keypress", function (e) {
    if(e.which === 13 && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
    }
});

function checkCreate() {
    const username = removeHarmfulChars(usernameInput.val().trim());
    const room = removeHarmfulChars(roomInput.val().trim());
    const privacy = $('#private').is(':checked');

    if (room !== "" && username !== "") {
        $.ajax({
            url: 'index.php',
            type: 'POST',
            data: {controller: 'Chatroom', action: 'isDuplicate', room: room},
            success: function (data) {
                if (data === "false") {
                    window.location.href = "index.php?controller=CreateRoom&room=" + room + "&username=" + username + "&privacy=" + privacy;
                } else {
                    $('#errorText').text('Der Name "' + room + '" ist schon vergeben.');
                    $('#modal').modal('show');
                }
            }
        });
    } else {
        $('#errorText').text('Bitte fülle alle Felder aus.');
        $('#modal').modal('show');
    }
}

function checkLoad() {
    const username = removeHarmfulChars(usernameInput.val().trim());
    const room = removeHarmfulChars(roomInput.val().trim());

    if (room !== "" && username !== "") {
        $.ajax({
            url: 'index.php',
            type: 'POST',
            data: {controller: 'Chatroom', action: 'isDuplicate', room: room},
            success: function (data) {
                if (data === "true") {
                    window.location.href = "index.php?controller=Room&room=" + room + "&username=" + username;
                } else {
                    $('#errorText').text('Es existiert kein Chatroom mit dem Name "' + room + '".');
                    $('#modal').modal('show');
                }
            }
        });
    } else {
        $('#errorText').text('Bitte wähle ein Name und ein Chatroom.');
        $('#modal').modal('show');
    }
}

function checkUsername(room) {
    const username = removeHarmfulChars(usernameInput.val().trim());

    if (username !== "") {
        window.location.href = "index.php?controller=Room&room=" + room + "&username=" + username;
    } else {
        $('#errorText').text('Bitte wähle zuerst ein Name.');
        $('#modal').modal('show');
    }
}

function removeHarmfulChars(str) {
    const excludedChars = ['_', '-'];
    const regex = new RegExp(`[^a-zA-Z0-9${excludedChars.join('\\')}\s]`, 'g');
    return str.replace(regex, '').trim();
}

function toggleOptions() {
    $('#privacyCheck').slideToggle();
}
