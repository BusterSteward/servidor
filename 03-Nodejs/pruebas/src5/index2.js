// instalar este módulo con: npm install --save mysql
// Paquete necesario para conectar a bases de datos MySQL
// import { createConnection } from 'mysql';
var mysql = require('mysql');

// Consultas SQL
var sql1 = "INSERT INTO tablanode (nombre,edad) values ('PEPITO',26)";
var sql2 = "SELECT * FROM tablanode";
var sql3 = "SELECT * FROM tablanode WHERE id='2'";


//****************************************************
//****************************************************

function ejecuto_sql(consulta)
{
  const promise = new Promise(function (resolve, reject)
  {
	  
		var conexion = mysql.createConnection(
		{
		  host: "127.0.0.1",
		  user: "jorge",
		  password: "666666",
		  database : "nodejs"
		});
		
	
		conexion.connect(function(error,mensaje)
		{
			if (error)
			{
				reject(new Error('No se ha realizado la conexión!!'))
			} 
			else
			{
				console.log("Ejecuto: ",consulta,"\n\n");
				resolve(conexion.query(consulta, function (err, resultado) {} ));
				conexion.end();
			}		 
				
		});
  });
  return promise;
};

//****************************************************
//****************************************************

async function ejecuto_consulta(query)
// la llamada a ejecuto_sql la realizo desde una función porque para
// poder utilizar "await" me hace falta una función con "async"
{
	try
	{
		await ejecuto_sql(query);
	}	
	catch(error)
	{
		console.log(error.message);
	}
}

//****************************************************
//****************************************************

ejecuto_consulta(sql1)
console.log('ahora hago esto-1');
console.log('ahora hago esto-2');
console.log('ahora hago esto-3');
ejecuto_consulta(sql2)
console.log('ahora hago esto-4');
console.log('ahora hago esto-5');
console.log('ahora hago esto-6');
ejecuto_consulta(sql3)
console.log('ahora hago esto-7');
console.log('ahora hago esto-8');
console.log('ahora hago esto-9\n');

