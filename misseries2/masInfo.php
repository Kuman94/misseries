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

		session_start();

		require_once "clases/Database.php";
		require_once "clases/serie.php";
		require_once "clases/genero.php";

		if(!isset($_SESSION['usuario'])) {
				header("Location: ./index.php");
		}
		
		$resultado=serie::dameSerie($_GET['id']);
	?>
	<h1>Mis series</h1>
	<a href="main.php">Mis series</a>
	

	<?php foreach($resultado as $item) { ?>

		<?php 

			$t=serie::dameGenero($item["ids"]);
			$generos=[];			
			


			foreach($t as $item3) {
				$a=genero::dameNombreGenero($item3[0]);
				array_push($generos,$a);	
			}

		?>

		<div id="serie_container">
			<div id="poster" style="background: url('<?= $item["poster"] ?>');"></div>
			<div id="content">
				<h1><?= $item["titulo"] ?></h1>
				<h3><?= $item["plataforma"] ?></h3>
				<p>Fecha de estreno: <?= $item["fecha"] ?></p>
				<p>Temporadas: <?= $item["temporadas"] ?></p>
				<p>Puntuacion: <?= $item["puntuacion"] ?></p>
				<p><?= $item["argumento"] ?></p>
				<?php 
					foreach($generos as $item2) {
						?>
							<p><?= $item2[0] ?></p>
						<?php
					}
				?>
			</div>
		</div>

		<div id="menu_operaciones">
			<a href="main.php">Volver atras</a>
			<a href="gestionarGeneros.php?id=<?= $_GET['id'] ?>">Gestionar generos</a>
			<a href="editarSerie.php?id=<?= $_GET['id'] ?>">Editar serie</a>
		</div>
	<?php } ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</html>