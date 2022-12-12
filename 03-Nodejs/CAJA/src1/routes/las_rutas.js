const express = require('express');
const router = express.Router();

const dbConnection = require('../config/dbConnection');
// realizamos una conexión a la base de datos
const connection = dbConnection();

//*******************************************************************
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
//******************************************************************************


//*********************************************************
//****************controlador: PRINCIPAL********************/
//*********************************************************
router.get('/', (req, res) =>
{
    res.render('principal', {titulo: 'principal'});
});

//*********************************************************
//***************controlador: LISTADO***********************/
//*********************************************************
router.get('/listado', async function(req, res)
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

//*********************************************************
//***************controlador: SALUDO***********************/
//*********************************************************
router.get('/saludo', async function(req, res)
{
	try
	{
		console.log('estoy en Saludo');
		res.render('saludo', {titulo: 'saludo'});
	}
	catch (error)
	{
			console.error("El error producido:\n"+error.message);
			// detenemos el servidor y mostramos error
			process.exit();
	}
});	

//*********************************************************
//***************controlador: CONSULTA***********************/
//*********************************************************
router.get('/consulta', async function(req,res)
{
	
	res.render('consulta', {titulo: 'Consulta'});
	
});

//*********************************************************
//******************HACER LA CONSULTA POST ***************/
//*********************************************************
router.post('/consulta', async function(req, res)
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
				res.render('hacer_consulta', {datos: rows,titulo: 'Datos'});
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
//********************************************
//*********CONTROLADOR BORRAR***************** 
//********************************************

router.get('/borrar', async function(req,res)
{
	
	res.render('borrar', {titulo: 'Borrar'});
	
});

router.post('/borrar', async function(req,res){
	console.log("la id="+req.body.id);
	try
	{  
       
		await connection.query ('DELETE FROM CLIENTES WHERE id ='+req.body.id, function(error, rows, fields)
		{
			
			
			if (rows.affectedRows>0)
			{
				res.render('mensaje_exito', {titulo2:"borrar",titulo:"Exito",id:req.body.id});
			}
			else
		    {
			    res.render('mensaje_error', {mensaje:'No existe el código del cliente introducido',titulo: 'Error',titulo2:'borrar',titulo3:'id ='+req.body.id});
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
//********************************************
// para exportar las rutas a otros módulos
module.exports = router;
//********************************************
