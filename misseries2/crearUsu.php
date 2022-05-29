<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MISSERIES</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
	<?php 
		session_start();

		require_once "clases/usuario.php";


		if(isset($_SESSION['usuario'])) {
			header("Location: ./main.php");
		}


		$error=false;
		if(isset($_POST['nombre'])) {
			$nombre=$_POST['nombre'] . " " . $_POST["apellidos"];

			if($_POST["pass"] === $_POST["againPass"]) {
				$res=usuario::insertar($nombre,$_POST["email"],$_POST["nombreUsu"],$_POST["pass"]);
				
				header("Location: index.php?exito='true'");

				if($error=="error") {
					$error=true;
				}
			} else {
				$error=true;
			}

		}
?>
	
	<?php 
		if($error==true) {
			?>
				<div class="alert alert-danger" role="alert">
				 	Error en el formulario
				</div>
			<?php
		}
	 ?>



	<div class="d-flex flex-column justify-content-center align-items-center w-full" style="height: 100vh;">
		<h1>Mis series</h1>
		<form action="./crearUsu.php" method="post">
				
			<div class="input-group mb-3">
			  <input type="text" name="nombre" class="form-control" placeholder="Nombre" aria-label="Recipient's username" aria-describedby="basic-addon2">
			</div>
			<div class="input-group mb-3">
			 	<input type="text" name="apellidos" class="form-control" placeholder="Apellidos" aria-label="Recipient's username" aria-describedby="basic-addon2">
			</div>

			<div class="input-group mb-3">
			 	<input type="text" name="email" class="form-control" placeholder="Email" aria-label="Recipient's username" aria-describedby="basic-addon2">
			</div>

			<div class="input-group mb-3">
			 	<input type="text" name="nombreUsu" class="form-control" placeholder="Nombre de usuario" aria-label="Recipient's username" aria-describedby="basic-addon2">
			</div>

			<div class="input-group mb-3">
			 	<input type="text" name="pass" class="form-control" placeholder="Contraseña" aria-label="Recipient's username" aria-describedby="basic-addon2">
			</div>

			<div class="input-group mb-3">
			 	<input type="text" name="againPass" class="form-control" placeholder="Conf.Contraseña" aria-label="Recipient's username" aria-describedby="basic-addon2">
			</div>

			<button class="btn btn-primary w-100">Registrarse</button>
			<a href="./index.php" class="btn btn-danger w-100">Cancelar</a>
		</form>
	</div>

	
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</html>