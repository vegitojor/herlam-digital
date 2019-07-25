<?php 
require_once('../clases/ConexionBDClass.php');
require_once('../clases/ClienteClass.php');

//toma de datos desde llamado ajax
$data = json_decode(file_get_contents('php://input'));

$email = strip_tags($data->email);
$pass = md5($data->pass);


/*
//se realiza adaptacion del controller para evitar el llamado ajax
$email = strip_tags($_POST['emailLogin']);
$pass = md5($_POST['passLogin']);
*/

//se crea objeto y se pide conexion a BD
$objetoConexion = new ConexionBD();
$conexion = $objetoConexion->getConexion();

//se consulta la existencia del usuario en la BD
$emailRegistrado = Cliente::consultarCliente($conexion, $email, $pass);

//se crea la sesion en base a la respuesta de la funcion anterior
$mensaje = array();

//inicio de sesion
ini_set('session.cookie_lifetime', "600");
ini_set('session.hash_bits_per_character','4');
ini_set('session.hash_function', 'sha256');
session_start();

if($emailRegistrado){
	//carga de datos a la sesion
	$_SESSION['usuario'] = Cliente::ObtenerCliente($conexion, $email, $pass);

	$mensaje = ['respuesta'=> 1,];
	$mensaje['admin'] = $_SESSION['usuario']['admin'];
	echo json_encode($mensaje);
	//header('location: ../index.php');
}else if($emailRegistrado == Null){
	session_destroy();
	$mensaje = ['respuesta'=> 0,];
	echo json_encode($mensaje);
}else{
	session_destroy();
	$mensaje = ['respuesta' => 2,];
	echo json_encode($mensaje);
}


?>