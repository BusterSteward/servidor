const express = require('express');
const router = express.Router();

const dbConnection = require('../config/dbConnection');
// realizamos una conexión a la base de datos
const connection = dbConnection();

// esta modificación es -> la modificación del menú general
//*********************************************************
//********************** MODIFICACION*************************/
//*********************************************************
router.get('/modificacion', (req, res) =>
{
    res.render('modificacion', {titulo: 'Modificar'});
});

// esta modificación es -> la modificación del menú general
//*********************************************************
//******************HACER LA MODIFICACION POST ************/
//*********************************************************
router.post('/modificacion', async(req, res) =>
{
	try
	{  
        //La información me llega vía formulario
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
			  	res.render('hacer_modificacion', {datos: rows,titulo: 'Modificar',imagenbd:la_imagen});
			}
			else
		    {
			    res.render('mensaje_error',{mensaje:'No existe el código del cliente introducido',
				titulo: 'Error',titulo2:'modificacion',titulo3:'id ='+req.body.id});
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

// esta modificación es -> la modificación del menú general
// esta modificación es -> la modificación del "botón modificar" de listados
// El "POST" -> es común a las 2 modificaciones
//*********************************************************
//******************HACER LA MODIFICACION-2 POST **********/
//*********************************************************
router.post('/modificacion2', async(req, res) =>
{
    let hayfoto=true;
	
	try
    {
		// el usuario NO ha cambiado la imagen	
		if (!req.files) {console.log('no hay fichero');hayfoto=false;} 
		else
		{
			// el usuario ha cambiado la imagen	
			// recuperamos información imágenes subidas
			console.log('imagen1:'+req.files.foto1.name);
			console.log('imagen1:'+req.files.foto1.size);

		}
		console.log("fecha: "+req.body.fecha);
		
		if (hayfoto)
		{
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
		}
		else
		{
			var user =
					{
						// da igual el orden
						// hay que poner los nombre de los campos
						nombre: req.body.nombre,
						provincia : req.body.provincia,
						edad : req.body.edad,
						fecha: req.body.fecha
					}
		}
		await connection.query('UPDATE clientes SET ? WHERE id ='+req.body.id,
		user, function(error, rows, fields)
		{
			console.log('filas afectadas: ', rows.affectedRows);
			console.log('Información ROWS: ', rows);
			if (rows.affectedRows>0)
			{
				res.render('mensaje_exito',{mensaje:'Cliente modificado satisfactoriamente',
				titulo: 'Éxito',titulo2:'modificacion',titulo3:'id ='+req.body.id});
			}
			else
			{
				res.render('mensaje_error',{mensaje:'El cliente no se ha podido modificar',
				titulo: 'Error',titulo2:'modificacion',titulo3:'id ='+req.body.id});
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

// esta modificación es -> la modificación del "botón modificar" de listados
//********************************************************
//*************HACER LA MODIFICACIÓN-2-GET****************/
//******************ruta parametrizable*********************/
//********************************************************
router.get("/modificacion2/:id",async(req,res)=>{
	const { id } = req.params; 
	console.log(id);
	console.log(req.params.id);
	try
  	{
		await connection.query('SELECT * FROM clientes WHERE id = ?', [id], function(error, rows, fields)
		{
			//console.log('La información es: ', rows);
			// no avisamos con "mesaje de éxito" -> se podría avisar
			if (rows.length>0)
			{
				let la_imagen=rows[0].imagen.toString("base64");
			  	res.render('hacer_modificacion2', {datos: rows,titulo: 'Modificar',imagenbd:la_imagen});
			}
			else
		    {
			    res.render('mensaje_error',{mensaje:'No existe el código del cliente introducido',
				titulo: 'Error',titulo2:'modificacion',titulo3:'id ='+req.body.id});
			}
			res.render('modificacion2');
		});    		
	}
	catch (error)
	{
		console.error("El error producido:\n"+error.message);
		// detenemos el servidor y mostramos error
		process.exit();
	}
})

//******************************************************/
// para exportar las rutas a otros módulos
module.exports = router;
//******************************************************/
