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
		database: 'login_nodejs'
  });
}
