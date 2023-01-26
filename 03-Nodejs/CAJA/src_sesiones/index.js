// DOCUMENTACIÓN:
// instalar las siguientes librerías:

// gestión de cookies
// npm install cookie-parser

// gestión de sesiones
// npm install express-session

// subida de ficheros
// npm install express-fileupload

// encriptación de claves
// npm install bcryptjs

const cookieParser = require('cookie-parser');
const express = require('express');
const http = require('http');
const path = require('path');
const fileUpload = require('express-fileupload');
const bodyParser=require("body-parser");

//*******************************************************
// OJO -> nosotros estamos utilizando esto
// almacenamos los (DATOS) de la variable de sesión  en el servidor
const session = require('express-session');
//*******************************************************

// también se puede hacer así:
// almacenamos los (DATOS) de la variable de sesión en la cookie
// const session = require('cookie-session');

 // "app" será nuestra aplicación
const app = express();

 // ******* configuraciones ***************
// puerto por el que escuchamos
app.set('port', process.env.PORT || 3000);

// motor de plantillas
app.set('view engine', 'ejs');

// indicamos la carpeta de las vistas
app.set('views', path.join(__dirname, 'views'));
   
 // ******* middlewares ******************
// body-parser extrae toda la parte del cuerpo de una secuencia de solicitud entrante y la expone en req.body
// body-parser analiza los datos codificados enviados utilizando la solicitud HTTP POST
//extended: false" -> forma en la que se organizan los datos para su acceso

app.use(bodyParser.urlencoded({extended: false}));
app.use(bodyParser.json());

// ****** subir ficheros ******************
// para poder subir ficheros al servidor
app.use(fileUpload());

// le indicamos donde está la carpeta de ficheros estáticos
app.use(express.static(path.join(__dirname, 'public')));

// para acceder al contenido de las cookies
app.use(cookieParser());


// para administrar la sesión en la aplicación
// https://github.com/expressjs/session
// hay muchas opciones para configurar (algunas son obligatorias)
// estas son algunas:

// ********saveUninitialized**********
// Cuando un cliente realiza una solicitud HTTP, y esa solicitud no contiene una cookie de sesión,
// se creará una nueva sesión express-session. Crear una nueva sesión hace algunas cosas:

	//->generar una identificación de sesión única en el Servidor
	
	//->almacenar esa identificación de sesión en una "cookie de sesión" (para que se puedan identificar las solicitudes
	// posteriores realizadas por el cliente)
	
	//->crear un objeto de sesión vacío -> req.session
	// dependiendo del valor de saveUninitialized, al final de la solicitud, el objeto de sesión se almacenará en el almacén de sesiones
	
	// true
	// Si durante la vigencia de la solicitud el objeto de la sesión no se modifica, entonces, al final de la solicitud y cuando
	// "saveUninitialized" sea falso -> el objeto de sesión (aún vacío, porque no ha sido modificado) ->
	// "NO" se almacenará	en el almacén de la sesiones.
	// // no utilizamos esto -> pero es obligatorio configurarlo
// ***********resave***************
// true
// lo que esto hace es decirle al almacén de sesiones que una sesión en particular aún está activa,
// lo cual es necesario porque algunos almacenes eliminarán las sesiones inactivas.
// no utilizamos esto -> pero es obligatorio configurarlo

// ***********************************************************************
// almacenar las variables de sesión
// ***********************************************************************
// En cuanto a lugar de almacenamiento->Los valores que se almacenan en la sesión se pueden colocar en diferentes lugares:
// en la memoria de la aplicación, en la memoria caché, la base de datos, en las cookies, en un fichero... etc
// https://dustinpfister.github.io/2018/06/01/express-session/
// ***********************************************************************
// en esta versión las almacenamos en la sesión del servidor
// ***********************************************************************

app.use(session(
{
	  // requerido
	  // texto aleatorio para encriptar con un algoritmo los datos enviados al cliente
	  // es la clave utilizada para firmar la cookie de ID de sesión.
	  secret: 'keyboard cat',
	  
	  // explicado arriba -> obligatorio
	  // true
	  // Guarda una sesión que es nueva pero que no ha sido modificada
	  // la sesión activa -> aunque no se haga nada -> no se borra
	  saveUninitialized: false,
	  
	  // explicado arriba -> obligatorio
	  // Forzar guardado de sesión para cada solicitud
	  // varios inicios de sesión por el mismo cliente -> no lo utilizamos
	  resave: false,
	  
	  // este será el nombre de la cookie que se creará en el cliente
	  name : 'session-Id-Nodejs',
	  
	  // 1 minuto de vida, valor expresado en milisegundos 60000
	  // ponemos 10 minutos de vida
	  cookie: { maxAge: 600000 }
	  // OJO: si no pongo nada -> la cookie morirá al cerrar el navegador
}))
 


 // ******* rutas ************************
// aquí tenemos las rutas de nuestra aplicación
app.use(require('./routes/las_rutas'));
 
 
// lanzamos el servidor
app.listen(app.get('port'), () =>
{
  console.log('server iniciado en el puerto: ', app.get('port'));
});

