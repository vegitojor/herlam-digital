<?php 
require_once('../clases/ConexionBDClass.php');
require_once('../clases/ClienteClass.php');

error_reporting('E_ALL ^ E_NOTICE');

//toma de datos desde llamado ajax
$data = json_decode(file_get_contents('php://input'));

$id = Null;
$nombre = strip_tags($data->nombre);

$apellido = strip_tags($data->apellido);
$email = strip_tags($data->email);
$pass = md5($data->pass);

$telefono = Null;
if( isset($data->telefono) )
	$telefono = strip_tags($data->telefono);

$fechaNacimiento = Null;
if( isset($data->fechaNacimiento) )
	$fechaNacimiento = strip_tags($data->fechaNacimiento);

$domicilio = Null;
if( isset($data->direccion) )
	$domicilio = strip_tags($data->direccion);

$codPostal = Null;
if( isset($data->codPostal) )
	$codPostal = (int)strip_tags($data->codPostal);

$localidad = Null;
if( isset($data->localidad) ){
	
	$localidad = (int)strip_tags($data->localidad);
}


$admin = 0;
$usuario = Null;


//inicializacion de conexion BD
$objetoConexion = new ConexionBD();
$conexion = $objetoConexion->getConexion();

//inicializacion de Cliente
$usuario = new Cliente($id,
						$nombre,
						$usuario,
						$apellido,
						$telefono,
						$email,
						$fechaNacimiento,
						$pass,
						$codPostal,
						$domicilio,
						$admin,
						$localidad);

//comprobacion de que no existe el email en la BD
$listaEmail = Cliente::listarEmail($conexion);
$emailSinRegistrar = true;
foreach ($listaEmail as $emailBD) {
	if($emailBD == $email){
		$emailSinRegistrar = false;
		break;
	}
}

//si no existe el email se realiza la persistencia de datos
$mensaje = array();
if($emailSinRegistrar){
	$idUsuario = $usuario->persistirse($conexion);
    ini_set('session.cookie_lifetime', "600");
    ini_set('session.hash_bits_per_character','4');
    ini_set('session.hash_function', 'sha256');
	session_start();
	$_SESSION['usuario'] = $usuario->getArraySession($conexion, $idUsuario);
	$mensaje = ['respuesta' => 1,];
	echo json_encode($mensaje);
}else{
	
	$mensaje = ['respuesta' => 0,];
	echo json_encode($mensaje);
}

?>