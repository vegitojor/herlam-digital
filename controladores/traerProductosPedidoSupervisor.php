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
//OBTENEMOS LOS DATOS DEL AJAX
$data = json_decode(file_get_contents('php://input'));
$idPedido = strip_tags($data->idPedido);
$idPedido = (int)$idPedido;



//CONEXION DE DB
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//LISTAR CATEGORIAS
$categorias = Pedido::listarProductosCarritoPorIdPedidoSupervisor($conexion, $idPedido);

//CERRAR CONEXION A BD
$conn->cerrarConexion();
echo json_encode($categorias);