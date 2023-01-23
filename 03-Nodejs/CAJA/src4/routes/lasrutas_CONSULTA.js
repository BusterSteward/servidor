const express = require('express');
const router = express.Router();

const dbConnection = require('../config/dbConnection');
// realizamos una conexión a la base de datos
const connection = dbConnection();

//*********************************************************
//********************** CONSULTA*************************/
//*********************************************************
router.get('/consulta', (req, res) =>
{
    res.render('consulta', {titulo: 'Consulta'});
});

//*********************************************************
//******************HACER LA CONSULTA POST ***************/
//*********************************************************
router.post('/consulta', async(req, res) =>
{
	console.log("la id="+req.body.id);
	try
	{  
        //La información me llega vía formulario
		// pepe(); //para provocar un error
		await connection.query ('SELECT * FROM clientes WHERE id ='+req.body.id, function(error, rows, fields)
		{
			//podemos visualizar en consola todo esto
			console.log(rows.length);
			console.log(req.body.id);
			console.log('La información es: ', rows);
			//console.log('La información es: ', fields);
			
			if (rows.length>0)
			{
				let la_imagen=rows[0].imagen.toString("base64");  
			  	res.render('hacer_consulta', {datos: rows,titulo: 'Datos',imagenbd:la_imagen});
			}
			else
		    {
			    res.render('mensaje_error',{mensaje:'No existe el código del cliente introducido',
				titulo: 'Error',titulo2:'consulta',titulo3:'id ='+req.body.id});
			}
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
