const express = require('express');
const router = express.Router();

const dbConnection = require('../config/dbConnection');
// realizamos una conexión a la base de datos
const connection = dbConnection();
// ojo!! en algún momento tendremos que cerrar la conexión
// dbConnection.end();	


//***************************************************************************
//***************************************************************************
//***************************************************************************
// API-REST
// POST -> Alta: 1 cliente
//
// observa que el método de acceso a la API es -> "post"
// tenemos que utilizar la librería "curl" 
// curl_setopt ($conexion, CURLOPT_POST, 1)
//***************************************************************************
//***************************************************************************
//***************************************************************************
router.post('/', async function(req, res)
{
    //La información me llega vía PHP
	var { nombre,provincia,edad,fecha,imagen } = req.body;
	
	//console.log(req.body.nombre);
	//console.log(req.body.edad);
	console.log(req.body);	

	try
	{
		// meto los datos binarios en un buffer ->
		// así obligo a que los datos se transformen a binario puro
		// si no lo hago así -> funciona pero no se ve la imagen
		// https://nodejs.org/en/knowledge/advanced/buffers/how-to-use-buffers/
		var auxiliar=new Buffer.from(req.body.imagen, 'base64');
	   
		var user =
		{
			nombre: req.body.nombre,
			provincia : req.body.provincia,
			edad : req.body.edad,
			fecha: req.body.fecha,
			imagen : auxiliar
		}

		await connection.query('INSERT INTO clientes SET ? ',user, function(error, rows, fields)
		{
			if (error)
			{
			    res.json({estado: 'false'});
				console.log('número de error: '+error.errno)
			    console.log('ALTA-mensaje de error: '+error.sqlMessage)
				
			}
			else
			{
		        // esto es lo que nos devolverá el script php "PHP-Alta.php"
				res.json({estado: 'true'});
				console.log("consulta ejecutada");
			}
		});
	}
	catch (error)
	{
		console.error("ALTA-El error producido:\n"+error.message);
		// detenemos el servidor y mostramos error
		process.exit();
	}
	
});	

//***************************************************************************
//***************************************************************************
//***************************************************************************
// API-REST
// GET -> Consulta: 1 cliente
//
// tendríamos que acceder a la API de esta forma:
// $acceso = "http://127.0.0.1:3000/".$el_id
//***************************************************************************
//***************************************************************************
//***************************************************************************
router.get('/:id', async (req, res) =>
{
	var datos;
	const { id } = req.params;  
	var sql="SELECT * FROM clientes WHERE id ="+[id]

	try
	{
		await connection.query(sql,function(error, datos, fields)
			{
				if (error)
				{
					 //throw error;
					 console.log('número de error: '+error.errno)
					 console.log('CONSULTA-mensaje de error: '+error.sqlMessage)
				}
				else
				{
					console.log("consulta ejecutada");
					if (datos.length>0)
					{	
						console.log("Los datos devueltos son:\n",datos);
						var laimagen=datos[0].imagen.toString('base64');
						datos[0].imagen=laimagen;
						
						res.json(datos);
					}
					else
					{
						console.log("Cliente NO encontrado",id);
						res.json({estado: 'false'});
					}
				}
			});	
	}
	catch (error)
	{
			console.error("CONSULTA-El error producido GET 1 Registro:\n"+error.message);
			// detenemos el servidor y mostramos error
			process.exit();
	}	
});  
/********************MODIFICACION********************************************************/ 
router.put('/:id', async (req, res) =>
{
	var datos;
	const { id } = req.params;  
	var sql="UPDATE CLIENTES WHERE id ="+[id];
	console.log("me ha llegado la peticion");
/*
	try
	{
		await connection.query(sql,function(error, datos, fields)
			{
				if (error)
				{
					 //throw error;
					 console.log('número de error: '+error.errno)
					 console.log('CONSULTA-mensaje de error: '+error.sqlMessage)
				}
				else
				{
					console.log("consulta ejecutada");
					if (datos.length>0)
					{	
						console.log("Los datos devueltos son:\n",datos);
						var laimagen=datos[0].imagen.toString('base64');
						datos[0].imagen=laimagen;
						
						res.json(datos);
					}
					else
					{
						console.log("Cliente NO encontrado",id);
						res.json({estado: 'false'});
					}
				}
			});	
	}
	catch (error)
	{
			console.error("CONSULTA-El error producido GET 1 Registro:\n"+error.message);
			// detenemos el servidor y mostramos error
			process.exit();
	}	
	*/
});  

//***************************************************************************
//***************************************************************************
//***************************************************************************
// API-REST
// GET -> Consulta: Todos los clientes
//
// tendríamos que acceder a la API de esta forma:
// $acceso = "http://127.0.0.1:3000/".$criterio
//***************************************************************************
//***************************************************************************
//***************************************************************************
router.get("/listado/:criterio", async (req, res) =>
{
	var datos;
	const { criterio } = req.params;  

	var sql="SELECT * FROM clientes ORDER BY "+[criterio];          
    //var sql="SELECT * FROM clientes";          
	try
	{
		await connection.query(sql,function(error, datos, fields)
			{
				if (error)
				{
					 //throw error;
					 console.log('número de error: '+error.errno)
					 console.log('LISTADO-mensaje de error: '+error.sqlMessage)
				}
				else
				{
					if (datos.length>0)
					{
						console.log("Listado: consulta ejecutada");
						console.log("Los datos devueltos son:\n",datos);
						
						
						var i;
						// codifico cada una de las imágenes devueltas por la consulta a "base64"
						for(i=0; i<datos.length; i++)
						{	
							var laimagen=datos[i].imagen.toString('base64');
							datos[i].imagen=laimagen;
						}
						
						res.json(datos);
					}
					else
					{
						console.log("No hay registros de CLIENTES");
						res.json({estado: 'false'});					
					}	
				}
			});	
	}
	catch (error)
	{
			console.error("LISTADO-El error producido:\n"+error.message);
			// detenemos el servidor y mostramos error
			process.exit();
	}	
});  

//***************************************************************************
//***************************************************************************
//***************************************************************************
// API-REST
// DELETE -> Borrar: 1 cliente
//
// observa que el método de acceso a la API es -> "delete"
// tenemos que utilizar la librería "curl" 
// curl_setopt($conexion, CURLOPT_CUSTOMREQUEST, "DELETE");
//***************************************************************************
//***************************************************************************
//***************************************************************************
// observa que el método de petición es "delete"

router.delete('/:id', async (req, res) =>
{
	const { id } = req.params;  
	console.log('BAJA: '+id); 
	
	var datos;
	var sql="DELETE FROM clientes WHERE id ="+[id]

	try
	{
		await connection.query(sql,function(error, datos, fields)
			{
				if (error)
				{
					 //throw error;
					 console.log('número de error: '+error.errno)
					 console.log('BORRAR-mensaje de error: '+error.sqlMessage)
				}
				else
				{
					console.log("DELETE: consulta ejecutada");
					console.log("Las filas afectadas son:\n",datos.affectedRows);
					
					if (datos.affectedRows>0)
					{	
						console.log("Los datos devueltos son:\n",datos);
						res.json({estado: 'true'});
					}
					else
					{
						console.log("Empleado no encontrado");
						res.json({estado: 'false'});
					}
				}
			});	
	}
	catch (error)
	{
			console.error("BORRAR-El error producido:\n"+error.message);
			// detenemos el servidor y mostramos error
			process.exit();
	}	
});  


// para exportar las rutas a otros módulos
module.exports = router;
