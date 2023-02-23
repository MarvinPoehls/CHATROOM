const http = require('http').createServer();
const io = require('socket.io')(http, {
    cors: {origin: "*"}
});

io.on('connection', (socket) => {
    console.log('User "'+ socket.id +'" connected.');

    socket.on('disconnect', () => {
        console.log('User "'+ socket.id +'" disconnected.');
    });

    socket.on('messageToServer', (text, username, image, room, time) => {
        io.emit('messageTo' + room, text, username, image, time);
    });

    socket.on('userOnline', (user, room) => {
        io.emit('newOnline' + room, user);
    });

    socket.on('userOffline', (user, room) => {
        io.emit('newOffline' + room, user);
    });
});

http.listen(8080, () => console.log('listening on http://localhost:8080'));