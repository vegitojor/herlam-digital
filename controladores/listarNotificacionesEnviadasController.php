<?php
include_once('../incluciones/adminControlerVerificacion.php');
include_once('./notificacionService.php');

$notificaciones = listarNotificacionesEnviadas();



echo json_encode($notificaciones);