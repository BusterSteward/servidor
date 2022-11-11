var numero_celdas;
var tabla=new Array();

function rellenotabla()
{
	setTimeout(function()
	{
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
		for(i=0;i<11;i++)
		{
		   console.log("tabla["+i+"]="+tabla[i]+"\n");
		}			
	}, 5000);
}

console.log("Hola! JavaScript es asíncrono y NO bloqueante-1\n");
console.log("Hola! JavaScript es asíncrono y NO bloqueante-2\n");
console.log("Hola! JavaScript es asíncrono y NO bloqueante-3\n");
console.log("Hola! JavaScript es asíncrono y NO bloqueante-4\n");

// antes de llamar a la función
numero_celdas=tabla.length;
console.log("Tengo "+numero_celdas+" elementos en la Tabla\n");

rellenotabla();

// después de llamar a la función
numero_celdas=tabla.length;
console.log("Tengo "+numero_celdas+" elementos en la Tabla\n");

console.log("Hola! JavaScript es asíncrono y NO bloqueante-5\n");
console.log("Hola! JavaScript es asíncrono y NO bloqueante-6\n");
console.log("Hola! JavaScript es asíncrono y NO bloqueante-7\n");
console.log("Hola! JavaScript es asíncrono y NO bloqueante-8\n");