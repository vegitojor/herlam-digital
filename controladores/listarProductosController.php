<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 5/12/17
 * Time: 22:49
 */
include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/ProductoClass.php');

//DATOS DEL AJAX
$data = json_decode(file_get_contents('php://input'));

$desde = strip_tags($data->desde);
$limite = strip_tags($data->limite);

//CONEXION A BASE DE DATOS
$conn = new ConexionBD();
$conexion = $conn->getConexion();

$output = array();
$output = Producto::cargarProductos($conexion, $desde, $limite);

echo json_encode($output);