<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 24/10/17
 * Time: 23:54
 */

include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/ProductoClass.php');

//DATOS DEL AJAX
$data = json_decode(file_get_contents('php://input'));

$id = strip_tags($data->id);

$modelo = strip_tags($data->modelo);
$descripcion = strip_tags($data->descripcion);
$precio = strip_tags($data->precio);
$mesesGarantia = strip_tags($data->mesesGarantia);
$codigoFabricante = strip_tags($data->codigoFabricante);
$codigoProveedor = strip_tags($data->codigoProveedor);
$sku = strip_tags($data->sku);
$video = strip_tags($data->video);
$proveedor = strip_tags($data->proveedor);
$proveedor = (int)$proveedor;
$alto = strip_tags($data->alto);
$ancho = strip_tags($data->ancho);
$profundidad = strip_tags($data->profundidad);
$peso = strip_tags($data->peso);
$marca = strip_tags($data->marca);
$marca = (int)$marca;
$categoria = strip_tags($data->categoria);
$categoria = (int)$categoria;

$precio = number_format($precio, 2, '.','');
$alto = number_format($alto, 2, '.','');
$ancho = number_format($ancho, 2, '.','');
$profundidad = number_format($profundidad, 2, '.','');
$peso = number_format($peso, 2, '.','');

$campo01 = strip_tags($data->campo01);
$campo02 = strip_tags($data->campo02);
$campo03 = strip_tags($data->campo03);
$campo04 = strip_tags($data->campo04);
$campo05 = strip_tags($data->campo05);
$campo06 = strip_tags($data->campo06);
$campo07 = strip_tags($data->campo07);
$campo08 = strip_tags($data->campo08);
$campo09 = strip_tags($data->campo09);
$campo10 = strip_tags($data->campo10);
$campo11 = strip_tags($data->campo11);
$campo12 = strip_tags($data->campo12);
$campo13 = strip_tags($data->campo13);
$campo14 = strip_tags($data->campo14);
$campo15 = strip_tags($data->campo15);
$campo16 = strip_tags($data->campo16);
$campo17 = strip_tags($data->campo17);
$campo18 = strip_tags($data->campo18);
$campo19 = strip_tags($data->campo19);
$campo20 = strip_tags($data->campo20);



//CONEXION DE DB
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//INICIALIZAMOS EL PRODUCTO
$producto = new Producto($id);

$idFichaTecnica = $producto->obtenerFichaTecnica($conexion);
$respuestaFichaTecnica = $producto->editarFichaTecnica($conexion,
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
								$idFichaTecnica);

$respuesta = $producto->editarse($conexion,
									$modelo,
									$descripcion,
									$precio,
									$mesesGarantia,
									$codigoFabricante,
									$codigoProveedor,
									$sku,
									$video,
									$proveedor,
									$alto,
									$ancho,
									$profundidad,
									$peso,
									$marca,
									$categoria,
									$id);

if(($respuesta > 0 || $respuestaFichaTecnica > 0) || ($respuesta == 0 && $respuestaFichaTecnica == 0)){
	$mensaje = ['respuesta'=>1,];
	echo json_encode($mensaje);
}elseif ($respuesta == 0 ) {
	$mensaje = ['respuesta'=>0,];
	echo json_encode($mensaje);
}elseif ($respuesta < 0) {
	$mensaje = ['respuesta'=>2,];
	echo json_encode($mensaje);
}else{
	$mensaje = ['respuesta'=>3,];
	echo json_encode($mensaje);
}
