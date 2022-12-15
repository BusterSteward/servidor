const express = require('express');
const router = express.Router();

const dbConnection = require('../config/dbConnection');
// realizamos una conexión a la base de datos
const connection = dbConnection();

//*********************************************************
//************************LISTADO*************************/
//*********************************************************
router.get('/listados', async function(req, res)
{
	try
	{
		await connection.query('SELECT * FROM clientes', function(error, rows, fields)
		{
			console.log('filas afectadas: ', rows.length);
			res.render('listado', {datos: rows,titulo: 'listado'});
		});
	}
	catch (error)
	{
		console.error("El error producido:\n"+error.message);
		// detenemos el servidor y mostramos error
		process.exit();
	}
});

//******************************************************/
// para exportar las rutas a otros módulos
module.exports = router;
//******************************************************/
