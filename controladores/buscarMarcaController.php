<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 15/10/17
 * Time: 1:37
 */

include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/MarcaClass.php');

//datos del ajax
$data = json_decode(file_get_contents('php://input'));

$id = strip_tags($data->id);
$id = (int)$id;

//conexion con DB
$conn = new ConexionBD();
$conexion = $conn->getConexion();


//busqueda de información
$respuesta = Marca::buscarMarcaPorId($conexion, $id);


echo json_encode($respuesta);