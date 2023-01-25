function addMessage() {
    let textInput = $("#message");
    let text = textInput.val();
    let file = $("#file").val();

    $.ajax({
        url: "index.php",
        type: "POST",
        data: {controller: "AddMessage", text: text, file: file},
        success: function(){
            textInput.val("");
            let messages = $('#messages')

            let message = $('<div></div>')
                .attr("class", "col-12 my-2 p-2");
            messages.append(message);

            let row = $('<div></div>')
                .attr("class", "row");
            message.append(row);

            let imgCol = $('<div></div>')
                .attr('class', 'col-1');
            row.append(imgCol);

            let img = $('<img>')
                .attr("src", "https://picsum.photos/200")
                .attr("width", 60)
                .attr("height", 60)
                .attr("class", "d-inline-block rounded-circle");
            imgCol.append(img);

            let textCol = $("<div></div>")
                .attr("class", "col");
            row.append(textCol);

            let textDiv = $("<div></div>")
                .attr("class", "bg-primary rounded-3 text-white d-inline-block p-3 pb-0");
            textCol.append(textDiv);

            let name = $("<p></p>")
                .html("Name")
                .attr("class", "fw-bold mb-1");
            textDiv.append(name);

            let textParagraph = $("<p></p>")
                .html(text);
            textDiv.append(textParagraph);
        }
    });
}