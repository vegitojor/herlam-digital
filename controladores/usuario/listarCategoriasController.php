<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 9/12/17
 * Time: 2:23
 */

include_once('../../clases/ConexionBDClass.php');
include_once('../../clases/CategoriaClass.php');

//DATOS DEL AJAX

//CONEXION DE DB
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//LISTAR CATEGORIAS
$categorias = Categoria::listarCategorias($conexion);

//SE CIERRA LA CONEXION DE LA BASE DE DATOS
$conn->cerrarConexion();

echo json_encode($categorias);