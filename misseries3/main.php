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


		require_once "clases/Database.php";
		require_once "clases/serie.php";


		if(!isset($_SESSION['usuario'])) {
				header("Location: ./index.php");
		}

		if(isset($_POST['cerrar'])) {
			session_destroy();
			header("Location: ./index.php");
		}

		$res=serie::dameTodo();
?>

	<h1>Mis series</h1>

	<a href="main.php">Mis series</a>

	

	<form action="main.php" method="post">
		<input type="hidden" name="cerrar" value="true">
		<button>Cerrar sesion</button>
	</form>

	<a href="addSerie.php?id=<?=$_SESSION['usuario']?>">Añadir serie</a>

	<table class="table mt-3">
  <thead class="bg-dark text-white">
    <tr>
      <th scope="col">Titulo</th>
      <th scope="col">Puntuacion</th>
      <th scope="col">Plataforma</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    
    <?php 
    	foreach($res as $item) {
			echo "<tr>";
			echo "<td>".$item['titulo']."</td>";
			echo "<td>".$item['puntuacion']."</td>";
			if($item["plataforma"]==null) {
				echo "<td>No emitiendose</td>";
			} else {
				echo "<td>".$item['plataforma']."</td>";
			}
			?>
			<td>
				<a href="masInfo.php?id=<?= $item["ids"] ?>">Mas info</a>
			</td>
			<?php
			echo "</tr>";
		}
    ?>
  </tbody>
</table>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</html>