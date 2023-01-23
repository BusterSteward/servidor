const express = require('express');
const router = express.Router();

const dbConnection = require('../config/dbConnection');
// realizamos una conexión a la base de datos
const connection = dbConnection();

//*********************************************************
//********************** ALTA*************************/
//*********************************************************
router.get('/alta', (req, res) =>
{
    res.render('alta', {titulo: 'Alta'});
});


//*********************************************************
//******************HACER EL ALTA POST ********************/
//*********************************************************
router.post('/alta', async function(req, res)
{
    //La información me llega vía formulario
	//var { nombre,provincia,edad,fecha } = req.body;
	console.log(req.body.nombre);
	console.log(req.body.edad);
	console.log(req.body);	
	try
	{
		if (!req.files) {console.log('no hay fichero')} 
		else
		{	
			// recuperamos información imágenes subidas
			console.log('imagen1:'+req.files.foto1.name);
			console.log('imagen1:'+req.files.foto1.size);
		}

		// imagen-1	
		// OJO: se almacenará en la Base de Datos
		let datos_imagen1=req.files.foto1.data;

		var user =
		{
			// da igual el orden
			// hay que poner los nombre de los campos
			nombre: req.body.nombre,
			provincia : req.body.provincia,
			edad : req.body.edad,
			fecha: req.body.fecha,
			imagen : datos_imagen1			  
		}

		await connection.query('INSERT INTO clientes SET ? ',user, function(error, rows, fields)
		{
			if (error)
			{
				//throw error;
			    console.log('número de error: '+error.errno)
			    console.log('mensaje de error: '+error.sqlMessage)
			}
			else
			{
				console.log("consulta ejecutada");
		        res.redirect('/');
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
