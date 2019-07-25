<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 15/10/17
 * Time: 0:24
 */

include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/MarcaClass.php');

//conexion BD
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//listado de marcas
$marcas = Marca::listarMarcas($conexion);

echo json_encode($marcas);