//******************************************************************
// Primera aplicación Nodejs-Express -> MODELO-VISTA-CONTROLADOR
//******************************************************************
// importamos la librería "express"
//* antes de importarlo hay que instalarlo
//* npm install --save express
//******************************************************************
// importamos la librería "path"
// Este módulo contiene utilidades para trabajar con rutas de los ficheros físicos en el servidor
// rutas->tanto relativas como absolutas
//* antes de importarlo hay que instalarlo
//* npm install --path
//******************************************************************
// importamos la librería "body-parser"
// "body-parser" extrae toda la parte del cuerpo de una secuencia de solicitud entrante (request) y la expone en req.body
// "bodyParser" es middleware, por tanto:
// se ejecutará antes de que la petición del usuario llegue al servidor
//* antes de importarlo hay que instalarlo
// npm install --save body-parser
//******************************************************************
// importamos la librería "ejs"
// Es el "motor" de plantillas que utilizaremos para crear las "vistas"
// Hay muchos tipos de motores
// He utilizado el motor "ejs" porque es la que más se parece al "html" convencional
//* antes de importarlo hay que instalarlo
// npm install ejs
//******************************************************************


//******************************************************************
// importamos librerías necesarias
//******************************************************************

const path = require('path');
const express = require('express');
const bodyParser = require('body-parser');

// creamos una instancia
// el servidor lo creamos ahora a partir de la librería de "express"
// una vez creada la instancia "app"
// nuestra aplicación será -> "app"
const app = express()
//******************************************************************


//******************************************************************
// configuraciones 
//******************************************************************
// body-parser analiza los datos codificados enviados utilizando la solicitud HTTP POST
//extended: false" -> forma en la que se organizan los datos para su acceso
// https://apuntes.de/nodejs-desarrollo-web/body-parser/#gsc.tab=0
app.use(bodyParser.urlencoded({extended: false}));

// puerto por el que escuchamos
// puede estar configurado en una variable del sistema "process.env.PORT"
// aquí no lo está -> por tanto utilizaremos el puerto 3000
app.set('port', process.env.PORT || 3000);

// motor de plantillas que vamos a utilizar para crear las "vistas"
// npm install ejs
app.set('view engine', 'ejs');

// indicamos la carpeta donde vamos a tener las "vistas"
app.set('views', path.join(__dirname, 'views'));

// le indicamos donde está la carpeta de ficheros estáticos
app.use(express.static(path.join(__dirname, 'public')));

//******************************************************************
// las rutas
//******************************************************************
// aquí tenemos las rutas -> asociadas a nuestra aplicación
app.use(require('./routes/las_rutas'));

//******************************************************************
// iniciamos el servidor
//******************************************************************
app.listen(app.get('port'), () =>
{
   console.log('server iniciado en el puerto: ', app.get('port'));
});