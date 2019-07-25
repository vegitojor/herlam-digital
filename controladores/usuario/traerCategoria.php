<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 10/12/17
 * Time: 22:29
 */

include_once ('../../clases/ConexionBDClass.php');
include_once ('../../clases/CategoriaClass.php');

$data = json_decode(file_get_contents('php://input'));

$idCategoria = $data->categoria;
$idCategoria = (int)$idCategoria;

$conn = new ConexionBD();
$conexion = $conn->getConexion();

$categotria = new Categoria($idCategoria);
$resultado = $categotria->traerNombreCategoria($conexion);

//SE CIERRA LA CONEXION A LA BD
$conn->cerrarConexion();

echo json_encode($resultado);