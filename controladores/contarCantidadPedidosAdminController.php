<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 24/10/17
 * Time: 23:54
 */

include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/PedidoClass.php');

//DATOS DEL AJAX
$data = json_decode(file_get_contents('php://input'));

// $id = strip_tags($data->id);
$estado = 1;
if(isset($data->estado)){
    // var_dump($data->estado);
    // var_dump($estado);
    // die();
    $estado = strip_tags($data->estado);
    $estado = (int)$estado;
}

$cliente = 0;
if(isset($data->cliente)){
    $cliente = strip_tags($data->cliente);
    $cliente = (int)$cliente;
}

$pedido = 0;
if(isset($data->pedido)){
    $pedido = strip_tags($data->pedido);
    $pedido = (int)$pedido;
}

//CONEXION DE DB
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//LISTAR CATEGORIAS
$cantidad = Pedido::contarCantidadPedidosAdmin($conexion, $estado, $cliente, $pedido);

$conn->cerrarConexion();

echo json_encode($cantidad);