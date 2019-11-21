<?php 

Class ConexionBD {
	// Config local
	private $servidor = "localhost";
	// private $usuario = "root";
	// private $pass = "abrh++++";
	// private $bd = "herlam";
	private $port = '5432';

	//Confif Prod
	// private $servidor = "localhost";
	 private $usuario = "daniel33_digital";
	 private $pass = "MZTrfokHERLAM";
	 private $bd = "daniel33_herlamdigital";

	//Esto es un comentario de prueba===== git deploy problem

	private $conexion;

	function __construct(){
		// ******FOR DB --- MYSQL
		$this->conexion = mysqli_connect($this->servidor, $this->usuario, $this->pass, $this->bd);

		// ******FOR DB --- POTSGRES
		// $this->conexion = pg_connect('host=' . $this->servidor .' port=' . $this->port .' user=' . $this->usuario . ' password=' . $this->pass . ' dbname='. $this->bd);
	}

	function getConexion(){
		return $this->conexion;
	}

	function ejecutarConsulta($sql){
		$query = mysqli_query($this->conexion, $sql);
		return $query;
	}

	function queryPostgres($query, $params){
		$result = pg_query_params($this->conexion, $query, $params);
		return $result;
	}

	function prepare($sql){
		$resultado = mysqli_prepare($this->conexion, $sql);
		return $resultado;
	}

	function cerrarConexion(){
		mysqli_close($this->conexion);
		// pg_close($this->conexion);
    }

}

?>
