<?php 

	require_once "Database.php";

	class usuario {
		public static function existe($nom,$pass) {
			$a=Database::getInstancia();
			$sql="SELECT * FROM usuario WHERE usuario='$nom' AND password='$pass'";
			$res=$a->lectura($sql);
			return $res;
		}
		public static function insertar($nom,$email,$nomUsu,$pass) {
			$a=Database::getInstancia();
			try {
				$sql="INSERT INTO usuario VALUES(null,:condicion0,:condicion1,:condicion2,:condicion3,:condicion4,:condicion5)";
				$res=$a->consulta($sql,$nomUsu,$pass,$email,$nom,0,null);
				return $res;
			} catch(PDOException $e) {
				$t=$e->getMessage();
				return "error";
			}
		}
	}

?>