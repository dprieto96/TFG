<?php
    class DB {
	    private $host = "localhost";
        private $dbName = "innova";
        private $dbUser = "dani";
        private $dbPassword = ".bSVRi98zDpeA7m";
		private $conexion = null;
		private static $instance;
   
		
		public static function getInstance(){
			if( is_null( self::$instance )){
			    self::$instance = new self();
			}
			return self::$instance;
		}
		
		function getConnection(){
			if(!isset($this->conexion)){
				
				$this->conexion = new mysqli($this->host,$this->dbUser,$this->dbPassword,$this->dbName);
				
				if($this->conexion->connect_errno){
					echo "Error de conexión a la BD: (" . $this->conexion->connect_errno . ") " . $this->conexion->connect_error;
      				exit();
				}
				if ( !$this->conexion->set_charset("utf8mb4")) {
				      echo "Error al configurar la codificación de la BD";
				      exit();
    			}
			}
			return $this->conexion;
		}
	}
?>