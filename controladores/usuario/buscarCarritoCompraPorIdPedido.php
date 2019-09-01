<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 10/12/17
 * Time: 22:29
 */

include_once('../../clases/ConexionBDClass.php');
include_once('../../clases/PedidoClass.php');

$data = json_decode(file_get_contents('php://input'));

$idPedido = $data->idPedido;
$idPedido = (int)$idPedido;

$conn = new ConexionBD();
$conexion = $conn->getConexion();

// $pedido = new Pedido($idPedido);
$resultado = Pedido::listarProductosCarritoPorIdPedido($conexion, $idPedido);

//SE CIERRA LA CONEXION A LA BD
$conn->cerrarConexion();

echo json_encode($resultado);