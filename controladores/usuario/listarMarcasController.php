<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 9/12/17
 * Time: 2:23
 */

include_once ('../../clases/ConexionBDClass.php');
include_once ('../../clases/MarcaClass.php');

//DATOS DEL AJAX

//CONEXION DE DB
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//LISTAR CATEGORIAS
$marcas = Marca::listarMarcas($conexion);

echo json_encode($marcas);