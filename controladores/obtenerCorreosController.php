<?php 

// require_once("../clases/ConexionBDClass.php");
// require_once ("../clases/ClienteClass.php");
require_once ("../clases/EnvioPackClass.php");

//se capturan los datos del ajax
$data = json_decode(file_get_contents("php://input"));

$filtrarActivos = strip_tags($data->filtrarActivos);


//array para almacenar resultados
$output = array();

$envioPack = new EnvioPack();

$output = $envioPack->getCorreos( $filtrarActivos );

//devolucion del resultado en json
echo $output; 

?>