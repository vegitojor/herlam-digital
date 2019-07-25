<?php 

// require_once("../clases/ConexionBDClass.php");
// require_once ("../clases/ClienteClass.php");
require_once ("../clases/EnvioPackClass.php");

//se capturan los datos del ajax
$data = json_decode(file_get_contents("php://input"));

$provincia = strip_tags($data->provincia);
$localidad = strip_tags($data->localidad);
$peso = strip_tags($data->peso);
$paquetes = strip_tags($data->paquetes);
$correo = strip_tags($data->correo);

//array para almacenar resultados
$output = array();

$envioPack = new EnvioPack();

$output = $envioPack->calcularCostoEnvioSucursal( $provincia, $localidad, $peso, $paquetes, $correo );

//devolucion del resultado en json
echo $output; 
