<?php
// OJO: cuando almacenamos una imagen (recuperada de la BD) en $_SESSION se hace as� ->
// $_SESSION[][]=base64_encode($registro['IMAGEN']);

// OJO: cuando visualizo una imagen almacenada en $_SESSION se hace as� ->
// <img style='width:30px;height:43px' src='data:image/jpeg;base64,".addslashes($_SESSION[][])."'>

// iniciamos sesi�n
session_start();

// miramos si la sesi�n est� iniciada, si el usuario est� logeado (esto no har�a falta... pero lo hacemos por seguridad)
// si es as� PERMITO que "PHP-metocarro.php" funcione

if(isset($_SESSION['username']))
{
			// conexi�n con la base de datos
			require('conexion.php');

			// recogemos los datos del array $POST
			// es el art�culo que queremos meter en el carro
			$id=$_POST['elarticulo'];

			// *******************************************************************
			// se permiten "art�culos" repetidos -> el mismo art�culo en el carro varias veces -> considerado como art�culo distinto
			// *******************************************************************
				
			// Datos del "art�culo" que queremos meter en el CARRO
			$consulta = "SELECT * FROM articulos WHERE (ID='$id')" ;
			$resultado = mysqli_query($conexion,$consulta);
			$registro = mysqli_fetch_array($resultado);			

			// calculo el n� de "art�culos" que hay en el carro
			if (isset($_SESSION['ID'])) {$elementos=count($_SESSION['ID']);}
			else {$elementos=0;}

			$trimID=trim($id);
			// creo las variables de sesi�n
				
			if(isset($_SESSION['ID'][$trimID])){
				$_SESSION['CANTIDAD'][$trimID]++; 
			}
			else{
				// de esta forma utilizo para las columnas -> 0,1,2,3
				$_SESSION['ID'][$trimID]=$trimID;
				$_SESSION['IMAGEN'][$trimID]=base64_encode($registro['IMAGEN']);
				$_SESSION['TITULO1'][$trimID]=$registro['TITULO1'];
				$_SESSION['TITULO2'][$trimID]=$registro['TITULO2']; 
				$_SESSION['CANTIDAD'][$trimID]=1; 
				$_SESSION['PRECIO'][$trimID]=$registro['PRECIO'];

			}
			
			// calculo el n� de "art�culos" que hay en el carro
			$elementos=count($_SESSION['ID']);

			//MUY IMPORTANTE
			//siempre hay que hacer esto
			//cerramos la conexion  con la base de datos
			mysqli_close($conexion); 
}
else
{			
			$elementos=0;
}
// devuelvo el n� de "art�culos distintos" que hay en el carro
echo $elementos;
?>
