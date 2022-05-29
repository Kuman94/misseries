<?php 
	class genero {
		public static function dameNombreGenero($id) {
			$a=Database::getInstancia();
			$sql="SELECT genero FROM genero WHERE idg=$id";
			$res=$a->lectura($sql);
			foreach($res as $t) {
				return $t;
			}
		}
		public static function borrarRelGenero($ids,$idg) {
			$a=Database::getInstancia();
			$sql="DELETE FROM pertenece WHERE ids=:condicion0 AND idg=:condicion1";
			$a->borrar($sql,$ids,$idg);
		}
		public static function dameTodoGenero() {
			$a=Database::getInstancia();
			$sql="SELECT * FROM genero";
			$res=$a->lectura($sql);
			return $res->fetchAll();
		}

		
		public static function aniadirGenero($ids,$idg) {
			$a=Database::getInstancia();
			$sql="INSERT INTO pertenece VALUES(:condicion0,:condicion1)";
			$res=$a->consulta($sql,$ids,$idg);
			return $res;
		}

		public static function newGen($nombre) {
			$a=Database::getInstancia();
			$sql="INSERT INTO genero (idg,genero) VALUES(null,:condicion0)";
			$res=$a->consulta($sql,$nombre);
			return $res;
		}
	}
?>