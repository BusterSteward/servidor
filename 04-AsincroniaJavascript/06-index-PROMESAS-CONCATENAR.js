// CONCATENAR PROMESAS

// Las promesas se pueden concatenar todas las veces que queramos
// Si concatenamos "promesas" sólo haría falta un método "catch" 

// Vamos a ver un ejemplo 
// Definimos las siguientes funciones:
// en este caso por la simplicidad de las funciones no generamos excepciones con "reject"

//*****************************************************************************
function cuadrado(numero)
{
    return new Promise(function(resolve, reject)
	{
          setTimeout(function()
		  {
              var resultado = numero * numero;
              resolve(resultado);
          },2000);
    });
}
//*****************************************************************************
function sumo(numero)
{
    return new Promise(function(resolve, reject)
	{
         setTimeout(function()
		 {
          var resultado = numero +50;
          resolve(resultado);
		},2000);
    });
}
//*****************************************************************************

var numero;

const mi_promesa = new Promise(function(resolve, reject) 
{
	// en este punto del código hacemos algo (en este caso sólo ejecutamos una línea de código)
	// generamos un número-ENTERO aleatorio entre 0 y 10
	 numero= Math.floor(Math.random() * 11);

	setTimeout(function()
			{
				if (numero>5) 
					// el número generado es válido
					{resolve(numero);}
					
				else
					// el número generado no es válido
					// generamos un objeto "error" que será recogido por el método "catch"
					{reject(new Error('ERROR-Número menor a 5'));}
			}, 2000);		
});


// empezamos a ejecutar líneas de código
console.log("Hola! esto es código-1\n");
console.log("Hola! esto es código-2\n");

// CONCATENAMOS PROMESAS
// OJO!! si se produce cualquier error en una promesa->las siguientes promesas no se ejecutarán

mi_promesa
	.then (cuadrado)
	.then (sumo)
	.then (function(numero) {console.log("el número TOTAL generado es:"+numero);})
	.catch (function(error) {console.log(error.message);});


/*
// otra forma: // comentar la anterior si pruebas esta
// OJO!! si se produce cualquier error en una promesa->las siguientes promesas no se ejecutarán
// CONCATENAMOS PROMESAS
// si la función que pasamos a (.then) hace un return
// entonces el valor devuelto pasa al siguiente (.then) de la cadena y lo podemos utilizar
mi_promesa
	.then (function(numero) {console.log("el número generado es:\n"+numero);return cuadrado(numero)})
	.then (function(numero) {console.log("el número al cuadrado es:\n"+numero);return sumo(numero)})
	.then (function(numero) {console.log("y si le sumo 50 el número es:"+numero);})
	.catch(function(error) {console.log(error.message);});

// seguimos ejecutando líneas de código
console.log("Hola! esto es código-3\n");
console.log("Hola! esto es código-4\n");
*/