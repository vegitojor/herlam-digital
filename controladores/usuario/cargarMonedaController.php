<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 17/12/17
 * Time: 19:02
 */


include_once ('../../clases/ConexionBDClass.php');
include_once ('../../clases/MonedaClass.php');

$output = array();

$conn = new ConexionBD();
$conexion = $conn->getConexion();

$output = Moneda::traerMonedaActiva($conexion);

//SE CIERRA LA CONEXION DE LA BASE DE DATOS
$conn->cerrarConexion();

echo json_encode($output);