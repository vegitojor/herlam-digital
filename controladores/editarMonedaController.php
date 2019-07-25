<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 24/10/17
 * Time: 22:17
 */
include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/MonedaClass.php');


$data = json_decode(file_get_contents('php://input'));

$id = strip_tags($data->idMoneda);
$id = (int)$id;

$descripcion = strip_tags($data->descripcion);
$valor = strip_tags($data->valor);
$valor = number_format($valor,2, '.', '');
$activo = strip_tags($data->activo);
$activo = (int)$activo;


//CONEXION CON BD
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//UPDATE DE LA MONEDA
$moneda = new Moneda($id, $descripcion, $valor, $activo);

$moneda->editarMoneda($conexion);

$respuesta = ['mensaje'=>1,];

echo json_encode($respuesta);

