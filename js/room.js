cleanTitle();

function cleanTitle() {
    let room = $('#room');

    if (room.text().length > 15) {
        room.attr('title', room.text());
        room.text(room.text().substring(0, 15) + '..');
        room.attr('data-bs-toggle', "tooltip");
    }
}