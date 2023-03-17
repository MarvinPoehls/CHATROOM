cleanRandomChats();

function cleanRandomChats() {
    let maxLenght = 20;

    $('#randomChats').children('button').each(function () {
        if ($(this).text().length > maxLenght) {
            $(this).attr('title', $(this).text());
            $(this).html($(this).html().substring(0, maxLenght) + '..');
            $(this).attr('data-bs-toggle', "tooltip")
        }
    });
}

function reloadRandomChats() {
    $.ajax({
        url: "index.php",
        type: "POST",
        data: {controller: 'Chatroom', action: 'getRandomRoomsJson'},
        success: function(data){
            let header = $('<h2 id="randomChatsTitle" class="border-bottom m-2 pb-2">Zufällige Chatrooms<button class="btn float-end" onClick="reloadRandomChats();"><i class="bi bi-arrow-clockwise text-secondary"></i></button></h2>');
            $('#randomChats').empty().append(header);
            $.each(JSON.parse(data), function (i, room) {
                let roomString = "'" + room + "'";
                let randomRoom = $('<button id="'+ room +'" class="p-2 m-2 btn btn-outline-light text-secondary" onclick="checkUsername(' + roomString +')"><h3>'+ room +'</h3></button>');
                $('#randomChats').append(randomRoom);
                cleanRandomChats();
            });
        }
    });
}