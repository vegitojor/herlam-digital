<?php 
require_once('../clases/ConexionBDClass.php');
require_once('../clases/ClienteClass.php');
require_once('../clases/LoginClass.php');

//toma de datos desde llamado ajax
$data = json_decode(file_get_contents('php://input'));

$email = strip_tags($data->email);
$pass = md5($data->pass);
$userAgent = strip_tags($data->userAgent);


$fecha=  date("Y-m-d H:i:s");
$time = time();



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
	$cliente = Cliente::ObtenerCliente($conexion, $email, $pass);
	
	if($cliente['admin'] == 1 || $cliente['supervisor'] ){
		session_destroy();
		ini_set('session.cookie_lifetime', '0');
		ini_set('session.hash_bits_per_character','4');
		ini_set('session.hash_function', 'sha256');
		ini_set('session.cookie_samesite', 'Strict');
		session_start();
	}
	$_SESSION['usuario'] = $cliente;
	$mensaje = ['respuesta'=> 1,];
	$mensaje['admin'] = $_SESSION['usuario']['admin'];

	Login::registrarLogin($conexion, $cliente['id'], $fecha, $time, $userAgent );

	echo json_encode($mensaje);
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