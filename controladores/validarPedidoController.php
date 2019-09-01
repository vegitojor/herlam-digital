<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 21/10/17
 * Time: 10:15
 */
include_once('../incluciones/adminControlerVerificacion.php');
include_once('../clases/ConexionBDClass.php');
include_once('../clases/PedidoClass.php');
//OBTENEMOS LOS DATOS DEL AJAX
$data = json_decode(file_get_contents('php://input'));
$idPedido = strip_tags($data->idPedido);
$idPedido = (int)$idPedido;

//CONEXION CON BD
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//defino el id de estado_pedido = cancelado
$proximoEstado = null;
$estado = (int)strip_tags($data->idEstadoPedido);
switch($estado){
    case 1:
        $proximoEstado = 2;
        break;
    case 2:
        $proximoEstado = 3;
        break;
    case 3:
        $proximoEstado = 4;
        break;
    case 4:
        $proximoEstado = 5;
        break;
}
//LISTADO DE ClienteClass
$respuesta = Pedido::cambiarEstado($conexion, $idPedido, $proximoEstado);

//SE CIRERRA CONEXION A BASE DE DATOS
$conn->cerrarConexion();

//SE DEVUELVE RESPUESTA SEGUN EL VALOR RESULTADO DE LA BASE DE DATOS
if($respuesta > 0) {
    $mensaje = ['respuesta' => 1,];
    echo json_encode($mensaje);
}
elseif ($respuesta == 0) {
    $mensaje = ['respuesta' => 0,];
    echo json_encode($mensaje);
}
elseif ($respuesta < 0) {
    $mensaje = ['respuesta' => 2,];
    echo json_encode($mensaje);
}
else {
    $mensaje = ['respuesta' => 3,];
    echo json_encode($mensaje);
}