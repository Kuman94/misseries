<?php 

	require_once "Database.php";

	class serie {

		public static function dameTodo() {
			$a=Database::getInstancia();
			$sql="SELECT * FROM serie";
			$res=$a->lectura($sql);
			return $res;
		}


		public static function dameSerie($id) {
			$a=Database::getInstancia();
			$sql="SELECT * FROM serie WHERE ids=$id";
			$res=$a->lectura($sql);
			return $res;	
		}


		public static function dameGenero($id) {
			$a=Database::getInstancia();
			$sql="SELECT idg FROM pertenece WHERE ids=$id";
			$res=$a->lectura($sql);
			$res=$res->fetchAll();
			return $res;
		}

		
		public static function actualizar($id,$estreno,$temporada,$puntuacion,$argumento) {
			$a=Database::getInstancia();
			$sql = "UPDATE serie SET fecha=:condicion0,temporadas=:condicion1,puntuacion=:condicion2,argumento=:condicion3 WHERE ids=:condicion4";
			$res=$a->consulta($sql,$estreno,$temporada,$puntuacion,$argumento,$id);
			return $res;
		}

		public static function dameSeriePorNombre($nombre) {
			$a=Database::getInstancia();
			$sql="SELECT * FROM serie WHERE titulo='$nombre'";
			$res=$a->lectura($sql);
			return $res->rowCount();	
		}

		public static function crearSerie($titulo,$fecha,$temporadas=1,$argumento,$plataforma,$poster="https://picsum.photos/350/525") {
			$a=Database::getInstancia();
			$sql = "INSERT INTO serie VALUES(null,:condicion0,:condicion1,:condicion2,:condicion3,:condicion4,:condicion5,:condicion6)";
			if($poster=="" || $poster==undefined) {
                $poster="https://picsum.photos/id/237/350/525";
            }
			$res=$a->consulta($sql,$titulo,$fecha,$temporadas=1,0,$argumento,$plataforma,$poster);
			return $res;
		}

		public static function asociarGenero($idG) {
			$a=Database::getInstancia();
			$ids=0;
			$sql="SELECT MAX(ids) FROM serie";
			$res=$a->lectura($sql);
			foreach($res as $item) {
				$ids=$item[0];
			}

			$sql="INSERT INTO pertenece VALUES(:condicion0,:condicion1)";
			$res=$a->consulta($sql,$ids,$idG);
			return $res;
		}

		public static function actualizarPuntuacion($id,$puntuacion) {
			$a=Database::getInstancia();
			$sql = "UPDATE serie SET puntuacion=:condicion0 WHERE ids=:condicion1";
			$res=$a->consulta($sql,$puntuacion,$id);
			return $res;
		}

	}

?>