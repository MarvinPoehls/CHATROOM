let room = $('#room').text();
let thisUser = $('#username').val();
let textInput = $("#message");
let host = document.location.host;
const socket = io('ws://' + host + ':8080');
let messageDiv = $('#messages');
scrollDown();

socket.on('messageTo' + room, (text, username, image, time) => {
    text = CryptoJS.AES.decrypt(text, $('#encryption').val()).toString(CryptoJS.enc.Utf8);
    addHtmlMessage(text, username, time, image);
    sendMessageNotification(text, username, image, time);
    scrollDown();
});

textInput.on( "keypress", function (e) {
    if(e.which === 13 && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
    }
});

function sendMessage() {
    let text = prepareText(textInput.val());
    let file = $("#room").text() + '.csv';
    let image = $('#imageInput').prop('files')[0];
    let date = new Date();
    let time = date.getHours() + ":" + date.getMinutes();

    if (image != null) {
        let reader = new FileReader();
        reader.readAsDataURL(image);
        reader.onload = function () {
            image = reader.result;

            addMessageToChatlog(text, image, file, time);
            socket.emit('messageToServer', text, thisUser, image, room, time);
            scrollDown();
        };
    } else if (text !== "") {
        addMessageToChatlog(text, image, file, time);
        socket.emit('messageToServer', text, thisUser, image, room, time);
        scrollDown();
    }
}

function prepareText(text) {
    text = text.trim();
    text = $.parseHTML(text);
    text = $(text).text();

    if (text === "") {
        return text;
    }

    text = text.replace(/\n/g, '<br>');

    let password = $('#encryption').val();
    text = CryptoJS.AES.encrypt(text, password).toString();

    return text;
}

function addMessageToChatlog(text, image, file, time) {
    $.ajax({
        url: "index.php",
        type: "POST",
        data: {controller: "Message", action:'addMessage', text: text, image: image, file: file, user: thisUser, time: time},
        success: function () {
            clearInputs();
        }
    });
}

function addHtmlMessage(text, user, time, image = false) {
    if (user === thisUser) {
        let gap = $('<div></div>')
            .attr("class", "col-1 col-md-3");
        messageDiv.append(gap);
    }

    let message = $('<div></div>')
        .attr("class", "col-11 col-md-9 my-2 p-2");
    messageDiv.append(message);

    if (user !== thisUser) {
        let gap = $('<div></div>')
            .attr("class", "col-3");
        messageDiv.append(gap);
    }

    let row = $('<div></div>')
        .attr("class", "row flex-nowrap");
    message.append(row);

    if (user !== thisUser) {
        let imgCol = $('<div></div>')
            .attr('class', 'col-auto');
        row.append(imgCol);

        let img = $('<img>')
            .attr("src", "https://www.linkpicture.com/q/ProfilPictureDark.png")
            .attr("width", 60)
            .attr("height", 60)
            .attr("class", "img-fluid rounded-circle");
        imgCol.append(img);

        let textCol = $("<div></div>")
            .attr("class", "col");
        row.append(textCol);

        let textDiv = $("<div></div>")
            .attr("class", "bg-primary text-white rounded-3 d-inline-block p-2");
        textCol.append(textDiv);

        let header = $('<p></p>')
            .text(user)
            .attr('class','fw-bold mb-1');
        textDiv.append(header);

        if (image) {
            let picture = $('<img>')
                .attr('src', image)
                .attr('width', '200')
                .attr('class','img-fluid rounded');
            textDiv.append(picture);
        }

        if (text !== "") {
            let textParagraph = $("<p></p>")
                .attr('class', 'text-break mb-0')
                .html(text);
            textDiv.append(textParagraph);
        }

        let dateParagraph = $('<p class="m-0 float-end">'+ time +'</p>');
        textDiv.append(dateParagraph);

        playNotificationSound();
    } else {
        let textCol = $("<div></div>")
            .attr("class", "col text-end");
        row.append(textCol);

        let textDiv = $("<div></div>")
            .attr("class", "bg-light rounded-3 d-inline-block p-2");
        textCol.append(textDiv);

        if (image) {
            let picture = $('<img>')
                .attr('src', image)
                .attr('width', '200')
                .attr('class','img-fluid rounded');
            textDiv.append(picture);
        }

        if (text !== "") {
            let textParagraph = $("<p></p>")
                .attr('class', 'text-start mb-0')
                .html(text);
            textDiv.append(textParagraph);
        }

        let dateParagraph = $('<p class="text-muted m-0 float-start">'+ time +'</p>');
        textDiv.append(dateParagraph);

        let imgCol = $('<div></div>')
            .attr('class', 'col-auto text-end');
        row.append(imgCol);

        let img = $('<img>')
            .attr("src", "https://www.linkpicture.com/q/ProfilPictureDark.png")
            .attr("width", 60)
            .attr("height", 60)
            .attr("class", "d-inline-block rounded-circle");
        imgCol.append(img);
    }
}

function clearInputs(clearText = true) {
    if (clearText) {
        textInput.val("");
    }

    let imageInput = $('#imageInput');
    imageInput.val('');
    $('#textCol').attr('class', 'col');
    $('#inputIcon').attr('class', 'bi bi-paperclip text-white');
    $('#inputLabel').attr('for', 'imageInput');
    $('#buttonCol').attr('class', 'col-auto float-end');
    $('#imageInputCol').attr('class', 'col d-none');
}

function imageInput() {
    let image = $('#imageInput').val();
    image = image.replace(/^.*\\/, "");

    if (image !== "") {
        $('#textCol').attr('class', 'col-7 col-sm-10');
        $('#inputIcon').attr('class', 'bi bi-x text-white');
        $('#inputLabel').attr('for', 'deleteInput');
        $('#buttonCol').attr('class', 'col float-end p-0');
        $('#imageInputCol').attr('class', 'col d-block')
        $('#fileName').val(image);
    }
}

function scrollDown() {
    messageDiv.animate({scrollTop: 1000000});
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