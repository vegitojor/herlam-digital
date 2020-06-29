<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 15/10/17
 * Time: 1:59
 */


include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/MarcaClass.php');

//datos desde ajax
$data = json_decode(file_get_contents('php://input'));

$id = strip_tags($data->id);
$descripcion = strip_tags($data->descripcion);

$id = (int)$id;

//conexion BD
$conn = new  ConexionBD();
$conexion = $conn->getConexion();

//edición de la marca
Marca::editarMarca($conexion, $id, $descripcion);

$respuesta = ['mensaje'=>1,];

echo json_encode($respuesta);
