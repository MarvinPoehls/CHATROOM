addOnlineUsers();

socket.emit('userOnline', thisUser, room);

socket.on('newOnline' + room, (user) => {
    addHtmlUser(user);
});

socket.on('newOffline' + room, (user) => {
    $('#' + user).remove();
});

if (window.performance.getEntriesByType('navigation').map((nav) => nav.type).includes('reload')) {

}

document.addEventListener("visibilitychange", function() {
    if (document.visibilityState === 'visible') {
        addUserToDatabase();
        socket.emit('userOnline', thisUser, room);
    } else {
        deleteUserFromDatabase();
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
            console.log(data);
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
        '<div id="' + name + '" class="row p-2 bg-primary m-2 rounded">\n' +
        '<div class="col-auto">\n ' +
        '<img src="https://i.postimg.cc/1XffnWPL/Profil-Picture.png" class="d-inline-block rounded-circle" height="40" width="40">\n' +
        '</div>\n' +
        '<div class="col">\n' +
        '<p class="text-white">' + name + '</p>\n' +
        '</div>\n' +
        '</div>'
    );

    $('#activeUser').append(user);
}