<?php
include_once('../incluciones/adminControlerVerificacion.php');
include_once('./notificacionService.php');

$data = json_decode(file_get_contents("php://input"));

$desde = strip_tags($data->desde);
$limite = strip_tags($data->limite);


$notificaciones = listarNotificacionesEnviadas($desde, $limite);



echo json_encode($notificaciones);