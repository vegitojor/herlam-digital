<?php 

Class ConexionBD {
	// Config local
	// private $servidor = "localhost";
	// private $usuario = "postgres";
	// private $pass = "postgres";
	// private $bd = "herlam";
	private $port = '5432';

	//Confif Prod
	private $servidor = "ec2-23-21-109-177.compute-1.amazonaws.com";
	private $usuario = "avsnfsjxddvtro";
	private $pass = "a082ef406ccbbff55f36578ef0b3424b12a3e16d28cf37fe84c29b9ec03f478b";
	private $bd = "df7ro2kitpoeun";


	private $conexion;

	function __construct(){
		// ******FOR DB --- MYSQL
		// $this->conexion = mysqli_connect($this->servidor, $this->usuario, $this->pass, $this->bd);

		// ******FOR DB --- POTSGRES
		$this->conexion = pg_connect('host=' . $this->servidor .' port=' . $this->port .' user=' . $this->usuario . ' password=' . $this->pass . ' dbname='. $this->bd);
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
		// mysqli_close($this->conexion);
		pg_close($this->conexion);
    }

}

?>
