<?php
		//***************************************************************************************
		//***************************************************************************************
		echo "<h1>Mi información API-Rest:</h1>"."<h3> Todos los registros</h3>";
		$acceso = "http://127.0.0.1:3000";
		
		// "file_get_contents" -> almacena en "$json" todo el texto devuelto por "$acceso" 
		// en la variable "$json" tendremos todos los datos que nos devuelve la API Rest
		$json = file_get_contents($acceso);
		
		// en "$informacion" tendremos una tabla
		$informacion= json_decode($json);
		 

		foreach ($informacion as $info)
		{ 
			echo $info->nombre."**********".$info->salario."<br><br><br>";
		}
		//***************************************************************************************
		//***************************************************************************************
		echo "<h1>Mi información API-Rest:</h1>"."<h3> 1 Registro</h3>";
		$acceso = "http://127.0.0.1:3000/4";

		$json = file_get_contents($acceso);
		
		// en "$informacion" tendremos una tabla
		$informacion= json_decode($json);
		 

		foreach ($informacion as $info)
		{ 
			echo $info->nombre."**********".$info->salario."<br>";
		}
?>