<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 21/10/17
 * Time: 10:15
 */
include_once('../incluciones/adminControlerVerificacion.php');
include_once('../clases/ConexionBDClass.php');
include_once('../clases/ClienteClass.php');
include_once('./mailService.php');

//OBTENEMOS LOS DATOS DEL AJAX
$data = json_decode(file_get_contents('php://input'));
$idUsuario = strip_tags($data->usuario);
$idUsuario = (int)$idUsuario;

$permiso = strip_tags($data->permiso);
$activo = 0;
if($permiso == 1){
    $activo = 1;
}

//CONEXION CON BD
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//LISTADO DE ClienteClass
$respuesta = Cliente::activarCliente($conexion, $idUsuario, $activo);

//SE CIRERRA CONEXION A BASE DE DATOS
$conn->cerrarConexion();

//SE ENVIA MAIL DE ACTIVACION AL USUARIO
if($activo == 1){

    //BUSCAMOS EL MAIL DEL USUARIO

    $to = Cliente::obtenerMailUsuarioById($conexion, $idUsuario);

    $subject = 'Herlam Digital - Su cuenta de usuario fue activada';

    $mensaje = '<h1>¡Bienvenido!</h1>';

    $mensaje .= '<p>Gracias por registrarte en el sistema de Herlam Digital.</p>';
    $mensaje .= '<p>A partir de este momento, tu usuario esta activo. Ya puedes ingresar al sitio desde <a href="https://digital.herlam.com.ar" target="_blank">Aqu&iacute;</a>. ¡Descubre las novedades que tenemos para t&iacute;!</p>';
    $mensaje .= '<br><p>Muchas gracias</p>';

    enviarMail($to, $subject, $mensaje);
}

//SE DEVUELVE RESPUESTA SEGUN EL VALOR RESULTADO DE LA BASE DE DATOS
if($respuesta > 0) {
    $mensaje = ['respuesta' => 1,];
    echo json_encode($mensaje);
}
elseif ($respuesta == 0) {
    $mensaje = ['respuesta' => 0,];
    echo json_encode($mensaje);
}
elseif ($respuesta < 0) {
    $mensaje = ['respuesta' => 2,];
    echo json_encode($mensaje);
}
else {
    $mensaje = ['respuesta' => 3,];
    echo json_encode($mensaje);
}