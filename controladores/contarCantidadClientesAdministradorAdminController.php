<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 24/10/17
 * Time: 23:54
 */

include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/ClienteClass.php');

//DATOS DEL AJAX
// $data = json_decode(file_get_contents('php://input'));



//CONEXION DE DB
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//LISTAR CATEGORIAS
$cantidad = Cliente::contarCantidadAdministradores($conexion);

$conn->cerrarConexion();

echo json_encode($cantidad);