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
	}

?>