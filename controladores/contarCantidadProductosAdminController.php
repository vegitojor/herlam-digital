<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 24/10/17
 * Time: 23:54
 */

include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/ProductoClass.php');

//DATOS DEL AJAX


//CONEXION DE DB
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//LISTAR CATEGORIAS
$cantidad = Producto::contarCantidadProductosAdmin($conexion);

echo json_encode($cantidad);