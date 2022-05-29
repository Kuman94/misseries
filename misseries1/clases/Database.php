<?php 


	class Database {
		private static $instancia=null;
		private $pdo;
		
		private function __construct() {
			try {
				$this->pdo=new PDO("mysql:host=localhost;dbname=misseries","root","root");
			} catch(Exception $e) {
				echo "error: ".$e->getMessage();
			}
		}

		private function __clone() {}

		public static function getInstancia() {
			if(Database::$instancia==null) {
				Database::$instancia=new Database();
			}
			return Database::$instancia;
		}

		
		public function lectura($sql) {
			
			$pdo=$this->pdo->quote($sql);
			$resultado=$this->pdo->query($sql);
			return $resultado;
		}


		public function consulta($sql,...$condiciones) {
			
			$sql=$this->pdo->prepare("$sql");
			for($i=0;$i<sizeof($condiciones);$i++) {
				$sql->bindValue(":condicion$i",$condiciones[$i],gettype($condiciones[$i])=="integer" ?PDO::PARAM_INT : PDO::PARAM_STR);
			}
			$sql->execute();
			$sql->closeCursor();
		}


		public function borrar($sql,...$condiciones) { 
			$sql=$this->pdo->prepare("$sql");
			for($i=0;$i<sizeof($condiciones);$i++) {
				$sql->bindValue(":condicion$i",$condiciones[$i],gettype($condiciones[$i])=="integer" ?PDO::PARAM_INT : PDO::PARAM_STR);
			}
			
			$sql->execute();
			$sql->closeCursor();
		}
		
	}

	
?>