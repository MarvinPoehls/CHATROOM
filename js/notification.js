if (Notification.permission === 'granted') {
    $('#bell').addClass('text-primary')
        .click(function () {
            $('#modalText').text('Push Benachrichtigungen sind aktiviert. (Du kannst sie in deinem Browser deaktivieren)');
            $('#modalFooter').empty()
                .append($('<button class="btn btn-primary" data-bs-dismiss="modal">Ok</button>'));
            $('#modal').modal('show');
        });
} else if (Notification.permission === 'denied') {
    $('#bell').attr('class', 'bi bi-bell-slash-fill')
        .addClass('text-danger')
        .click(function () {
            $('#modalText').text('Du musst Benachrichtigungen in deinem Browser aktivieren und die Seite neu laden um Push Benachrichtigungen zu bekommen.');
            $('#modalFooter').empty()
                .append($('<button class="btn btn-primary" data-bs-dismiss="modal">Ok</button>'));
            $('#modal').modal('show');
        });
}

function requestNotificationPermission() {
    Notification.requestPermission().then(status => {
        if (status === 'granted') {
            let options = {
                body: 'Push Benachrichtigungen sind aktiviert.',
                icon: 'https://i.postimg.cc/rwnHZBzV/Chatroom.png',
            };
            new Notification('Chatroom', options);

            $('#bell').addClass('text-primary')
                .click(function () {
                    $('#modalText').text('Push Benachrichtigungen sind aktiviert. (Du kannst sie in deinem Browser deaktivieren)');
                    $('#modalFooter').empty()
                        .append($('<button class="btn btn-primary" data-bs-dismiss="modal">Ok</button>'));
                    $('#modal').modal('show');
                });
        } else {
            $('#bell').attr('class', 'bi bi-bell-slash-fill')
                .addClass('text-danger')
                .click(function () {
                    $('#modalText').text('Du musst Benachrichtigungen in deinem Browser aktivieren und die Seite neu laden um Push Benachrichtigungen zu bekommen.');
                    $('#modalFooter').empty()
                        .append($('<button class="btn btn-primary" data-bs-dismiss="modal">Ok</button>'));
                    $('#modal').modal('show');
                });
        }
    });
}

function sendMessageNotification(text, user, image, time){
    if (document.visibilityState === 'hidden') {
        if (image !== null) {
            text = "[Bild] " + text;
        }

        if (Notification.permission === 'granted') {
            let options = {
                body: text + "\n" + time,
                icon: 'https://i.postimg.cc/1XffnWPL/Profil-Picture.png',
            };
            new Notification(user, options);
        }

    }
}