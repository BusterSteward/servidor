<?php    
	
	usleep(400000);
	
	session_start();

	require("conexion.php");

	$user=$_POST["tuser"];
	$pass=$_POST["tpassword"];

	$consulta="SELECT * FROM USUARIOS WHERE USUARIO='$user' and PASSWORD='$pass'";

	$resultado=mysqli_query($conexion,$consulta);
	$nregistros=mysqli_num_rows($resultado);

	if($nregistros==1){
		$registro=mysqli_fetch_array($resultado);
		$_SESSION["user"]=$registro["USUARIO"];
		echo 1;
	}
	else{
		echo 0;
	}

	mysqli_close($conexion);
?>

 
 