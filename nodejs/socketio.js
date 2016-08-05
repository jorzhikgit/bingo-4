var app       =     require("express")();
var http      =     require('http').Server(app);
var io        =     require("socket.io")(http);

exports.start = function () {
    io.on('connection',function(socket){  
        console.log("A user is connected");

        socket.on('process', function (res) {
            socket.broadcast.emit('update preview', res);
        });

        socket.on('recall add', function (res) {
            socket.broadcast.emit('update recall add', res);
        });

        socket.on('recall remove', function (res) {
            socket.broadcast.emit('update recall remove', res);
        });
    });

    http.listen(3000,function(){
        console.log("Listening on 3000");
    });
};
    