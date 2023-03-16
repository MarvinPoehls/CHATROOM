addOnlineUsers();
socket.emit('userJoined', thisUser, room);

socket.on('userJoined' + room, (user) => {
    addHtmlUser(user);
    userJoinMessage(user);
    scrollDown();
});

socket.on('userLeft' + room, (user) => {
    $('#' + user).remove();
    userLeftMessage(user);
});

socket.on('newOnline' + room, (user) => {
    $('#'+user).attr('class', 'row p-md-2 p-0 bg-dark-blue m-md-2 m-1 rounded justify-content-center border-5 border-bottom border-success');
});

socket.on('newOffline' + room, (user) => {
    $('#'+user).attr('class', 'row p-md-2 p-0 bg-dark-blue m-md-2 m-1 rounded justify-content-center border-5 border-bottom border-danger');
});

window.onbeforeunload = function() {
    socket.emit('userLeft', thisUser, room);
    deleteUserFromDatabase();
}

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
    let fullName = name;
    if (name.length > 15) {
        name = name.substring(0,13) + "..";
    }

    let user = $(
        '<div id="' + fullName + '" class="row p-md-2 p-0 bg-dark-blue m-md-2 m-1 rounded justify-content-center border-5 border-bottom border-success">\n' +
        '   <div class="col-auto">\n ' +
        '       <img src="https://www.linkpicture.com/q/ProfilPictureDark.png" class="d-inline-block rounded-circle img-fluid" height="40" width="40">\n' +
        '   </div>\n' +
        '   <div id="nameDiv" class="col-12 justify-content-center d-block p-0">\n' +
        '       <p id="shortName' + fullName + '" class="text-white text-center responsive-text text-break m-0">' + name + '</p>\n' +
        '       <p id="fullName' + fullName + '" class="text-white text-center responsive-text text-break m-0" style="display: none">' + fullName + '</p>\n' +
        '   </div>\n' +
        '</div>'
    );

    $('#activeUser').append(user);

    if (name !== fullName) {
        $('#' + fullName).hover(function () {
            $('#shortName' + fullName).stop().slideToggle();
            $('#fullName' + fullName).stop().slideToggle();
        });
    }
}

function userJoinMessage(name) {
    let messages = $('#messages');

    if (name.length > 20) {
        name = name.substring(0,18) + "..";
    }

    let joinMessage = $('<div class="row text-center mt-3 p-1">\n' +
        '                   <div class="col d-none d-md-inline-block"></div>\n' +
        '                       <div class="col">\n' +
        '                           <p class="bg-blue text-white d-inline-block p-2 rounded-3">"'+ name +'" ist dem Chat beigetreten</p>\n' +
        '                       </div>\n' +
        '                   <div class="col d-none d-md-inline-block"></div>\n' +
        '                </div>');
    messages.append(joinMessage);
}

function userLeftMessage(name) {
    let messages = $('#messages');

    if (name.length > 20) {
        name = name.substring(0,18) + "..";
    }

    let leftMessage = $('<div class="row text-center mt-3 p-1">\n' +
        '                   <div class="col d-none d-md-inline-block"></div>\n' +
        '                       <div class="col">\n' +
        '                           <p class="bg-blue text-white d-inline-block p-2 rounded-3">"'+ name +'" hat den Chat verlassen</p>\n' +
        '                       </div>\n' +
        '                   <div class="col d-none d-md-inline-block"></div>\n' +
        '                </div>');
    messages.append(leftMessage);
}