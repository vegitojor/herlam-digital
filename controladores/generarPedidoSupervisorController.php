<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 12/10/17
 * Time: 22:56
 */

include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/PedidoClass.php');

//se capturan los datos del Ajax
$data = json_decode(file_get_contents('php://input'));

// $id = null;
$idPedido = strip_tags($data->pedido);
$productos = $data->productos;
$fecha = strip_tags($data->fecha);

// $fichaTecnica = (int)$fichaTecnica;

//Conexion a la BD
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//Generamos el pedidoSupervisor
$idPedidoSupervisor = Pedido::guardarPedidoSupervisor($conexion, $idPedido, $fecha);

//se recorre el array de productos para setear el id de pedidoSupervisor
foreach ($productos as $producto) {
    
    Pedido::setPedidoSupervisorACarritoCompra($conexion, $idPedidoSupervisor, $producto->id);
}
//cerramos conexion con BD
$conn->cerrarConexion();

$mensaje = ['mensaje'=>1,];

echo json_encode($mensaje);