<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 23/10/17
 * Time: 23:55
 */

include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/MonedaClass.php');

$data = json_decode(file_get_contents('php://input'));

$id = $data->idMoneda;

//CONEXION CON BD
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//BUSQUEDA DE LA INFO
$respuesta = Moneda::obtenerUnaMonedaPorId($conexion, $id);

echo json_encode($respuesta);