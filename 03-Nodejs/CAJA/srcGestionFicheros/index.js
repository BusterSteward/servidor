// DOCUMENTACIÓN:
// instalar las siguientes librerías:

const express = require('express');
const http = require('http');
const path = require('path');
const bodyParser=require("body-parser");
const fileUpload = require('express-fileupload');

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


 // ******* rutas ************************
// aquí tenemos las rutas de nuestra aplicación
app.use(require('./routes/las_rutas'));
 
 
// lanzamos el servidor
app.listen(app.get('port'), () =>
{
  console.log('server iniciado en el puerto: ', app.get('port'));
});

