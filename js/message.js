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
                            addHtmlMessage(data[0], data[1], data[2]);
                        }
                    }
                });
            }
        }
    });
}

function addHtmlMessage(text, user, image = false) {
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

        if (image) {
            let picture = $('<img>')
                .attr('src', image)
                .attr('width', '200')
                .attr('class','mb-2');
            textDiv.append(picture);
        }

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

        if (image) {
            let picture = $('<img>')
                .attr('src', image)
                .attr('width', '200')
                .attr('class','mb-2');
            textDiv.append(picture);
        }

        let textParagraph = $("<p></p>")
            .attr('class', 'text-start')
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
    let image = $('#imageInput').prop('files')[0];
    if (image != null) {
        let reader = new FileReader();
        reader.readAsDataURL(image);
        reader.onload = function () {
            image = reader.result;
            $.ajax({
                url: "index.php",
                type: "POST",
                data: {controller: "Message", action:'addMessage', text: text, image: image, file: file, user: username},
                success: function(){
                    textInput.val("");
                    clearImageInput();
                    addHtmlMessage(text, username, image);
                }
            });
        };
    } else {
        if (text !== "") {
            $.ajax({
                url: "index.php",
                type: "POST",
                data: {controller: "Message", action:'addMessage', text: text, image: image, file: file, user: username},
                success: function(){
                    textInput.val("");
                    clearImageInput();
                    addHtmlMessage(text, username, image);
                }
            });
        }
    }
}

function clearImageInput() {
    let imageInput = $('#imageInput');
    imageInput.val('');
    $('#inputIcon').attr('class', 'bi bi-paperclip');
    $('#inputLabel').attr('for', 'imageInput');
    $('#buttonCol').attr('class', 'col-2');
    $('#imageInputCol').attr('class', 'col d-none');
}

function imageInput() {
    let image = $('#imageInput').val();
    image = image.replace(/^.*\\/, "");

    if (image !== "") {
        $('#inputIcon').attr('class', 'bi bi-x');
        $('#inputLabel').attr('for', 'deleteInput');
        $('#buttonCol').attr('class', 'col-4');
        $('#imageInputCol').attr('class', 'col');
        $('#fileName').val(image);
    }
}