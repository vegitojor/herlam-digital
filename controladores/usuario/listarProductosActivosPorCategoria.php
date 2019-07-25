<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 9/12/17
 * Time: 13:53
 */

include_once ('../../clases/ConexionBDClass.php');
include_once ('../../clases/ProductoClass.php');

//se toman los datos del ajax
$data = json_decode(file_get_contents('php://input'));

$idCategoria = strip_tags($data->idCategoria);

$desde = strip_tags($data->desde);
$desde = (int)$desde;


$limite = strip_tags($data->limite);
$limite = (int)$limite;


// SE VERIFICA QUE EXISTA VALOR EN CADA VARIABLE CAMPO
$destacados = 0;
if(isset($data->destacados)){
	if($data->destacados){
		$destacados = 1;
	}
}

$orden = (int) strip_tags($data->orden);


if(isset($data->marcaFiltro)){
	$marcaFiltro = strip_tags($data->marcaFiltro);
	$marcaFiltro = (int)$marcaFiltro;
}else{
	$marcaFiltro = 0;
}

if(isset($data->campo01->campo01)){
	$campo01 = strip_tags($data->campo01->campo01);
}else{
	$campo01 = '%';
}
if(isset($data->campo02)){
	$campo02 = strip_tags($data->campo02->campo02);
}else{
	$campo02 = '%';
}
if(isset($data->campo03)){
	$campo03 = strip_tags($data->campo03->campo03);
}else{
	$campo03 = '%';
}
if(isset($data->campo04)){
	$campo04 = strip_tags($data->campo04->campo04);
}else{
	$campo04 = '%';
}
if(isset($data->campo05)){
	$campo05 = strip_tags($data->campo05->campo05);
}else{
	$campo05 = '%';
}
if(isset($data->campo06)){
	$campo06 = strip_tags($data->campo06->campo06);
}else{
	$campo06 = '%';
}
if(isset($data->campo07)){
	$campo07 = strip_tags($data->campo07->campo07);
}else{
	$campo07 = '%';
}
if(isset($data->campo08)){
	$campo08 = strip_tags($data->campo08->campo08);
}else{
	$campo08 = '%';
}
if(isset($data->campo09)){
	$campo09 = strip_tags($data->campo09->campo09);
}else{
	$campo09 = '%';
}
if(isset($data->campo10)){
	$campo10 = strip_tags($data->campo10->campo10);
}else{
	$campo10 = '%';
}
if(isset($data->campo11)){
	$campo11 = strip_tags($data->campo11->campo11);
}else{
	$campo11 = '%';
}
if(isset($data->campo12)){
	$campo12 = strip_tags($data->campo12->campo12);
}else{
	$campo12 = '%';
}
if(isset($data->campo13)){
	$campo13 = strip_tags($data->campo13->campo13);
}else{
	$campo13 = '%';
}
if(isset($data->campo14)){
	$campo14 = strip_tags($data->campo14->campo14);
}else{
	$campo14 = '%';
}
if(isset($data->campo15)){
	$campo15 = strip_tags($data->campo15->campo15);
}else{
	$campo15 = '%';
}
if(isset($data->campo16)){
	$campo16 = strip_tags($data->campo16->campo16);
}else{
	$campo16 = '%';
}
if(isset($data->campo17)){
	$campo17 = strip_tags($data->campo17->campo17);
}else{
	$campo17 = '%';
}
if(isset($data->campo18)){
	$campo18 = strip_tags($data->campo18->campo18);
}else{
	$campo18 = '%';
}
if(isset($data->campo19)){
	$campo19 = strip_tags($data->campo19->campo19);
}else{
	$campo19 = '%';
}
if(isset($data->campo20)){
	$campo20 = strip_tags($data->campo20->campo20);
}else{
	$campo20 = '%';
}

//SE CREA CONEXION A BASE DE DATOS
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//SE BUSCA LA INFORMACION NECESARIA
$resultado = Producto::listarProductosDisponiblesPorIdCategoria($conexion, $idCategoria, $desde, $limite,
													$destacados,
													$marcaFiltro,
												   $campo01,
			                                       $campo02,
			                                       $campo03,
			                                       $campo04,
			                                       $campo05,
			                                       $campo06,
			                                       $campo07,
			                                       $campo08,
			                                       $campo09,
			                                       $campo10,
			                                       $campo11,
			                                       $campo12,
			                                       $campo13,
			                                       $campo14,
			                                       $campo15,
			                                       $campo16,
			                                       $campo17,
			                                       $campo18,
			                                       $campo19,
			                                       $campo20,
			                                       $orden
									);

//SE CIERRA CONEXION A BD 
$conn->cerrarConexion();

//para que se muestren correctamente acentos y ñ
header("Content-Type: text/html; charset=iso-8859-1");  

//SE DEVUELVE LA INFO OBTENIDA
echo json_encode($resultado);