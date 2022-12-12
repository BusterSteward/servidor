// instalar este módulo con:
// npm install --save sequelize
// npm install --save mysql2

// OJO: con este módulo "sequelize" también se pueden ejecutar consultas SQL clásicas 

// Paquete necesario para conectar a bases de datos MySQL u otras
const Sequelize = require('sequelize')

// creamos instancia y nos conectamos
const sequelize = new Sequelize('nodejs', 'jorge', '666666',
{
  host: '127.0.0.1',
  //dialect: 'mysql'|'sqlite'|'postgres'|'mssql',
  dialect: 'mysql',
})

// comprobamos el estado de la conexion
console.log('CONEXION\n');
sequelize.authenticate()
  .then(() =>
  {
    console.log("Conectados con MySQL!!!!\n\n")
  })
  .catch(err =>
  {
    console.log('No se conecto!!')
  })

 // definimos el modelo de datos con el que vamos a trabajar
 // tipos de datos y otras cosas
 // https://sequelize.readthedocs.io/en/2.0/docs/models-definition/
  const tablanode = sequelize.define(
  'tablanode',
  {
    id: {
      type: Sequelize.INTEGER,
      autoIncrement: true,
      field: 'id',
      primaryKey: true
    },
    nombre: {
      type: Sequelize.STRING,
      field: 'nombre'
    },
    edad: {
      type: Sequelize.INTEGER,
      field: 'edad'
    }
  },
  {
    // el nombre del modelo será el mismo que el nombre de la tabla
	freezeTableName: true
  }
)
 
//**************** EJEMPLO-1
// también en este módulo podremos utilizar consultas clásicas SQL
// o "utilizar el modelado orientado a objetos" al ejecutar consultas

console.log('**************EJEMPLO-1 -> realizamos alta en base de datos **************\n');
sequelize.query("INSERT INTO tablanode (nombre,edad) values ('kkkkkk',45)")
 
 
//**************** EJEMPLO-2 
// ya podemos ejecutar consultas
// https://sequelize.readthedocs.io/en/latest/docs/querying/
// SELECT * FROM tablanode
tablanode.findAll({ attributes: ['id', 'nombre', 'edad'] })
  .then(datos =>
  {
      //probar esto también
      //console.log(JSON.stringify(datos));
      //console.log(datos);
      
      // Bucle que recore los resultados y pinta en consola.
      let i=0;
      console.log('**************EJEMPLO-2**************\n');
      for(i=0; i<datos.length; i++)
      {
          console.log("Registro(" + datos[i].id+")");
          console.log(datos[i].nombre);
          console.log(datos[i].edad+"\n\n");
      }
  })
  .catch(err =>
  {
		console.log('Error de Base de Datos: '+err)
  })

 
 //**************** EJEMPLO-3
// ya podemos ejecutar consultas
// https://sequelize.readthedocs.io/en/latest/docs/querying/
// SELECT * FROM tablanode WHERE id=3
tablanode.findAll({ attributes: ['id', 'nombre', 'edad'], where: {'id': 3}
     })
  .then(datos1 =>
  {
		//probar esto también
		//console.log(JSON.stringify(datos1));
		//console.log(datos1);
		console.log('**************EJEMPLO-3**************\n');
		console.log("Registro-uno(" + datos1[0].id+")");
		console.log(datos1[0].nombre);
		console.log(datos1[0].edad+"\n\n");
  })
  .catch(err =>
  {
		console.log('Error de Base de Datos: '+err)
  })



