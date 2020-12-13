<?php
require_once('../clases/ConexionBDClass.php');
require_once('../clases/NotificacionClass.php');
require_once('./mailService.php');

function guardarNotificacion($destinatarios, $asunto, $mensaje, $fecha, $usuario){
    //guardar cantidad de mail. calcular con el length de destinatarios
    $cantidad = count($destinatarios);
    $destinatarios = implode(";", $destinatarios);

    

    //guardar en BD
    Notificacion::guardarNotificacion(getConexion(),$destinatarios,$asunto, $mensaje, $fecha, $usuario, $cantidad);
}

function buscarDestinatarios($destino){
    //Construir where para la busqueda de mails - WIP

    //Realizar busqueda a traves de la Clase. Actualmente devolvera todos los usuarios activos.
     
    //retornar array de mails
    return Notificacion::obtenerDestinatarios(getConexion());
}

function enviarNotificacion($destinatarios, $asunto, $mensaje){
    $destinatario_string = implode(";", $destinatarios);
    enviarMail($destinatario_string, $asunto, $mensaje);
}

function getConexion(){
    //conexion con DB
    $conn = new ConexionBD();
    return $conn->getConexion();
}

function listarNotificacionesEnviadas(){
    return Notificacion::getNotificacionesEnviadas(getConexion());
}
