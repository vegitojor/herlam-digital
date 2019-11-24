<?php 
require_once('../clases/ConexionBDClass.php');
require_once('../clases/ClienteClass.php');

//toma de datos desde llamado ajax
$data = json_decode(file_get_contents('php://input'));

$newPass = $data->newPass;
$pass = $data->pass;
$id = (int) $data->id;


//se crea objeto y se pide conexion a BD
$objetoConexion = new ConexionBD();
$conexion = $objetoConexion->getConexion();

$storedPass = Cliente::obtenerPassUsuarioById($conexion, $id);

$mensaje = array();
if($storedPass['pass'] == md5($pass)){
	//se consulta la existencia del usuario en la BD
	$resultado = Cliente::cambiarPass($conexion, $id, md5($newPass));
	$mensaje = ['respuesta'=> 1,];
}else{
	$mensaje = ['respuesta'=> 2,];
}

echo json_encode($mensaje);

?>