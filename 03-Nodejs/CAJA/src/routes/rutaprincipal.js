const express = require('express');
const router = express.Router();

const dbConnection = require('../config/dbConnection');
// realizamos una conexión a la base de datos
const connection = dbConnection();

//*********************************************************
// OJO: si la instrucción "rows.length" te da error -> es porque NO conectas bien con la base de datos
// puede probar este código
/*
connection.connect(function(error)
{
   if(error) {console.log('hay error:'+error.message);}
   else {console.log('Conexion establecida correctamente.');}
});
connection.end();
*/
//*********************************************************

//*********************************************************
//********************** PRINCIPAL*************************/
//*********************************************************
router.get('/', (req, res) =>
{
    res.render('principal', {titulo: 'Principal'});
});



//******************************************************/
// para exportar las rutas a otros módulos
module.exports = router;
//******************************************************/
