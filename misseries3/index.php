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

		if(isset($_POST['nombre'])) {
			$usuarios=usuario::existe($_POST["nombre"],$_POST["password"]);
			$count=$usuarios->rowCount();

			if($count>0) {
				$id=0;
				foreach($usuarios as $t) {
					$id=$t[0];
				}
				$_SESSION['usuario']=$id;
				echo "hecho: ".$id;
				echo "hecho: ".$_SESSION['usuario'];
				header("Location: ./main.php");

			} else {
				?>
				<div class="alert alert-danger" role="alert">
				  Usuario o contraseña erroneos
				</div>
				<?php
			}
		}

		if(isset($_GET['exito'])) {
			?>
			<div class="alert alert-success" role="alert">
				  Usuario añadido
				</div>
			<?php
		}
	?>
	<div class="d-flex flex-column justify-content-center align-items-center w-full" style="height: 100vh;">	
		<h1>Mis series</h1>

		<form action="./index.php" method="post">
			
		<div class="input-group mb-3">
		  <input type="text" name="nombre" class="form-control" placeholder="Nombre de usuario" aria-label="Recipient's username" aria-describedby="basic-addon2">
		</div>

		<div class="input-group mb-3">
		  <input type="text" name="password" class="form-control" placeholder="Contraseña" aria-label="Recipient's username" aria-describedby="basic-addon2">
		</div>

		<button class="btn btn-primary w-100">Entrar</button>

		</form>

		<div class="d-flex justify-content-between gap-3 mt-3">
			<a href="./crearUsu.php">Crear usuario</a>

			<a href="">Recordar contraseña</a>
		</div>
	</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</html>