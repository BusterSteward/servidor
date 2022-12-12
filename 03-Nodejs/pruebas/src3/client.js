// el cliente queremos que se conecte al servidor que hemos creado
//import net from "net"
const net = require('net');
// creamos el socket
const socket = net.Socket()

// configuramos el socket (puerto y dirección)
//socket.connect(8000, 'localhost')
// la ip del profe
socket.connect(8000,'10.18.100.44')

// enviamos un mensaje
socket.write('Hola soy Andres, estás ahí??')

// cuando nuestro socket reciba un dato
// cuando se produzca el evento "data"
// mostraremos dicha información por la consola 
socket.on('data', data => console.log(data.toString()))
