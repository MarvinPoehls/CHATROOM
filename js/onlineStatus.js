addOnlineUsers();
addUserToDatabase();
socket.emit('userOnline', thisUser, room);

socket.on('newOnline' + room, (user) => {
    addHtmlUser(user);
});

socket.on('newOffline' + room, (user) => {
    $('#' + user).remove();
});

$( window ).on('unload', function() {
    if (!window.performance.getEntriesByType('navigation').map((nav) => nav.type).includes('reload')) {
        deleteUserFromDatabase();
    }
});

document.addEventListener("visibilitychange", function() {
    if (document.visibilityState === 'visible') {
        socket.emit('userOnline', thisUser, room);
    } else {
        socket.emit('userOffline', thisUser, room);
    }
});

function deleteUserFromDatabase() {
    $.ajax({
        url: "index.php",
        type: "POST",
        data: {controller: "UserController", action: 'delete', username: thisUser, room: room},
    });
}

function addUserToDatabase() {
    $.ajax({
        url: "index.php",
        type: "POST",
        data: {controller: "UserController", action: 'add', username: thisUser, room: room},
    });
}

function addOnlineUsers() {
    let users = [];

    $.ajax({
        url: "index.php",
        type: "POST",
        data: {controller: "UserController", action: 'getActive', room: room},
        success: function (data) {
            data = JSON.parse(data);
            if (data[0] !== "") {
                $.each(data, function (i, user) {
                    if (user !== thisUser) {
                        addHtmlUser(user);
                    }
                });
            }
        }
    });

    return users;
}

function addHtmlUser(name) {
    let user = $(
        '<div id="' + name + '" class="row p-md-2 p-0 bg-dark-blue m-md-2 m-1 rounded justify-content-center">\n' +
        '<div class="col-auto">\n ' +
        '<img src="https://www.linkpicture.com/q/ProfilPictureDark.png" class="d-inline-block rounded-circle img-fluid" height="40" width="40">\n' +
        '</div>\n' +
        '<div class="col-12 justify-content-center d-block p-0">\n' +
        '<p class="text-white text-center responsive-text m-0">' + name + '</p>\n' +
        '</div>\n' +
        '</div>'
    );

    $('#activeUser').append(user);
}