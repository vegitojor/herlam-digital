<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 17/12/17
 * Time: 19:02
 */


include_once ('../../clases/ConexionBDClass.php');
include_once ('../../clases/PedidoClass.php');

session_start();

//TOMO LOS DATOS DEL AJAX DEL JS
$data = json_decode(file_get_contents('php://input'));

$usuario = strip_tags($data->usuario);
$usuario = (int)$usuario;

//CREO LA CONEXION A LA BASE DE DATOS
$conn = new ConexionBD();
$conexion = $conn->getConexion();


//BUSCO TODOS LOS PRODUCTOS QUE EL USUARIO AGREGO AL CARRITO
$output = Pedido::cargarPedidos($conexion, $usuario);

// var_dump($output);
// die();
//CIERRO CONEXION A BASE DE DATOS
$conn->cerrarConexion();

//RETORNO LOS DATOS OBTENIDOS
echo json_encode($output);








