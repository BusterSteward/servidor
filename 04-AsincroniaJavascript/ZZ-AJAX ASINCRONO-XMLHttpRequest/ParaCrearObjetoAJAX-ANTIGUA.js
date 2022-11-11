function CreoObjetoAjax()
{
  //Vemos si el objeto window del navegador posee el método
  //XMLHttpRequest (Navegadores como Mozilla,Chrome, etc).

  if(window.XMLHttpRequest) 
   {
    //Si lo tiene, crearemos el objeto con este método.
    return new XMLHttpRequest(); 
   }
  //Si no tenía el método anterior es que utilizamos Internet Explorer,
  //revisamos las versiones y creamos uno objeto en particular para Internet Explorer.
  //Hay diferentes versiones del objeto, creamos un array, que
  //contiene los diferentes tipos desde la versión más reciente, hasta la más antigua
  else if(window.ActiveXObject) 
   {
     var versionesObj = new Array(
     'Msxml2.XMLHTTP.5.0',
     'Msxml2.XMLHTTP.4.0',
     'Msxml2.XMLHTTP.3.0',
     'Msxml2.XMLHTTP',
     'Microsoft.XMLHTTP');
     for (var i = 0; i < versionesObj.length; i++)
      {
        try
          {
           //Intentamos devolver el objeto intentando crear las diferentes versiones
           //si intentamos crear uno que no existe se producirá un error.
           return new ActiveXObject(versionesObj[i]);
          }
         //la instrucción try siempre lleva asociada la instrucción cath.
//Capturamos el error.
          catch (errorControlado)  { }
      }
   }
   //Si el navegador llego aquí es porque no posee manera alguna de
   //crear el objeto, emitimos un mensaje de error.
   throw new Error("No se pudo crear el objeto XMLHttpRequest");
}
