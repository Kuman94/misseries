<?php 
	
	require_once "clases/serie.php";

	$count=serie::dameSeriePorNombre($_POST["datos"]["nombre"]);

	echo $count;
?>