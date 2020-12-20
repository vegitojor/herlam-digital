<?php
include_once('../incluciones/adminControlerVerificacion.php');
include_once('./notificacionService.php');

$data = json_decode(file_get_contents("php://input"));

$destino = null;
if($data->destino != null)
    $destino = strip_tags($data->destino);


$asunto = strip_tags($data->asunto);
$mensaje = $data->mensaje;
$fecha = strip_tags($data->fecha);


$usuario = $_SESSION['usuario']['id'];


//buscar destinatarios
$destinatarios = buscarDestinatarios($destino);
$cantidadDestinatarios = contarDestino($destino);

//validar existencia de destinatarios

//guardar notificacion
guardarNotificacion($destinatarios, $asunto, htmlentities($mensaje), $fecha, $usuario, $cantidadDestinatarios);



//enviar notificacion
enviarNotificacion($destinatarios, $asunto, $mensaje);


$respuesta = ['mensaje'=>1,];

echo json_encode($respuesta);