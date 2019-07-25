<?php 

// require_once("../clases/ConexionBDClass.php");
// require_once ("../clases/ClienteClass.php");
require_once ("../clases/EnvioPackClass.php");

//se capturan los datos del ajax
$data = json_decode(file_get_contents("php://input"));

//array para almacenar resultados
$output = array();

$envioPack = new EnvioPack();
if( !isset($data->idProvincia) ){
	$output = $envioPack->getProvincias();
}else{
	$output = $envioPack->getLocalidades( $data->idProvincia );
}


//devolucion del resultado en json
echo json_encode($output); 

?>