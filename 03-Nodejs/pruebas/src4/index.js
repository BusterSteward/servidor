//********************************************************
// una vez ejecutado este script y poder probarlo
// conectarse con el navegador a la dirección http://localhost:8000
//********************************************************

// importamos el módulo a través del cual crearemos el servidor
// import http from "http"
// sistema de ficheros
// import fs from "fs"

const http = require('http');
const fs = require('fs');



//const file = `./src/index.html`
const file = `./src/texto1.txt`

// creamos el servidor, el cual recibe una función
// esta función recibe una "petición" y devuelve una "respuesta"
const server = http.createServer((request, response) =>
{
	  // MIRAR EN CONSOLA
	  console.log("la ip que me está enviando una solicitud:\n",request.connection.remoteAddress)
	  
	  // configuro la cabecera
	  response.writeHead(200, { 'Content-Type': 'text/html; charset=UTF-8' })
	  
	  // podremos detectar los métodos de acceso.... "GET" - "POST" - "PUT" - "DELETE"
	  // lo utilizaremos en nuestras páginas web
	  // método "POST"
	  if (request.method === 'POST')
	  {
			response.write('<h1>Accediendo con un MÉTODO POST no permitido</h1>')
			return response.end()
	  }
	  // método "GET"
	  else
	  {	  
		  // cuando recibo una solicitud
		  // leemos el fichero texto1.txt 
		  // leemos index.html
		  fs.readFile(file, (err, content) =>
		  {
			   if (err)
			   {
				  return console.log(err)
			   }
				
			   // MIRAR EN EL NAVEGADOR
			   response.write(content)

			   return response.end()
		  })
	  }
})

// para red hay que ponerlo así
server.listen(8000, '10.18.100.44', err =>
//server.listen(8000, 'localhost', err =>
{
  if (err)
  {
    return console.log('Error: ', err)
  }

  console.log('Server abierto y escuchando en http://localhost:8000')
 })
