// PROMESAS

// Las promesas son una manera de trabajar con "código asíncrono" 

// Una promesa puede tener 4 estados
// ---fulfilled (cumplida): la acción relacionada con la promesa se completa con éxito
// ---rejected (rechazada): la acción relacionada con la promesa no se completa con éxito
// ---pending (pendiente): aún no se ha completado ni rechazado
// ---settled (finalizada): se ha completado o se ha rechazado

// Una vez que una promesa a sido invocada, esta entrara en estado "pendiente"

// El constructor de una promesa recibe un "callback", el cual posee dos parámetros:
// "resolve" y "reject" (estas dos funciones están ya definidas en Javascript).

// En caso de que el código de la promesa se ejecute correctamente-> usaremos la función "resolve".
// En caso de que el código falle por alguna razón-> usaremos la función "reject".

// THEN
// cuando invocamos a una promesa, podemos capturar su resultado utilizando el metodo "then"
// al cual le tenemos que pasar una funcion para utilizar el valor que la promesa devuelve. 

// CATCH
// las promesas tambien nos permiten manejar excepciones o errores por medio del metodo "catch"
// este metodo es invocado cuando algo falla dentro de una promesa o cuando esta pasa a estado "rejected"

// ejemplo de "PROMESA"
// creamos una nueva promesa que se va a completar después de 3 segundos,
// generamos un nº aleatorio comprendido entre 0 y 10
// si el número aleatorio que generamos es mayor a 5 entonces se resuelve con éxito->"resolve"
// si es menor o igual a 5 entonces es rechazada y obtenemos un error->"reject"

var numero;

//creo la promesa, pero no la estoy invocando
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
			}, 3000);		
});


// empezamos a ejecutar líneas de código
console.log("Hola! esto es código-1\n");
console.log("Hola! esto es código-2\n");

// invocamos a la promesa
// código asíncrono

mi_promesa
	.then (function(numero) {console.log("el número generado es:"+numero);})
	.catch (function(error) {console.log(error.message);});

// seguimos ejecutando líneas de código
console.log("Hola! esto es código-3\n");
console.log("Hola! esto es código-4\n");

// OJO!!
// el mismo código pero más moderno	
// debes de acostumbrarte a este JavaScript moderno
// observa las diferencias
/*
var numero;
const mi_promesa = new Promise((resolve, reject) =>
{
	numero = Math.floor(Math.random() * 11);

	setTimeout(
		() => numero > 5
			? resolve(numero)
			: reject(new Error('ERROR-Número menor a 5')),
		3000
	);
});

mi_promesa
	.then(number => console.log(numero))
	.catch(error => console.error(error));
	*/
