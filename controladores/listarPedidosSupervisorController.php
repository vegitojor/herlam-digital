<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 24/10/17
 * Time: 23:54
 */

include_once('../incluciones/adminControlerVerificacion.php');
include_once('../clases/ConexionBDClass.php');
include_once('../clases/PedidoClass.php');

//DATOS DEL AJAX
$data = json_decode(file_get_contents('php://input'));

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
$categorias = Pedido::listarPedidosSupervisor($conexion, $pedido, $desde, $limite);

//CERRAR CONEXION A BD
$conn->cerrarConexion();

echo json_encode($categorias);