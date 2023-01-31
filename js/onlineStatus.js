setInterval(checkUsers, 1000);
let members = [];
let room = $('#room').text();
let username = $('#username').val().trim();

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

function addHtmlUser(name) {
    let user = $('<div></div>')
        .attr('class', 'row bg-white p-2 m-2 rounded')
        .attr('id', name);
    $('#activUser').append(user);

    let imgCol = $('<div></div>')
        .attr('class', 'col-3');
    user.append(imgCol);

    let img = $('<img>')
        .attr('src', 'https://www.senertec.de/wp-content/uploads/2020/04/blank-profile-picture-973460_1280-600x600.png')
        .attr('width', '40')
        .attr('height', '40')
        .attr('class', 'd-inline-block rounded-circle');
    imgCol.append(img);

    let nameCol = $('<div></div>')
        .attr('class', 'col');
    user.append(nameCol);

    let nameParagraph = $('<p></p>')
        .html(name);
    nameCol.append(nameParagraph);
}

function checkUsers() {
    $.ajax({
        url: "index.php",
        type: "POST",
        data: {controller: 'UserController', action: 'getActive', room: room},
        success: function(newActiveUser){
            newActiveUser = JSON.parse(newActiveUser);
            $('#activUser').empty();

            newActiveUser.forEach(function (newActiveUser) {
                addHtmlUser(newActiveUser);
            });
        }
    });
}