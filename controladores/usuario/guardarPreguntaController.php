<?php

include_once ('../../incluciones/verificacionUsuario.php');
include_once ('../../clases/ConexionBDClass.php');
include_once ('../../clases/ProductoClass.php');

$data = json_decode(file_get_contents('php://input'));

if(isset($data->idUsuario)){
	$idUsuario = strip_tags($data->idUsuario);
	if($idUsuario == 0){
		$idUsuario = null;
	}
}else{
	$idUsuario = null;
}

if(isset($data->pregunta)){
	$pregunta = strip_tags($data->pregunta);
	$pregunta = utf8_decode($pregunta);
}else{
	$pregunta = null;
}

if (isset($data->idProducto)) {
	$idProducto = strip_tags($data->idProducto);
}else{
	$idProducto = null;
}

if (isset($data->fecha)) {
	$fecha = strip_tags($data->fecha);
}else{
	$fecha = null;
}

$respondida = 0;


//Conexion con base de datos
$conn = new ConexionBD();
$conexion = $conn->getConexion();

if($idProducto == null || $pregunta == null){
	$conn->cerrarConexion();
	$mensaje = ['respuesta' => 0,];
    echo json_encode($mensaje);
}else{
	//SE GUARDA LA PREGUNTA
	$respuesta = Producto::guardarPregunta($conexion, $pregunta, $respondida, $idUsuario, $idProducto, $fecha);

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
}

