// instalar este módulo con: npm install --save mysql
// Paquete necesario para conectar a bases de datos MySQL
var mysql = require('mysql');

// Consultas SQL
var sql1 = "INSERT INTO tablanode (nombre,edad) values ('PEPITO',26)";
var sql2 = "SELECT * FROM tablanode";

// Parámetros de conexión a la base de datos.
var conexion = mysql.createConnection(
{
  host: "127.0.0.1",
  user: "jorge",
  password: "666666",
  database : "nodejs"
});
 
// Funcion que nos devolverá resultados de la base de datos.
conexion.connect(function(err,mensaje)
{
			  if (err) console.log('el error es:',err.message);
			  console.log("Conectados con MySQL:\n\n",mensaje);
			  
			  // insertamos un registro nuevo
			  // podemos apreciar en este ejemplo que al ejecutar una query
			  // se está creando una promesa
			  conexion.query(sql1, function (err, resultado)
			  {
					if (err) console.log('el error sql-1 es:',err.message);
					//if (err) throw err; 
					console.log("\n");
					console.log('*********** hacemos el ALTA: **************************\n',resultado);
					console.log("\n");
			  })

			  // listamos todos los registros de la base de datos
			  conexion.query(sql2, function (err, resultado,campos)
			  {
					//if (err) throw err;
					if (err) console.log('el error sql-2 es:',err.message);

					// listamos la información obtenida en el callback
					// console.log('hacemos el listado-1:\n',resultado);
					// console.log('hacemos el listado-2:\n',campos);
					console.log("\n");
					console.log('*********** hacemos el listado: *************************\n');
					
					// Bucle que recore los resultados y pinta en consola.
					let i=0;
					for(i=0; i<resultado.length; i++)
					{
						console.log("Registro(" + resultado[i].id+")");
						console.log(resultado[i].nombre);
						console.log(resultado[i].edad+"\n\n");
					}
					
					console.log("\n");
					console.log('************* listamos CAMPOS Base de Datos: *************************\n');					
					// información auxiliar->los campos obtenidos en el callback
					
					for(i=0; i<campos.length; i++)
					{
						console.log(campos[i]);
					}
			  });
			// ahora hacemos esto para que comprobemos por consola que no hay esperas
			// este mensaje es lo 1º que aparecerá en la consola
			console.log("\n");
			console.log('************ahora hago esto***************');
			console.log('************ahora hago esto***************');

  // cerramos la conexión
  conexion.end();
});


