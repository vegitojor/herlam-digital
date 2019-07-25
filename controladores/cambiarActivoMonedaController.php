<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 21/10/17
 * Time: 13:36
 */

include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/MonedaClass.php');

//obtencion de datos del AJAX
$data = json_decode(file_get_contents('php://input'));

$id = strip_tags($data->idMoneda);
$activo = strip_tags($data->activo);

//CONEXION CON BD
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//PERSISTIR LA MONEDA
$respuesta = Moneda::cambiarActivoMoneda($conexion, $id, $activo);

//SE DEVUELVE LA RESPUESTA
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

