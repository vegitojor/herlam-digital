<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 14/10/17
 * Time: 23:07
 */
include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/MarcaClass.php');

$data = json_decode(file_get_contents("php://input"));

$id = null;
$descripcion = strip_tags($data->descripcion);

//instanciacion de clese coneccion
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//instanciación de clase marca
$marca = new Marca($id, $descripcion);

//persistencia
$marca->persistirse($conexion);

$respuesta = ['mensaje'=>1,];

echo json_encode($respuesta);