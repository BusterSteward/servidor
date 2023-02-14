const express = require('express');
const router = express.Router();
const fs = require('fs');
const path = require('path');

//*************************************************************************
//*******************************INICIO*************************************
//*************************************************************************
router.get('/', (req, res) =>
{
		res.render('entrada',{titulo:'Ficheros'});
});

//*************************************************************************
//***************************SUBIR FICHEROS-GET****************************
//*************************************************************************
router.get('/subir', (req, res) =>
{
		// esta es la carpeta donde se tienen que copiar los ficheros
		let carpeta = 'ficheros_subidos';
		res.render('subir',{lacarpeta: carpeta, mensaje: '', titulo: 'Subir ficheros'});
});


//*************************************************************************
//***************************SUBIR FICHEROS-POST***************************
//*************************************************************************
router.post('/subir', (req, res) =>
{

			// definimos la carpeta donde se tienen que copiar los ficheros
			let carpeta = 'ficheros_subidos';

			// hemos seleccionado 1 fichero solamente
			if(req.files.objetofile1.length==undefined)
			{
				req.files.objetofile1.mv('src/public/'+carpeta+'/'+req.files.objetofile1.name);	
			}
			else
			// hemos seleccionado varios ficheros
			{
				for(let f of req.files.objetofile1)
				{
					f.mv('src/public/'+carpeta+'/'+f.name);
				}
			}

			 res.render('subir',{lacarpeta: carpeta, mensaje: 'Subida exitosa', titulo: 'Subir Ficheros'});
});

//*************************************************************************
//***************************LISTAR FICHEROS-GET****************************
//*************************************************************************
router.get('/listar', (req, res) =>
{

		// definimos la carpeta donde están los ficheros que se tienen que listarse
		let carpeta = 'ficheros_subidos';
		
 		// ruta completa de donde están los ficheros
		const directoryPath = path.join('src/public/'+carpeta);		
 
		fs.readdir(directoryPath, function (err, files)
		// en "files" tendré una tabla con todos los ficheros
		{
		    if (err)
			{
		        return console.log('Imposible listar directorio: ' + err);
		    } 
		    // recorremos la tabla "files"
		    let array=[];
		    files.forEach(function (file)
			{
		        // conseguimos información del fichero
		        var stats = fs.statSync(directoryPath+'/'+file);
				// console.log(stats);
		        // creo un objeto con la información que quiero
		        let obj={
		        	"name":file,
		        	"size":stats["size"],
		        };
				
		        // Meto en el array un objeto por cada fichero
		        array.push(obj);
		    });
		    res.render('listado', {lacarpeta: carpeta, datos: array,titulo: 'listado ficheros'});
		});	
	
});

//*************************************************************************
//*************************************************************************

// para exportar las rutas a otros módulos
module.exports = router;

