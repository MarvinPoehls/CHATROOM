setInterval(checkUsers, 1000);

document.onvisibilitychange = () => {
    if (document.visibilityState === 'hidden') {
        deleteUser();
    }
};

function deleteUser() {
    let username = $('#username').val();
    let room = $('#room').text();

    $.ajax({
        url: "index.php",
        type: "POST",
        data: {controller: "Room", action: "deleteUser", username: username, room: room},
    });
}

function addUser(name) {
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
        data: {controller: 'GetActiveUsers', room: $('#room').text()},
        success: function(data){
            $('#activUser').empty();
            data = JSON.parse(data);
            $.each(data, function (index,name){
                addUser(name)
            });
        }
    });
}