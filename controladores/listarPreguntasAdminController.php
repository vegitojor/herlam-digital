<?php

include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/ProductoClass.php');

//se obtienen datos del ajax
$data = json_decode(file_get_contents('php://input'));

//se setean variables locales
$sinRespuesta = strip_tags($data->sinRespuesta);
$desde = strip_tags($data->desde);
$limite = strip_tags($data->limite);
$sinRespuesta = (int)$sinRespuesta;
$desde = (int)$desde;
$limite = (int)$limite;


//Se inicializa la conexion a la base de datos
$conn = new ConexionBD();
$conexion = $conn->getConexion();


//Se ejecuta la funcion de la clase y se optienen los resultados
$output = Producto::listarPreguntasSinRespuestas($conexion, $sinRespuesta, $desde, $limite);


//se cierra la conexion
$conn->cerrarConexion();

//Se devuelven los resultados
echo json_encode($output);