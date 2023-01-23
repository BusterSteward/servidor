const express = require('express');
const router = express.Router();

const dbConnection = require('../config/dbConnection');
// realizamos una conexión a la base de datos
const connection = dbConnection();

//*********************************************************
//********************** BAJA*************************/
//*********************************************************
router.get('/baja', (req, res) =>
{
    res.render('baja', {titulo: 'Baja'});
});

//*********************************************************
//******************CONFIRMAR LA BAJA POST ***************/
//*********************************************************
router.post('/confirmar_baja', async(req, res) =>
{
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
			  	res.render('confirmar_baja', {datos: rows,titulo: 'Confirmacion Baja',imagenbd:la_imagen});
			}
			else
		    {
			    res.render('mensaje_error',{mensaje:'No existe el código del cliente introducido',
				titulo: 'Error',titulo2:'baja',titulo3:'id ='+req.body.id});
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

//*********************************************************
//******************HACER LA BAJA POST ********************/
//*********************************************************
router.post('/baja', async function(req, res)
{
	try
	{
		//La información me llega vía formulario
		await connection.query('DELETE FROM clientes WHERE id = '+req.body.id, function(error, rows, fields)
		{
			//console.log('La información es: ', rows);
			if(rows.affectedRows>0)
			{
				console.log("consulta ejecutada");
				res.render('mensaje_exito',{mensaje:'Cliente borrado corectamente',
				titulo: 'Exito',titulo2:'baja',titulo3:'id ='+req.body.id});
			}/*
			else
		    {
			    res.render('mensaje_error',{mensaje:'No existe el código del cliente introducido',
				titulo: 'Error',titulo2:'baja'});
			}*/
		});
	}
	catch (error)
	{
		console.error("El error producido:\n"+error.message);
		// detenemos el servidor y mostramos error
		process.exit();
	}
});

// esta baja es -> la baja del "botón baja" de listados
//*********************************************************
//********************HACER LA BAJA-GET*******************/
//********************ruta parametrizable*******************/
//*********************************************************
router.get("/baja/:id", async(req, res) =>
{
	// el id viene vía GET
	const { id } = req.params; 
	console.log(id);
	console.log(req.params.id);
  
  	try
  	{
		await connection.query('DELETE FROM clientes WHERE id = ?', [id], function(error, rows, fields)
		{
			//console.log('La información es: ', rows);
			// no avisamos con "mesaje de éxito" -> se podría avisar
			res.redirect('/listados');
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