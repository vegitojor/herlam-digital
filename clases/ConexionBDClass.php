<?php 

Class ConexionBD {
	// un comentario
	private $servidor = "localhost";
	private $usuario = "root";
	private $pass = "abrh++++";
	private $bd = "modpc";


	private $conexion;

	function __construct(){
		$this->conexion = mysqli_connect($this->servidor, $this->usuario, $this->pass, $this->bd);
	}

	function getConexion(){
		return $this->conexion;
	}

	function ejecutarConsulta($sql){
		$query = mysqli_query($this->conexion, $sql);
		return $query;
	}

	function prepare($sql){
		$resultado = mysqli_prepare($this->conexion, $sql);
		return $resultado;
	}

	function cerrarConexion(){
        mysqli_close($this->conexion);
    }

}

?>
