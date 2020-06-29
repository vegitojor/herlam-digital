<?php

include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/ProductoClass.php');

//se obtienen datos del ajax
$data = json_decode(file_get_contents('php://input'));

//se setean variables locales
$idPregunta = strip_tags($data->idPregunta);
$idPregunta = (int)$idPregunta;

$respuesta = strip_tags($data->respuesta);
$fecha = strip_tags($data->fecha);



//conexion a BD
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//guardar respuesta
$retorno = Producto::guardarRespuesta($conexion, $idPregunta, $respuesta, $fecha);

//update de pregunta a respondida
if($retorno > 0){
	Producto::cambiarEstadoPreguntaARespondida($conexion, $idPregunta);
}

//cerrar conexion
$conn->cerrarConexion();

//devolver respuesta
if($retorno > 0) {
    $mensaje = ['respuesta' => 1,];
    echo json_encode($mensaje);
}
elseif ($retorno == 0) {
    $mensaje = ['respuesta' => 0,];
    echo json_encode($mensaje);
}
elseif ($retorno < 0) {
    $mensaje = ['respuesta' => 2,];
    echo json_encode($mensaje);
}
else {
    $mensaje = ['respuesta' => 3,];
    echo json_encode($mensaje);
}