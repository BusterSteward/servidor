const express = require('express');
const router = express.Router();
const bcrypt = require('bcryptjs');


const dbConnection = require('../config/dbConnection');
// realizamos una conexión a la base de datos
const connection = dbConnection();

//************************************************************************************
//*************************INICIO-VENTANA LOGIN***************************************/
//************************************************************************************
router.get('/', (req, res) =>
{
	var message = "";
	
	// preguntar si existe esta variable de sesión que yo creo -> .userId -> se podría llamar .pepito
	if (req.session.userId)
	{
		res.render('entrada',{user:req.session.user.nombre,titulo:'Entrada'});
	}
	else
	{	
		message = "Introduzca datos de acceso:";
		res.render('index',{mensaje: message,titulo: 'Login'});
	}
});
//*************************************************************************
//***************************LOGIN-GET*************************************
//*************************************************************************
router.get('/login', (req, res) =>
{
	// mensaje que puede salir en la ventana de login
	var message = "Introduzca sus datos de acceso:";
	res.render('index',{mensaje: message, titulo: 'Registro'});
});

//************************************************************************************
//**********************************LOGIN-POST***************************************/
//************************************************************************************
router.post('/login', (req, res) =>
{
   var message = "";

   // si quito este if esto funcionaría igual...
   if(req.method == "POST")
   {
		  var name=req.body.user_name
		  var pass= req.body.password
		  
		  var errorc=false;
		 
		 console.log("info:",req.body);
		 
		 // para gestionar contraseñas encriptadas no sería correcto utilizar "username"
		 // sería mejor utilizar "email" o un campo clave
		 
		  var sql="SELECT id, nombre, apellido, user_name, password FROM users WHERE user_name='"+name+"'";                           
		  connection.query(sql, function(err, results)
		  {      
				 console.log('registros devueltos:'+results.length);
				 if(results.length>0)
				 {
						 // comprobamos si la contraseña es válida
						console.log('contraseña base-datos:'+results[0].password);
						if (bcrypt.compareSync(pass,results[0].password))
						{
								// iniciamos una sesión 
								req.session; 
								
								// me creo la variable de sesión .userId 
								req.session.userId = results[0].id;

								// lo demás datos de usuario los metemos en una tabla "req.session.user"
								req.session.user = results[0];

								// este array lo usaremos para almacenar datos de sesión "req.session.datos"
								req.session.datos=new Array(); 
								
								console.log("Cliente-id:"+results[0].id);
								
								// llamada a "/entrada" -> GET
								res.redirect('/entrada');
						}
						else {errorc=true;} 
				 }	else {errorc=true;} 

				if (errorc)
				{
					message = "Credenciales erróneas !!";
					res.render('index',{mensaje: message, titulo: 'Error'});
				}				 
		  });
	}
});

//*************************************************************************
//**************************REGISTRO-GET***********************************
//*************************************************************************
router.get('/registro', (req, res) =>
{
	// mensaje que puede salir en la ventana de login
	var message = "Introduzca sus credenciales...";
	res.render('registro',{mensaje: message, titulo: 'Registro'});
});

//*************************************************************************
//**************************REGISTRO-POST**********************************
//*************************************************************************
//https://www.npmjs.com/package/express-fileupload
router.post('/registro', (req, res) =>
{
   var message = "";
   
   console.log('inicio registro');
   
   // no hace falta -> pero así se detecta el tipo de método
   if(req.method == "POST")
   {
			var algoritmo=bcrypt.genSaltSync(10);
			var password2 = bcrypt.hashSync(req.body.tpassword, algoritmo);
			
			console.log(req.body.tnombre);

			if (!req.files) {console.log('no hay fichero')} 
			else
			{	
				// recuperamos información imágenes subidas
				console.log('imagen1:'+req.files.foto1.name);
				console.log('imagen1:'+req.files.foto1.size);
				console.log('imagen2:'+req.files.foto2.name);
				console.log('imagen2:'+req.files.foto2.size);			
			}

			// imagen-1	
			// OJO: se almacenará en la Base de Datos
			let datos_imagen1=req.files.foto1.data;
			// imagen-2			
			// OJO: se copiará físicamente al disco y se almacenará la ruta en la Base de Datos
			let imagen2=req.files.foto2;
			// copio la imagen en esa carpeta
			// "mv" ubica nuestro archivo en un lugar específico de nuestro servidor
			imagen2.mv('src/public/imagenes_subidas/'+req.files.foto2.name);
			// almaceno la ruta donde está la imegan
			let datos_imagen2='imagenes_subidas/'+req.files.foto2.name;

			var user =
			{
				  // da igual el orden
				  // hay que poner los nombre de los campos
				  nombre: req.body.tnombre,
				  apellido : req.body.tapellido,
				  movil : req.body.tmovil,
				  user_name: req.body.tusuario,
				  password : password2,	
				  imagen1 : datos_imagen1,
				  imagen2:  datos_imagen2				  
			}	  

			// observar la forma de hacer el INSERT->más cómodo
			// var sql = "INSERT INTO users (nombre,apellido,movil,user_name,password) 
			// VALUES ('" + nombre + "','" + apellido + "'," + movil + ",'" +  user_name + "','" password + '",'" +  imagen1 + "','" imagen2 + "')";
		  
		  var query = connection.query('INSERT INTO users SET ?',user, function(err, result)
		  {
			 message = "Bienvenido!! "+user.user_name+" Tu cuenta ha sido creada!!";
			 res.render('registro',{mensaje: message,titulo: 'Registro'});
		  });
   }else {console.log('no entro');} 
});

