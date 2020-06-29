<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 24/09/17
 * Time: 3:47
 */
include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/proveedorClass.php');

//conexion con la BD
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//array para almacenar resultado
$output = array();

//consulta a la BD
$output = Proveedor::listarProveedores($conexion);

echo json_encode($output);