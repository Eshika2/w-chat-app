const express = require('express');

const app = express();

// app.use(express.static('public'));

// const expressServer = app.listen(3000);

const server = require('http').createServer(app);

const io = require('socket.io')(server, {
    cors: {
        origin: '*',
    }
});

io.on('connection', (socket) => {
    console.log('A user connected');
    socket.on('disconnect', () => {
        console.log('user disconnected');
    });

    socket.on('messageFromClientToServer', (message) => {
        console.log(message);
        
        io.emit('messageFromServerToClient', message);
        // io.sockets.emit('messageFromServerToClient', message);
        // socket.broadcast.emit('messageFromServerToClient', message); // broadcast to all clients except the one that sent the message
    });
});

server.listen(3000, () => {
    console.log('Server is running on port 3000');
});