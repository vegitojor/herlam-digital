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

$id = $data->idProducto;
$id = (int)$id;

//CONEXION DE DB
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//INICIALIZAMOS EL PRODUCTO
$producto = new Producto($id);
// var_dump($producto);
//guardamos los cambios


$activo = $data->activo;
if($activo == 1){
	$activo = true;
}     //<--------------- necesario para postgres

//SI DATA-DISPONIBLE ES = 1 SE EDITA DISPONIBLE
if($data->disponible == 1){
	
    $respuesta = $producto->cambiarDisponible($conexion, $activo);
}else{
//SI DATA-DISPONIBLE ES = 0 SE EDITA DESTACADO

	$respuesta = $producto->cambiarDestacadoV2($conexion, $activo);
}



//SE CIERRA LA CONEXION DE LA BASE DE DATOS
$conn->cerrarConexion();

if(($respuesta > 0 )){
	$mensaje = ['respuesta'=>1, 'activo'=> $data->activo,];
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
