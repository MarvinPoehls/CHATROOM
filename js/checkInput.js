function checkCreate() {
    let text = $("#roomInput").val().trim();
    let username = $('#username').val().trim();

    if (text !== "" && username !== "") {
        $.ajax({
            url: 'index.php',
            type: 'POST',
            data: {controller: 'Chatroom', action: 'isDuplicate', room: text},
            success: function (data) {
                if (data === "false") {
                    window.location.href = "index.php?controller=CreateRoom&room=" + text + "&username=" + username;
                } else {
                    $('#errorText').text('Der Name "' + text + '" ist schon vergeben.');
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
    let text = $('#roomInput').val().trim();
    let username = $('#username').val().trim();

    if (text !== "" && username !== "") {
        $.ajax({
            url: 'index.php',
            type: 'POST',
            data: {controller: 'Chatroom', action: 'isDuplicate', room: text},
            success: function (data) {
                if (data === "true") {
                    window.location.href = "index.php?controller=Room&room=" + text + "&username=" + username;
                } else {
                    $('#errorText').text('Es exestiert kein Chatroom mit dem Name "' + text + '".');
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
    let username = $('#username').val().trim()
    if (username !== "") {
        window.location.href = "index.php?controller=Room&room=" + room + "&username=" + username;
    } else {
        $('#errorText').text('Bitte wähle zuerst ein Name.');
        $('#modal').modal('show');
    }
}
