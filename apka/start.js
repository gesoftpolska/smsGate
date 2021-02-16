// var https = require('https');
// var fs = require('fs');
// var io = require('socket.io')(https, {
//
//     serveClient: false,
//     coockie: false,
//     secure:true,
//     reconnect: true,
//     rejectUnauthorized : false
//
//
// });
//
//  var express = require('express-socket.io');
//
//
// var privateKey = fs.readFileSync('../cert/CA-key.key').toString();
// var certificate = fs.readFileSync('../cert/server-cert.crt').toString();
// var ca = fs.readFileSync('../cert/CA-cert.crt').toString();
//
//
//
// var app = https.createServer({key:privateKey,cert:certificate, ca:ca });
// var clients = 0;
// io.sockets.on('connection', function (socket) {
//     clients++;
//
//     console.log(clients + ' clients connected!')
//     io.sockets.emit('broadcast',{ description: clients + ' clients connected!'});
//     socket.on('disconnect', function () {
//         clients--;
//         console.log(clients + ' clients connected!')
//         io.sockets.emit('broadcast',{ description: clients + ' clients connected!'});
//     });
//
//     socket.on('disconnect', function () {
//         clients--;
//         console.log(clients + ' clients connected!')
//         io.sockets.emit('broadcast',{ description: clients + ' clients connected!'});
//     });
//
//     socket.on('message', function (data) {
//         io.sockets.emit('broadcast',{ description: data});
//         console.log(data);
//
//     });
//
//
//
//
// });
// app.listen(5000);
// console.log('Nasłuchuję na porcie 5000');






var fs = require( 'fs' );
var app = require('express')();
var https        = require('https');
var server = https.createServer({
    key: fs.readFileSync('newcerts/wow.ovh.key'),
    cert: fs.readFileSync('newcerts/wow.ovh.crt'),
    ca: fs.readFileSync('newcerts/rootCA.crt'),
    requestCert: false,
    rejectUnauthorized: false,
    secure: true
},app);
server.listen(8080);

var io = require('socket.io').listen(server);

io.sockets.on('connection',function (socket) {

});

app.get("/", function(request, response){

})