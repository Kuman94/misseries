<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MISSERIES</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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

		if(isset($_POST['actuar'])) {
			$a=serie::crearSerie($_POST["titulo"],$_POST["fecha"],$_POST["temporadas"],$_POST["argumento"],$_POST["plataforma"],$_POST["posterImage"]);
			
			foreach($_POST['generos'] as $item) {
				$t=serie::asociarGenero($item);
			}
			header("Location: ./addSerie.php?id=".$_SESSION['usuario']."");
		}
		$generos=genero::dameTodoGenero();
	?>

	<section id="alert_create" class="w-100">
		<div class="alert alert-danger" role="alert">
  			Esta serie ya esta creada
		</div>
	</section>

	<h1>Mis series</h1>
	<form action="addSerie.php" method="post">
		<input type="hidden" name="actuar" value="true">
		<label for="titulo">Titulo</label>
		<input type="text" id="titulo" name="titulo" required>  <br>
		<label for="fecha">Fecha de estreno</label>
		<input type="date" id="fecha" name="fecha" required>  <br>
		<label for="temporadas">Temporadas</label>
		<input type="number" id="temporadas" name="temporadas" required> <br>
		<label for="plataforma">Plataforma</label>
		<select name="plataforma" id="plataforma">
			<option value="Netflix">Netflix</option>
			<option value="HBO">HBO</option>
			<option value="Amazon Ppime">Amazon Prime</option>
			<option value="Movistar">Movistar</option>
			<option value="Disney+">Disney+</option>
			<option value="Apple TV">Apple TV</option>
		</select>

		<br>
		<label for="posterImage">poster</label>
		<input type="text" id="posterImage" name="posterImage"> <br>
		<label for="generos">generos</label>
		<select name="generos[]" id="generos" multiple>
			<?php 
				foreach($generos as $item) {
					?>
					<option value="<?= $item[0] ?>"><?= $item[1] ?></option>
					<?php
				}
			?>
		</select> <br>
		<a href="gestionarGeneros.php?id=<?= $_GET['id'] ?>">Añadir generos</a> <br>
		<label for="argumento">Argumento</label>
		<textarea name="argumento" id="argumento" cols="30" rows="10" required></textarea> <br>

		<button class="btn btn-primary" id="add">Añadir</button>
		<a href="./main.php" class="btn btn-danger">Cancelar</a>
	</form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="script.js"></script>
</html>