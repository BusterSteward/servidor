//************************************************************************
// API Rest VERSIÓN v2.0
//************************************************************************

// importamos librería
const express = require('express');
// declaramos constante a partir de la cual crearemos el servidor
const app = express();

// ***** Middlewares *****
app.use(express.json());

// ***** Routes *****
// le decimos donde están las rutas de nuestra aplicación
app.use(require('./routes/clientes'));

// PUERTO por el que escucho
app.set('port', process.env.PORT || 3000);

// arrancar el servidor
app.listen(app.get('port'), () =>
{
  console.log('server iniciado en el puerto: ', app.get('port'));
});
