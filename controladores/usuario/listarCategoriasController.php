<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 9/12/17
 * Time: 2:23
 */

include_once ('../../clases/ConexionBDClass.php');
include_once ('../../clases/CategoriaClass.php');

//DATOS DEL AJAX

//CONEXION DE DB
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//LISTAR CATEGORIAS
$categorias = Categoria::listarCategorias($conexion);

echo json_encode($categorias);