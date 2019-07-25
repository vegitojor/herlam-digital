<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 11/10/17
 * Time: 0:08
 */


include_once('../incluciones/adminControlerVerificacion.php');
include_once ("../clases/ConexionBDClass.php");
include_once ("../clases/ProductoClass.php");

//Objeto conecion BD
$conn = new ConexionBD();
$conexion = $conn->getConexion();

$output = array();

$output = Producto::cargarFichasTecnicas($conexion);

echo json_encode($output);
