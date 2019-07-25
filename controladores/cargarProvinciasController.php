<?php 

require_once("../clases/ConexionBDClass.php");
require_once ("../clases/ClienteClass.php");

$conn = new ConexionBD();
$conexion = $conn->getConexion();

//array para almacenar resultados
$output = array();

//Consulta a la base de datos
$output = Cliente::cargarProvincias($conexion);


//devolucion del resultado en json
echo json_encode($output); 

?>