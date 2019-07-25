<?php

include_once ('../../clases/ConexionBDClass.php');
include_once ('../../clases/ProductoClass.php');

//se obtienen datos del ajax
$data = json_decode(file_get_contents('php://input'));

//se setean variables locales
$idProducto = strip_tags($data->idProducto);
$todas = strip_tags($data->todas);
$todas = (int)$todas;

//Se inicializa la conexion a la base de datos
$conn = new ConexionBD();
$conexion = $conn->getConexion();


//Se ejecuta la funcion de la clase y se optienen los resultados
$output = Producto::listarPreguntasYRespuestas($conexion, $idProducto, $todas);

//se cierra la conexion
$conn->cerrarConexion();

//para que se muestren correctamente acentos y ñ
header("Content-Type: text/html; charset=iso-8859-1");  
//Se devuelven los resultados
echo json_encode($output);