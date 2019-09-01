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

$desde = (int)strip_tags($data->desde);
$limite = (int)strip_tags($data->limite);

//CONEXION DE DB
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//LISTAR CATEGORIAS
$categorias = Pedido::listarPedidos($conexion, $estado, $cliente, $pedido, $desde, $limite);

//CERRAR CONEXION A BD

echo json_encode($categorias);