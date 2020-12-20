<?php
include_once('../incluciones/adminControlerVerificacion.php');
include_once('./notificacionService.php');

//LISTAR Notificaciones
$cantidad = contarCantidadNotificaciones();

echo json_encode($cantidad);