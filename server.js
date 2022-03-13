const express = require('express');

const app = express();

const server = require('http').createServer(app);

const io = require('socket.io')(server,{
    cors: {origin: "*"}
});

io.on('connection',(socket) => {
    console.log('connection');

    socket.on('receiveTask',(task) => {
        console.log(task);
        // io.emit('AddTask',task);
        socket.emit('AddTask',task);
        // socket.broadcast.emit('sendChatToClient',task);
    })

    socket.on('removeTask',(task) => {
        socket.emit('removeTask',task);
        // console.log(task)
    })

    socket.on('disconnect',(socket) => {
        console.log('Disconnect');
    });
});

server.listen(3000,() => {
    console.log('server is running');
});
