<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 27/10/17
 * Time: 0:50
 */

include_once('../incluciones/verificacionUsuario.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/ProductoClass.php');

//OBTENER DATOS DEL AJAX
$data = json_decode(file_get_contents('php://input'));

$idCategoria = $data->idCategoria;
$idCategoria = (int)$idCategoria;

//CONEXION CON BD
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//carga de FICHA TECNICA
$respuesta = Producto::cargarFichaTecnicaPorIdCategoria($conexion, $idCategoria);

echo json_encode($respuesta);

