var numero_celdas;
var tabla=new Array();

const mi_promesa = new Promise(function(resolve, reject) 
{
	// en este punto del código hacemos algo
	console.log("rellenotabla");
	tabla[0]=100;
	tabla[1]=200;
	tabla[2]=300;
	tabla[3]=300;
	tabla[4]=400;
	tabla[5]=500;
	tabla[6]=600;
	tabla[7]=700;
	tabla[8]=800;
	tabla[9]=900;
	tabla[10]=1000;
	numero_celdas=tabla.length;
	console.log("Tengo "+numero_celdas+" elementos en la Tabla\n");

	setTimeout(function()
			{
				if (numero_celdas==11) 
					// la tabla generada es válida
					{
						for(i=0;i<11;i++)
						{
							console.log("tabla["+i+"]="+tabla[i]+"\n");
						}			
						resolve(numero_celdas);
					}
				else
					// generamos un objeto "error" que será recogido por el método "catch"
					{reject(new Error('ERROR-Tabla NO válida'));}
			}, 3000);		
});

// empezamos a ejecutar líneas de código
console.log("Hola! esto es código-1\n");
console.log("Hola! esto es código-2\n");
console.log("Hola! esto es código-3\n");
console.log("Hola! esto es código-4\n");

// invocamos a la promesa
// código asíncrono que no bloquea y el código seguirá ejecutándose

mi_promesa
	.then (function(numeroc) {console.log("la tabla es valída porque tiene: "+numeroc+" elementos");})
	.catch (function(error) {console.log(error.message);});

// seguimos ejecutando líneas de código
console.log("Hola! esto es código-5\n");
console.log("Hola! esto es código-6\n");
console.log("Hola! esto es código-7\n");
console.log("Hola! esto es código-8\n");
