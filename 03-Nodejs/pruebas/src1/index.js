// ejecución en consola -> npm run start texto1.txt

// *************************************************************************
// Proceso "SÍNCRONO"
// Código BLOQUEANTE y ejecución SÍNCRONA
// Muestra el número total de lineas, y el número de palabras por linea de un fichero dado -> texto1.txt
// *************************************************************************

// hace falta utilizar estas librerías ->
// Documentación: https://nodejs.org/api/fs.html

// EJECUCIÓN:
// Ejemplo: npm run start src/texto1.txt
// que se convertirá en -> node src/index.js src/texto1.txt

// import fs from 'fs'; -> da error, no hacerlo así de momento
// también se puede hacer así
const fs = require('fs');

// esta es la forma de poder acceder a cualquier parámetro de la línea de ejecución
// el primer parámetro es el 0
// esto lo hacemos así para que sirva para cualquier fichero de texto
const file = process.argv[2]

console.log(`Fichero selecionado: ${file}\n`)
console.log("Fichero selecionado: "+file+"\n")
console.log("Fichero selecionado:",file,"\n")

// ahora no utilizamos eventos
// "fs.readFile" lee el fichero "file" y cuando termine pasa los datos a "contents" o a "err" si ocurre un error
// estamos utilizando un proceso síncrono
// hasta que "fs.readFile" no termine de leer el fichero no pasa los datos a "contents" 

// de esta forma las cosas sucederán una detrás de otra (bloqueos)
// no es la forma normal de trabajar con nodejs pero también lo permite
// la forma normal de trabajar en nodejs es "por eventos (de forma asíncrona)"
fs.readFile(file, (err, contents) => 
{			
	// (err, contents) => esta función definida es el "callback"
	if (err)
	{
		return console.log(err)
	}

	// generamos un array "lines" y utilizamos el caracter "\n" como carácter de división
	const lines = contents.toString().split('\n')

	// me declaro una variable "line"
	// recorremos el array "lines"
	for (let line of lines)
	{
	// eliminamos los caracteres ocultos de la línea
	line=line.trim()
	//console.log(`Número de caracteres por linea: ${line} ${line.length}`)
	console.log("Número de caracteres por linea: "+line+" "+line.length)
	}

	//console.log(`\nNúmero total de lineas: ${lines.length}`)
	console.log("\nNúmero total de lineas:", lines.length)
})
// con esta salida por consola comprobamos que el proceso es totalmente "ASÍNCRONO"
console.log("\nHola Pepe")
console.log("\nHola Pepe")

