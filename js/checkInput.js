function checkCreate() {
    let text = $("#createInput").val();

    $.ajax({
        url: 'index.php',
        type: 'POST',
        data: {controller: 'Chatroom', action: 'isDuplicate', room: text},
        success: function (data) {
            if (data === "false") {
                window.location.href = "index.php?controller=CreateRoom&room=" + text;
            } else {
                $('#errorText').text('Der Name "' + text + '" ist schon vergeben.');
                $('#modal').modal('show');
            }
        }
    });
}

function checkLoad() {
    let text = $('#loadInput').val();

    $.ajax({
        url: 'index.php',
        type: 'POST',
        data: {controller: 'Chatroom', action: 'isDuplicate', room: text},
        success: function (data) {
            if (data === "true") {
                window.location.href = "index.php?controller=Room&room=" + text;
            } else {
                $('#errorText').text('Es exestiert kein Chatroom mit dem Name "' + text + '".');
                $('#modal').modal('show');
            }
        }
    });
}
