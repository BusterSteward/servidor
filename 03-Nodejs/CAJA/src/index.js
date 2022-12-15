// importamos la librería "express-fileupload"
//* antes de importarlo hay que instalarlo
//* npm install express-fileupload

//******************************************************************
// importamos librerías necesarias
//******************************************************************
const path = require('path');
const express = require('express');
const bodyParser = require('body-parser');
const fileUpload = require('express-fileupload');

// creamos una instancia
// "app" será nuestra aplicación
const app = express()
//******************************************************************


//******************************************************************
// configuraciones 
//******************************************************************

// puerto por el que escuchamos
app.set('port', process.env.PORT || 3000);

// motor de plantillas
app.set('view engine', 'ejs');

// indicamos la carpeta de las vistas
app.set('views', path.join(__dirname, 'views'));

// ******* middlewares ******************
// body-parser extrae toda la parte del cuerpo de una secuencia de solicitud entrante y la expone en req.body
// body-parser analiza los datos codificados enviados utilizando la solicitud HTTP POST

//extended: false" -> datos normales (cadenas) y (no imágenes por ejemplo)
//extended: true ->precisa que el req.body contendrá valores de cualquier tipo en lugar de solo cadenas.
app.use(bodyParser.urlencoded({extended: false}));

// ****** subir ficheros ******************
// para poder subir ficheros al servidor
app.use(fileUpload());

// le indicamos donde está la carpeta de ficheros estáticos
app.use(express.static(path.join(__dirname, 'public')));

// ******* rutas *************************
// aquí tenemos las rutas -> asociadas a nuestra aplicación
app.use(require('./routes/rutaprincipal'));
app.use(require('./routes/lasrutas_ALTA'));
app.use(require('./routes/lasrutas_CONSULTA'));
app.use(require('./routes/lasrutas_BAJA'));
app.use(require('./routes/lasrutas_LISTADO'));

// iniciamos el servidor
app.listen(app.get('port'), () =>
{
   console.log('server iniciado en el puerto: ', app.get('port'));
});