//*************************************************************************
//***************************ENTRADA-GET**********************************
//*************************************************************************
router.get('/entrada', (req, res) =>
{           
   var user =  req.session.user;
   var userId = req.session.userId;
   console.log('USERid='+userId);
   
   // si no hay sesión iniciada o ha caducado no puedo ir a entrada
   if(userId == null)
   {
      // podríamos re-direccionar también a "/"
	  res.redirect("/login");
      return;
   }

   console.log('Nombre User=',user.nombre);
   res.render('entrada',{user:user.nombre,titulo:'Entrada'});
 });
 
//*************************************************************************
//**************************VERDATOS-GET**********************************
//*************************************************************************
router.get('/verdatos', (req, res) =>
{   
   var userId = req.session.userId;
   // si no hay sesión iniciada o ha caducado no puedo ver los datos
   if(userId == null)
   {
	  // podríamos re-direccionar también a "/"
      res.redirect("/login");
      return;
   }

   var sql="SELECT * FROM users WHERE id='"+userId+"'";          
   connection.query(sql, function(err, result)
   {  
		console.log('info:'+result[0].user_name);
		let la_imagen=result[0].imagen1.toString("base64");  
		res.render('datos_cliente.ejs',{data:result,titulo:'Info',imagenbd:la_imagen});   
   });
 });
 
//*************************************************************************
//****************************LOGOUT-GET**********************************
//*************************************************************************
router.get('/logout', (req, res) =>
{
		// cerramos la sesión
		req.session.destroy(function(err)
		{
			res.redirect("/login");
		});
		// para borrar la cookie
		// no es obligatorio hacerlo, pero si se hace mejor...
		res.clearCookie('session-Id-Nodejs');
});

//*************************************************************************
//***************************METO-GET*************************************
//*************************************************************************
router.get('/meto', (req, res) =>
{
	if(req.session.userId == null)
	{
		// podríamos re-direccionar también a "/"
		res.redirect("/login");
		return;
	}
	else
	{
		res.render('meto',{mensaje: '', titulo: 'Meto'});
	}
});

//*************************************************************************
//*****************************METO-POST**********************************
//*************************************************************************
router.post('/meto', (req, res) =>
{
		var message = "";
		var longitud=0;
		
		if(req.session.userId == null)
		{
			// podríamos re-direccionar también a "/"
			res.redirect("/login");
			return;			
		}
		else
		{
			let producto = { 'articulo':req.body.articulo,'precio' : req.body.precio};

			req.session.datos.push(producto);
			longitud=req.session.datos.length;
			console.log('nº elementos introducidos:',longitud);
			res.redirect("/entrada");
		}	
});
//*************************************************************************
//*****************************LEO-GET*************************************
//*************************************************************************
router.get('/leo', (req, res) =>
{
	if(req.session.userId == null)
	{
			// podríamos re-direccionar también a "/"
			res.redirect("/login");
			return;			
	}
	else
	{
		console.log("ID de la sesión:"+req.sessionID);
		console.log("Valor de la cookie de sesión:"+req.cookies['session-Id-Nodejs']);
		console.log("Vida de la cookie:"+(req.session.cookie.maxAge/600000)+" minutos");
		res.render('leo', {articulos: req.session.datos, elementos:req.session.datos.length, titulo: 'Leo'});
	}	
});
//*************************************************************************
//*************************************************************************

// para exportar las rutas a otros módulos
module.exports = router;

