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
		$resultado=serie::dameSerie($_GET['id']);
	?>

	<?php 
		if(isset($_GET['idBorrar'])) {
			$q=genero::borrarRelGenero($_GET["id"],$_GET['idBorrar']);
		}
	?>

	<?php 
		if(isset($_GET["add"])) {
			echo "adding";
			if($_GET['value']!="nuevo") { 
				genero::aniadirGenero($_GET["id"],$_GET["value"]);
			} else {
				if(isset($_GET["newGen"])) {
					genero::newGen($_GET["newGen"]);
				}
			}
			
		}
	?>

	<h1>Mis series</h1>
	

	<?php 
		foreach($resultado as $item) {

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

			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">Genero</th>
			      <th scope="col"></th>
			    </tr>
			  </thead>
			  <tbody>
			    <?php 
			    $contador=0;
			    	foreach($generos as $y) {

			    		?>
			    			<tr>
			    				<td><?= $y[0] ?></td>
			    				<td>
			    					<form action="gestionarGeneros.php" method="get">
			    						<input type="hidden" name="idBorrar" value="<?= $t[$contador][0] ?>">
			    						<input type="hidden" name="id" value="<?= $_GET['id'] ?>">
			    						<button>Borrar</button>
			    					</form>
			    				</td>
			    			</tr>
			    		<?php
			    		$contador++;
			    	}
			    ?>
			    <tr>
			    	<td>
			    		<form action="gestionarGeneros.php" method="get">
			    		<input type="hidden" name="add" value="true">
			    		<input type="hidden" name="id" value="<?= $_GET['id'] ?>">
			    		<select name="value">
			    			
			    		
			    		<?php
			    			$allGen=genero::dameTodoGenero();
			    			$allArray=[];
			    			$allId=[];
			    			$contador2=0;
			    			

			    			var_dump($allGen);


			    			foreach($allGen as $m) {
			    				$repe=false;

			    				
								foreach($generos as $t2) {
									if($t2[0]==$m[1]) {
										$repe=true;
									}
								}
								if($repe==false) {
			    					echo "<option value=".$m[0].">$m[1]</option>";
			    				}
			    			}
			    		?>

			    		<option value="nuevo">Nuevo genero</option>
			    		</select>
			    		<?php 
			    			if(isset($_GET["add"])) {
								if($_GET['value']=="nuevo") {
									?>
										<input type="text" name="newGen">
									<?php
								}
							}
			    		?>
			    		<button>add</button>
			    	</form>
			    	</td>
			    	
			    </tr>
			  </tbody>
			</table>
		<?php

		}
	?>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</html>