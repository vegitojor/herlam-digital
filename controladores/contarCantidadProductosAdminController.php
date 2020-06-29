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
$data = json_decode(file_get_contents('php://input'));

$id = 0;
if(isset($data->id)){
    if(is_int($data->id))
        $id = $data->id;
}

$modelo = null;
if(isset($data->modelo))
    $modelo = strip_tags($data->modelo);


//CONEXION DE DB
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//LISTAR CATEGORIAS
$cantidad = Producto::contarCantidadProductosAdmin($conexion, $id, $modelo);
$conn->cerrarConexion(); 
echo json_encode($cantidad);