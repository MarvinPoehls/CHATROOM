let messages = $('#messageCount').val();
let thisUser = $('#username').val();
setInterval(checkMessages, 1000);

function checkMessages() {
    let room = $('#room').text();

    $.ajax({
        url: "index.php",
        type: "POST",
        data: {controller:'Message', action:'countMessages', room: room},
        success: function(newMessages){
            let file = $('#room').text() + ".csv";

            while (newMessages > messages) {
                messages++;
                $.ajax({
                    url: "index.php",
                    type: "POST",
                    data: {controller: 'Message', action: 'getRow', row: messages, file: file},
                    success: function(data){
                        data = JSON.parse(data);
                        if (data[1] !== thisUser) {
                            addHtmlMessage(data[0], data[1]);
                        }
                    }
                });
            }
        }
    });
}

function addHtmlMessage(text, user) {
    let messages = $('#messages');

    let message = $('<div></div>')
        .attr("class", "col-12 my-2 p-2");
    messages.append(message);

    let row = $('<div></div>')
        .attr("class", "row");
    message.append(row);

    if (user !== thisUser) {
        let imgCol = $('<div></div>')
            .attr('class', 'col-1');
        row.append(imgCol);

        let img = $('<img>')
            .attr("src", "https://www.senertec.de/wp-content/uploads/2020/04/blank-profile-picture-973460_1280-600x600.png")
            .attr("width", 60)
            .attr("height", 60)
            .attr("class", "d-inline-block rounded-circle");
        imgCol.append(img);

        let textCol = $("<div></div>")
            .attr("class", "col");
        row.append(textCol);

        let textDiv = $("<div></div>")
            .attr("class", "bg-primary text-white rounded-3 d-inline-block p-3 pb-0");
        textCol.append(textDiv);

        let header = $('<p></p>')
            .text(user)
            .attr('class','fw-bold mb-1');
        textDiv.append(header);

        let textParagraph = $("<p></p>")
            .html(text);
        textDiv.append(textParagraph);

        playNotificationSound();
    } else {
        let textCol = $("<div></div>")
            .attr("class", "col text-end");
        row.append(textCol);

        let textDiv = $("<div></div>")
            .attr("class", "bg-light rounded-3 d-inline-block p-3 pb-0");
        textCol.append(textDiv);

        let textParagraph = $("<p></p>")
            .html(text);
        textDiv.append(textParagraph);

        let imgCol = $('<div></div>')
            .attr('class', 'col-1 text-end');
        row.append(imgCol);

        let img = $('<img>')
            .attr("src", "https://www.senertec.de/wp-content/uploads/2020/04/blank-profile-picture-973460_1280-600x600.png")
            .attr("width", 60)
            .attr("height", 60)
            .attr("class", "d-inline-block rounded-circle");
        imgCol.append(img);
    }
}

function playNotificationSound() {
    let audio = new Audio('audio/message.mp3');
    let option = $('#notificationOption').find(":selected").val();

    console.log(option);
    switch (option) {
        case "activ":
            audio.play();
            break;
        case "inactiv":
            break;
        case "background":
            if (document.visibilityState === "hidden") {
                audio.play();
            }
            break;
        default:
            audio.play();
    }
}

function addMessage() {
    let textInput = $("#message");
    let text = textInput.val().trim();
    let file = $("#file").val();

    if (text !== "") {
        $.ajax({
            url: "index.php",
            type: "POST",
            data: {controller: "Message", action:'addMessage', text: text, file: file, user: username},
            success: function(){
                $("#message").val("");
                addHtmlMessage(text, username);
            }
        });
    }
}