// Ejemplo de definición de una función en JavaScript
// EJEMPLO-0 
/*
function suma(a,b)
{
 console.log("Soy la función suma, el resultado de a+b es igual a: ",a+b);
}

console.log('Ejemplo-0: \n');
console.log('Llamo a la función SUMA \n');
// llamo a la función suma
suma(20,30);
console.log('\n\n\n\n');

*/
// Concepto de "callback"
// La idea básica de los "callbacks" es que cuando llamo a una función, además de pasarle parámetros simples,
// también puedo pasarle una función como parámetro
// esta función que le paso como parámetro será ejecutada cuando la función a la que llamo termine su ejecución.

// EJEMPLO-1 (callback)
function funcionPrincipal(callback)
{
 console.log('Soy la función principal y he terminado-Ahora llamo al callback');
 callback();
}

console.log('Ejemplo-1: \n');
console.log('Llamo a la función funcionPrincipal \n');
// realizo una llamada a funcionPrincipal y le paso una función
funcionPrincipal(
	function()
	{
		console.log('soy callback-hago algo');
	}
);


// EJEMPLO-2 (callback con paso de variable)
function funcionPrincipal(callback)
{
 console.log('Soy la función principal y he terminado-Ahora llamo al callback 1\n');
 console.log('Soy la función principal y he terminado-Ahora llamo al callback 2\n');
 console.log('Soy la función principal y he terminado-Ahora llamo al callback 3\n');
 console.log('Soy la función principal y he terminado-Ahora llamo al callback 4\n');
 console.log('Soy la función principal y he terminado-Ahora llamo al callback 5\n');
 callback('pepe');
}

 console.log('Ejemplo-2 \n')
 // realizo una llamada a funcionPrincipal y le paso una función
funcionPrincipal(
	function(variable)
	{
		console.log('soy callback-hago algo-valor dato pasado:',variable);
	}
);


