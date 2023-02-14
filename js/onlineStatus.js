let room = $('#room').text();
let username = $('#username').val().trim();
let activeUsers = [];

setInterval(checkUsers, 1000);

if (window.performance.getEntriesByType('navigation').map((nav) => nav.type).includes('reload')) {
    addUser();
}

document.addEventListener("visibilitychange", function() {
    if (document.visibilityState === 'visible') {
        addUser();
    } else {
        deleteUser();
    }
});

function deleteUser() {
    $.ajax({
        url: "index.php",
        type: "POST",
        data: {controller: "UserController", action: 'delete', username: username, room: room},
    });
}

function addUser() {
    $.ajax({
        url: "index.php",
        type: "POST",
        data: {controller: "UserController", action: 'add', username: username, room: room},
    });
}

function checkUsers() {
    $.ajax({
        url: "index.php",
        type: "POST",
        data: {controller: 'UserController', action: 'getActive', room: room},
        success: function(newActiveUsers){
            newActiveUsers = JSON.parse(newActiveUsers);

            let deleteUser = activeUsers.filter(x => !newActiveUsers.includes(x));
            let addUser = newActiveUsers.filter(x => !activeUsers.includes(x));

            $.each(deleteUser, function (i, element) {
                if (element !== "") {
                    $('#' + element).remove();
                    activeUsers = removeFromArray(activeUsers, element);
                }
            });

            $.each(addUser, function (i, element) {
                if (element !== "") {
                    addHtmlUser(element);
                    activeUsers.push(username);
                }
            });

            activeUsers = newActiveUsers;
        }
    });
}

function removeFromArray(arr, value) {
    let i = 0;
    while (i < arr.length) {
        if (arr[i] === value) {
            arr.splice(i, 1);
        } else {
            ++i;
        }
    }
    return arr;
}

function addHtmlUser(name) {
    let user = $(
        '<div id="' + name + '" class="row bg-white p-2 m-2 rounded">\n' +
            '<div class="col-auto">\n ' +
                '<img src="https://i.postimg.cc/1XffnWPL/Profil-Picture.png" class="d-inline-block rounded-circle" height="40" width="40">\n' +
            '</div>\n' +
            '<div class="col">\n' +
                '<p>' + name + '</p>\n' +
            '</div>\n' +
        '</div>'
    );

    $('#activeUser').append(user);
}