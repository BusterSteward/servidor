<?php
	session_start();
	
	// columna jugada
	$njugada=$_POST["njugada"];
	$fruta1=$_POST["fruta1"];
	$fruta2=$_POST["fruta2"];
	$fruta3=$_POST["fruta3"];

	$_SESSION["jugadas"][$njugada]=$fruta1."/".$fruta2."/".$fruta3;
	
	
?>