let usernameInput = $('#username');
let roomInput = $('#roomInput');

roomInput.on( "keypress", function (e) {
    if(e.which === 13 && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
    }
});

function checkCreate() {
    let username = removeHtml(usernameInput.val().trim());
    let room = removeHtml(roomInput.val().trim());

    if (room !== "" && username !== "") {
        $.ajax({
            url: 'index.php',
            type: 'POST',
            data: {controller: 'Chatroom', action: 'isDuplicate', room: room},
            success: function (data) {
                if (data === "false") {
                    window.location.href = "index.php?controller=CreateRoom&room=" + room + "&username=" + username;
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
    let username = removeHtml(usernameInput.val().trim());
    let room = removeHtml(roomInput.val().trim());

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
    let username = removeHtml(usernameInput.val().trim());

    if (username !== "") {
        window.location.href = "index.php?controller=Room&room=" + room + "&username=" + username;
    } else {
        $('#errorText').text('Bitte wähle zuerst ein Name.');
        $('#modal').modal('show');
    }
}

function removeHtml(text) {
    text = $.parseHTML(text);
    return $(text).text();
}
