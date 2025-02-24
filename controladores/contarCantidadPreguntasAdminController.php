<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 15/02/25
 * Time: 23:54
 */

include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/ProductoClass.php');

//CONEXION DE DB
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//LISTAR CATEGORIAS
$cantidad = Producto::contarCantidadPreguntasAdmin($conexion, 0);
$cantidadConRespuesta = Producto::contarCantidadPreguntasAdmin($conexion, 1);
$conn->cerrarConexion(); 
echo json_encode([
    'cantidad' => $cantidad['cantidad'], 
    'cantidadConRespuesta'=> $cantidadConRespuesta['cantidad'],
]);