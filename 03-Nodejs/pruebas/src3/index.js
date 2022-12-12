// para arrancar el servidor->tenemos que ejecutar index.js
// ojo: acceder a localhost:8000 y ver la respuesta del servidor

// a partir de esta librería "NET" crearemos un servidor
// DOCUMENTACIÓN: https://nodejs.org/api/net.html
//import net from 'net'
const net = require('net');

// el método ".createServer" recibe como parámetro una función llamada "socket"
const server = net.createServer(socket =>
{
  // esperaremos un evento "data" que sea recibir información
  // cuando recibamos un dato lo que haremos será visualizarlo por consola
  socket.on('data', data =>
  {
		console.log(data.toString())
		// y contestaremos con un mensaje
		// socket.write('Soy PePe, aquí estoy...!!')
		// podemos contestar enviando también el dato recibido
		// socket.write(`Dato recibido: ${data} \n Soy PePe, aquí estoy...!!`)
		socket.write("Dato recibido: "+data+" \n Soy PePe, aquí estoy...!!")
  })
})

// si se produce un error informaremos de ello
// escucharemos un evento 'error'
server.on('error', err =>
{
  throw err
})

// hemos creado el servidor pero no lo hemos arrancado
// arrancamos el servidor 
server.listen(
  {
    //host: 'localhost',
    // para que los alumnos me puedan enviar cosas
    host: '10.18.100.54',
    port: 8000,
    // Si exclusivo es falso (predeterminado), el clúster trabajará utilizando el mismo controlador subyacente,
    // lo que permitirá compartir las tareas de manejo de la conexión.
    // Cuando exclusivo es verdadero, el identificador no se comparte y el intento de compartir el puerto da como resultado un error.
    exclusive: true
  },
  () => console.log('Servidor arrancado y escuchando-socket abierto en: ',server.address())
)
