
// *************************************************************************
// Proceso "ASÍNCRONO"
// Código NO-BLOQUEANTE y ejecución ASÍNCRONA
// Muestra el número total de lineas, y el número de palabras por linea de un fichero dado -> texto1.txt
// *************************************************************************

// hace falta utilizar estas librerías ->
// Documentación: https://nodejs.org/api/fs.html
// Documentación: https://nodejs.org/api/readline.html


// EJECUCIÓN:
// Ejemplo: npm run start texto1.txt
// que se convertirá en -> node src/index.js texto1.txt

// librería para leer ficheros
const fs = require('fs'); 
// librería para leer un fichero por líneas
const readline = require('readline'); 

// con BABEL
// import fs from 'fs'
// import readline from 'readline'

// seleccionamos el tercer parámetro que es (texto1.txt)
const file = process.argv[2];
let lineas = 0;
console.log(`Fichero selecionado: ${file}\n`);
//console.log('Fichero selecionado: ',fichero,'\n')

// creamos una instancia del objeto
const rl = readline.createInterface(
{
  // leemos el fichero "texto1.txt" por líneas (input)
  input: fs.createReadStream(file),
  // para configurar el final de línea "\r\n"
  crlfDelay: Infinity
})

// se produce el evento "line" cuando se lee una linea
rl.on('line', (linea) =>
{
	  ++lineas
	  //console.log('Número de caracteres por linea: ', linea,linea.length)
	  console.log(`Número de caracteres por linea:  ${linea} ${linea.length}`)
})

// se produce el evento "close" cuando ya no hay más líneas
// y se cierra el objeto
rl.on('close', () =>
{
  //console.log('\nNúmero total de lineas: ',lineas)
  console.log(`\nNúmero total de lineas: ${lineas}`);
  rl.close();
})

// con esta salida por consola comprobamos que el proceso es totalmente "ASÍNCRONO"
console.log("\nHola Pepe");
console.log("\nHola Pepe\n");
