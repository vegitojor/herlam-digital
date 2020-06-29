<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 24/10/17
 * Time: 23:54
 */

include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/CategoriaClass.php');

//DATOS DEL AJAX
$data = json_decode(file_get_contents('php://input'));

$nombreAEditar = strip_tags( $data->nombreAEditar);
$idCategoria = strip_tags($data->categoria);
$idCategoria = (int)$idCategoria;

//CONEXION DE DB
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//Editar CATEGORIAS
$categoria = new Categoria($idCategoria);
$retorno = $categoria->editarCategoria($conexion, $nombreAEditar);

//CERRAR LA CONEXION A LA BASE DE DATOS

//devolver respuesta
if($retorno > 0) {
    $mensaje = ['respuesta' => 1,];
    echo json_encode($mensaje);
}
elseif ($retorno == 0) {
    $mensaje = ['respuesta' => 0,];
    echo json_encode($mensaje);
}
elseif ($retorno < 0) {
    $mensaje = ['respuesta' => 2,];
    echo json_encode($mensaje);
}
else {
    $mensaje = ['respuesta' => 3,];
    echo json_encode($mensaje);
}