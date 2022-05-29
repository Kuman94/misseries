<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<?php

		require_once "clases/Database.php";
		require_once "clases/serie.php";
		require_once "clases/genero.php";


		if(isset($_POST["estreno"])) {
			serie::actualizar($_GET["id"],$_POST['estreno'],$_POST['temporadas'],$_POST['puntuacion'],$_POST['argumento']);
			echo header("Location: ./main.php");

		} else {


		$serie=serie::dameSerie($_GET['id']);
	?>

	<h1>Mis series</h1>

	

	<?php 
		foreach($serie as $item) {

			$t=serie::dameGenero($item["ids"]);

			$generos=[];
			foreach($t as $item3) {
				$a=genero::dameNombreGenero($item3[0]);
				array_push($generos,$a);	
			}

			?>
			<h1><?= $item["titulo"] ?></h1>
			<a href="main.php">Mis series</a>
			<a href="masInfo.php?id=<?= $_GET['id'] ?>">Volver atras</a>
			<form action="editarSerie.php?id=<?= $_GET['id'] ?>" method="post">
				<label for="estreno">Fecha etreno</label>
				<input type="text" name="estreno" id="estreno" value="<?= $item["fecha"] ?>"> <br>
				<label for="temporadas">Temporadas</label>
				<input type="text" name="temporadas" id="temporadas" value="<?= $item["temporadas"] ?>"> <br>
				<label for="puntuacion">Puntuacion</label>
				<input type="text" name="puntuacion" id="puntuacion" value="<?= $item["puntuacion"] ?>"> <br>
				<label for="generos">Generos</label>
				
					<?php 
						foreach($generos as $you) {
							echo "<p>$you[0]</p>";
						}
					?>
				
				<a href="gestionarGeneros.php?id=<?= $_GET['id'] ?>">Gestionar generos</a> <br>
				<label for="argumento">Argumento</label> <br>
				<textarea name="argumento" id="argumento" cols="30" rows="10"><?= $item["argumento"] ?></textarea> <br>
				<button>Actualizar</button>
			</form>
			<?php
		}
	}
	?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</html>