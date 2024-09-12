const express = require('express');
const http = require('http');
const { Server } = require('socket.io');

const app = express();
const server = http.createServer(app);
const io = new Server(server, {
    cors: {
        origin: '*', // Adjust this in production
        methods: ['GET', 'POST'],
    }
});

app.use(express.json());

io.on('connection', (socket) => {
    console.log('A user connected:', socket.id);

    socket.on('join', (userId) => {
        socket.join(userId); // Join the room with the user's ID
        console.log(`User ${userId} joined room ${userId} with socket ID ${socket.id}`);
    });

    socket.on('disconnect', () => {
        console.log('A user disconnected:', socket.id);
    });
});

app.post('/emitLogout', express.json(), (req, res) => {
    const { userId } = req.body;
    console.log(`Logout request received for user: ${userId}`);

    if (userId) {
        io.emit('force-logout', { userId });
        res.sendStatus(200);
    } else {
        console.log('User ID not provided for logout.');
        res.sendStatus(404);
    }
});

server.listen(3001, () => {
    console.log('Socket.IO server running on http://localhost:3001');
});
