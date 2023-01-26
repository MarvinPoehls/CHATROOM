function addMessage() {
    let textInput = $("#message");
    let text = textInput.val().trim();
    let user = $("#username").val();
    let file = $("#file").val();

    if (text !== "") {
        $.ajax({
            url: "index.php",
            type: "POST",
            data: {controller: "AddMessage", text: text, file: file, user: user},
            success: function(){
                textInput.val("");
                let messages = $('#messages')

                let message = $('<div></div>')
                    .attr("class", "col-12 my-2 p-2");
                messages.append(message);

                let row = $('<div></div>')
                    .attr("class", "row");
                message.append(row);

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
                    .attr("src", "https://picsum.photos/200")
                    .attr("width", 60)
                    .attr("height", 60)
                    .attr("class", "d-inline-block rounded-circle");
                imgCol.append(img);
            }
        });
    }
}