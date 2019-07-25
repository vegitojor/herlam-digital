<?php 

// require_once("../clases/ConexionBDClass.php");
// require_once ("../clases/ClienteClass.php");
require_once ("../clases/EnvioPackClass.php");

//se capturan los datos del ajax
$data = json_decode(file_get_contents("php://input"));

$provincia = strip_tags($data->provincia);
$codigoPostal = strip_tags($data->codigoPostal);
$peso = strip_tags($data->peso);
$paquetes = strip_tags($data->paquetes);
$servicio = strip_tags($data->servicio);

//array para almacenar resultados
$output = array();

$envioPack = new EnvioPack();

$output = $envioPack->calcularCostoEnviodomicilio( $provincia, $codigoPostal, $peso, $paquetes, $servicio );

//devolucion del resultado en json
echo $output; 

?>