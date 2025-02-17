<?php
require_once('../clases/ConexionBDClass.php');
require_once('../clases/NotificacionClass.php');
require_once('./mailService.php');

    
function guardarNotificacion($destinatarios, $asunto, $mensaje, $fecha, $usuario, $cantidad){
    //guardar cantidad de mail. calcular con el length de destinatarios
    // $cantidad = count($destinatarios);
    // $destinatarios = implode(";", $destinatarios);

    

    //guardar en BD
    Notificacion::guardarNotificacion(getConexion(),$destinatarios,$asunto, $mensaje, $fecha, $usuario, $cantidad);
}

function contarDestino($destino){
    if($destino == null){
        return count(Notificacion::obtenerDestinatarios(getConexion()));
    }else{
        return count(explode(";", $destino));
    }
}

function buscarDestinatarios($destino){
    if($destino == null)
        return implode(";", Notificacion::obtenerDestinatarios(getConexion()));
    else
        return $destino;
    
}

function enviarNotificacion($destinatarios, $asunto, $mensaje){
    // $destinatario_string = implode(";", $destinatarios);
    enviarMail($destinatarios, $asunto, $mensaje);
}

function getConexion(){
    //conexion con DB
    $conn = new ConexionBD();
    return $conn->getConexion();
}

function listarNotificacionesEnviadas($desde, $limite){
    return Notificacion::getNotificacionesEnviadas(getConexion(), $desde, $limite);
}

function contarCantidadNotificaciones(){
    return Notificacion::contarCantidadNotificacionesEnviadas(getConexion());
}
