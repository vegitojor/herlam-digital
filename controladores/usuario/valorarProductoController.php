<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 27/12/17
 * Time: 21:34
 */

include_once ('../../incluciones/verificacionUsuario.php');
include_once ('../../clases/ConexionBDClass.php');
include_once ('../../clases/ProductoClass.php');

$data = json_decode(file_get_contents('php://input'));

$idUsuario = strip_tags($data->usuario);
$idProducto = strip_tags($data->producto);

$conn = new ConexionBD();
$conexion = $conn->getConexion();

$respuesta = Producto::valorarProducto($conexion, $idUsuario, $idProducto);

$mensaje = array();
$conn->cerrarConexion();
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
