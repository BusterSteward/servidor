// configuramos la conexión
const mysql = require('mysql');

// exportamos la conexión
module.exports = () =>
{
  return mysql.createConnection(
  {
		host: 'localhost',
		user: 'jorge',
		password: '666666',
		database: 'API_nodejs_V1'
  });
}