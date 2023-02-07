//************************************************************************
// API Rest VERSIÓN v1.0
//************************************************************************
//
// Documentación MÉTODOS http:
// https://diego.com.es/metodos-http
// https://es.wikibooks.org/wiki/M%C3%A9todos_HTTP
//
//************************************************************************

const express = require('express');
const router = express.Router();

const dbConnection = require('../config/dbConnection');
// realizamos una conexión a la base de datos
const connection = dbConnection();
// ojo!! en algún momento tendremos que cerrar la conexión
// dbConnection.end();	

//**********************************************************************************
//**********************************************************************************
//**********************************************************************************
// API-REST
//	GET: CONSULTA -> Todos los Registros
//
// tendríamos que acceder a la API de esta forma:
// $acceso = "http://127.0.0.1:3000/"
//**********************************************************************************
//**********************************************************************************
//**********************************************************************************
router.get('/', async function(req, res)
{
	var datos;
	var sql="SELECT * FROM empleados";          
    
	try
	{
		await connection.query(sql,function(error, datos, fields)
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
					console.log("Los datos devueltos son:\n",datos);
					res.json(datos);
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

//**********************************************************************************
//**********************************************************************************
//**********************************************************************************
// API-REST
//	GET: CONSULTA -> 1 Registro
//
// tendríamos que acceder a la API de esta forma:
// $acceso = "http://127.0.0.1:3000/".$el_id
//**********************************************************************************
//**********************************************************************************
//**********************************************************************************
router.get('/:id', async (req, res) =>
{
	var datos;
	const { id } = req.params;  
	var sql="SELECT * FROM empleados WHERE id ="+[id]

	try
	{
		await connection.query(sql,function(error, datos, fields)
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
					if (datos.length>0)
					{	
						console.log("Los datos devueltos son:\n",datos);
						res.json(datos);
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
			console.error("El error producido:\n"+error.message);
			// detenemos el servidor y mostramos error
			process.exit();
	}	
});  
//**********************************************************************************
//**********************************************************************************
//**********************************************************************************
// API-REST
//	DELETE: BORRAR -> 1 Registro
//
// observa que el método de acceso a la API es -> "delete"
// tenemos que utilizar la librería "curl" 
// curl_setopt($conexion, CURLOPT_CUSTOMREQUEST, "DELETE");
//**********************************************************************************
//**********************************************************************************
//**********************************************************************************
router.delete('/:id', async (req, res) =>
{
	var datos;
	const { id } = req.params;  
	var sql="DELETE FROM empleados WHERE id ="+[id]

	try
	{
		await connection.query(sql,function(error, datos, fields)
			{
				if (error)
				{
					 //throw error;
					 console.log('número de error: '+error.errno)
					 console.log('mensaje de error: '+error.sqlMessage)
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
			console.error("El error producido:\n"+error.message);
			// detenemos el servidor y mostramos error
			process.exit();
	}	
});  

//**********************************************************************************
//**********************************************************************************
//**********************************************************************************
// API-REST
//	POST: ALTA -> 1 Registro
//
// observa que el método de acceso a la API es -> "post"
// tenemos que utilizar la librería "curl" 
// curl_setopt ($conexion, CURLOPT_POST, 1)
//**********************************************************************************
//**********************************************************************************
//**********************************************************************************
// INSERT un empleado con PL's 
// CONFIGURACIÓN PRUEBA:
// 1º -> headers --------> (key->Content-Type) y (value->application/json)
// 2º -> body->raw -----> y le pasamos los parámetros en formato "json"
// de lo contrario no funcionará
//{
//    "id": 0,
//    "nombre": "MARCOS",
//    "salario": 60500
//}

// OJO!! -> ATENCIÓN !! -> la "id" tiene que tener valor 0 -> para que realice un alta
//***************************************************************************
router.post('/', async (req, res) =>
{
	const {id, nombre, salario} = req.body;
	
	console.log("Alta de Empleado: "+id, nombre, salario);
	var sql="CALL empleadoAdd_Edit(?,?,?);"
	
	try
	{
		await connection.query(sql,[id, nombre, salario],function(error, datos, fields)
			{
				if (error)
				{
					 //throw error;
					 console.log('número de error: '+error.errno)
					 console.log('mensaje de error: '+error.sqlMessage)
					 res.json({estado: 'false'});
				}
				else
				{
					res.json({estado: 'true'});
					console.log("INSERT: consulta ejecutada");
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

//**********************************************************************************
//**********************************************************************************
//**********************************************************************************
// API-REST
//	PUT: MODIFICACIÓN -> 1 Registro
// por "get" le paso el "id" (req.params) del cliente que quiero modificar -> 127.0.0.1:3000/24
// por "post" le paso los datos de la modificación (req.body)
//
// observa que el método de acceso a la API es -> "put"
// tenemos que utilizar la librería "curl" 
// curl_setopt($conexion, CURLOPT_CUSTOMREQUEST, "PUT")
//**********************************************************************************
//**********************************************************************************
//**********************************************************************************
//{
//    "nombre": "PEPE2",
//    "salario": 20002
//}

router.put('/:id', async (req, res) =>
{
	 
	 const { id } = req.params;
	 const { nombre, salario } = req.body;

	console.log("Modificación de Empleado: "+id, nombre, salario);
	var sql="CALL empleadoAdd_Edit(?,?,?);";
	
	try
	{
		await connection.query(sql,[id, nombre, salario],function(error, datos, fields)
			{
				if (error)
				{
					 //throw error;
					 console.log('número de error: '+error.errno);
					 console.log('mensaje de error: '+error.sqlMessage);
					 res.json({estado: 'false'});
				}
				else
				{
					res.json({estado: 'true'});
					console.log("UPDATE: consulta ejecutada");
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
//***************************************************************************


//***************************************************************************
// 													EJERCICIO
//***************************************************************************
// INSERT un empleado -> con SQL clásico 
// UPDATE un empleado -> con SQL clásico 
//***************************************************************************


// para exportar las rutas a otros módulos
module.exports = router;
