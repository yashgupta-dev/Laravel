var https = require('https');
var fs = require('fs');
//var siofu = require('socketio-file-upload');

var options_https = {
    key: fs.readFileSync('image/server_files/key_file/server.key', 'utf8'),
    cert: fs.readFileSync('image/server_files/certificate_file/server.crt', 'utf8'),
    ca: fs.readFileSync('image/server_files/bundle_files/server.ca-bundle'),
    requestCert: true,
    rejectUnauthorized: false
};

var server = https.createServer(options_https, function(req, res) {
    res.writeHead(200, { 'Content-Type': 'text/plain' });
    res.end('okay');
});

var io = require('socket.io')(server);

var roomUsers = {};

//Listen for connection
io.on('connection', function(socket) {
    //Listens for new user
    socket.on('newUserConneted', function(details) {

        if (details.sender === 'admin') {
            var index = details.sender + '_' + details.userUniqueId;
            roomUsers[index] = socket.id;

        } else if (details.sender === 'customer') {
            var index = details.sender + '_' + details.sender_id;
            roomUsers[index] = socket.id;
        }

        roomUsers[index] = socket.id;
        socket.emit('onReplyRecieved', details);
    });


    /**
     * [customer will send the message to admin this function will work]
     * @param  {[type]} data){                 if(typeof(data) ! [description]
     * @return {[type]}         [description]
     */
    socket.on('newCustomerMessageSumbit', function(data) {
        if (typeof(data) !== 'undefined') {
            Object.keys(roomUsers).forEach(function(key, value) {
                if (key === 'admin_' + data.receiver_id) {
                    receiverSocketId = roomUsers[key];
                    socket.broadcast.to(receiverSocketId).emit('onAdminRecieved', data);
                }
            });
        }
    })

    socket.on('newAdminMessageSumbit', function(data) {
        if (typeof(data) !== 'undefined') {
            Object.keys(roomUsers).forEach(function(key, value) {
                if (key === 'customer_' + data.receiver_id) {
                    receiverSocketId = roomUsers[key];
                    socket.broadcast.to(receiverSocketId).emit('onCustomerRecieved', data);
                }
            });
        }
    })

    socket.on('adminBlockCustomer', function(data) {
        if (typeof(data) !== 'undefined') {
            Object.keys(roomUsers).forEach(function(key, value) {
                if (key === 'customer_' + data.customer_unique_id) {
                    customerSocketId = roomUsers[key];
                    socket.broadcast.to(customerSocketId).emit('onCustomerBlock', data);
                }
            });
        }
    })

    socket.on('chat_StatusUpdate', function(data) {
        if (typeof(data) !== 'undefined') {
            Object.keys(roomUsers).forEach(function(key, value) {
                if (key === data.receiver_id + '_' + data.receiver_unique_id) {
                    receiverSocketId = roomUsers[key];
                    socket.broadcast.to(receiverSocketId).emit('statusUpdateReceived', data);
                }
            });
        }
    })

    // customer/seller login notification to others(added)
    socket.on('login_notification', function(data, chat_status, sender_unique_id, type) {
        if (typeof(data) !== 'undefined' && typeof(chat_status) !== 'undefined' && sender_unique_id) {
            Object.keys(roomUsers).forEach(function(key, value) {
                var getIndex = data.indexOf(key);
                if (getIndex > -1) {
                    receiverSocketId = roomUsers[key];
                    var send_data = [];
                    send_data = { 'receiver_unique_id': key, 'sender_unique_id': sender_unique_id, 'sender_chat_status': chat_status[getIndex], login_type: type };
                    socket.broadcast.to(receiverSocketId).emit('login_notification_received', send_data);
                }
            });
        }
    })
});

server.listen(8446);