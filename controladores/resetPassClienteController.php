<?php 
require_once('../clases/ConexionBDClass.php');
require_once('../clases/ClienteClass.php');
include_once('./mailService.php');

//toma de datos desde llamado ajax
$data = json_decode(file_get_contents('php://input'));

// $newPass = $data->newPass;
// $pass = $data->pass;
$id = (int) $data->id;


//se crea objeto y se pide conexion a BD
$objetoConexion = new ConexionBD();
$conexion = $objetoConexion->getConexion();

// $storedPass = Cliente::obtenerPassUsuarioById($conexion, $id);

$mail = Cliente::obtenerMailUsuarioById($conexion, $id);

$resultado = Cliente::cambiarPass($conexion, $id, md5("herlam"));
$respuesta = ['respuesta'=> 1,];

$to = $mail['email'];
$subject = 'Herlam Digital - Su clave de usuario fue modificada';

$mensaje = '<h1>¡Su clave a cambiado!</h1>';

$mensaje .= '<p>El administrador de Herlam Digital a realizado un reinicio de su clave.</p>';
$mensaje .= '<p>A partir de este momento, para acceder a su cuenta deber&aacute; introducir su nueva clave. La nueva clave es <strong>herlam</strong>. Se recomienda modificarla por una clave propia y no conocida por otros usuarios.</p>';
$mensaje .= '<p>En el caso que usted no haya solicitado este reinicio de clave, por favor contacte al administrador lo antes posible.</p>';
$mensaje .= '<br><p>Muchas gracias</p>';

enviarMail($to, $subject, $mensaje);

echo json_encode($respuesta);

?>