<?php

include_once ('../../incluciones/verificacionUsuario.php');
include_once ('../../clases/ConexionBDClass.php');
// include_once ('../../clases/ProductoClass.php');
include_once ('../../clases/PedidoClass.php');
// include_once ('../../clases/PedidoClass.php');

$data = json_decode(file_get_contents('php://input'));

$idUsuario = null;
if(isset($data->idUsuario)){
	$idUsuario = strip_tags($data->idUsuario);
}

$localidad = null;
if (isset($data->localidad)) {
	$localidad = strip_tags($data->localidad);
}

$domicilio = null;
if (isset($data->domicilio)) {
	$domicilio = strip_tags($data->domicilio);
}

$piso = null;
if (isset($data->piso)) {
	$piso = strip_tags($data->piso);
}

$codigoPostal = null;
if (isset($data->codigoPostal)) {
	$codigoPostal = strip_tags($data->codigoPostal);
}

$cuitCuil = null;
if (isset($data->cuitCuil)) {
	$cuitCuil = strip_tags($data->cuitCuil);
}

$depto = null;
if (isset($data->depto)) {
	$depto = strip_tags($data->depto);
}

$condicionIva = null;
if (isset($data->condicionIva)) {
	$condicionIva = strip_tags($data->condicionIva);
}

$fecha = null;
if (isset($data->fechaActual)) {
	$fecha = strip_tags($data->fechaActual);
}

$tipoEnvio = strip_tags($data->tipoEnvio);
$tipoEnvio = (int)$tipoEnvio;

$diaEnvio = null;
if (isset($data->diaEnvio)) {
	$diaEnvio = (int)strip_tags($data->diaEnvio);
}

$horarioEnvio = null;
if (isset($data->horarioEnvio)) {
	$horarioEnvio = (int)strip_tags($data->horarioEnvio);
}


//Conexion con base de datos
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//Guardo inicializo el pedido y lo persisto
$pedido = new Pedido(null, $idUsuario, $fecha, 1, $localidad, $domicilio, $codigoPostal, $piso, $depto, $tipoEnvio, $diaEnvio, $horarioEnvio);
$idPedido = $pedido->persistirse($conexion);

//ACTUALIZO LOS PRODUCTOS DEL CARRITO
$respuesta = $pedido->updateCarrito($conexion, $idPedido);


$mensaje = array();
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

