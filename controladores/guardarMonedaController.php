<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 21/10/17
 * Time: 13:36
 */

include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/MonedaClass.php');

//obtencion de datos del AJAX
$data = json_decode(file_get_contents('php://input'));

$id = null;
$descripcion = strip_tags($data->descripcion);
$valor = strip_tags($data->valor);
if(isset($data->activo)){
	$activo = $data->activo;
}else{
	$activo = 0;
}
//$valor = (double)$valor;
$valor = number_format($valor, 2, '.','');


//CONEXION CON BD
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//PERSISTIR LA MONEDA
$moneda = new Moneda($id, $descripcion, $valor, $activo);
$moneda->persistirMoneda($conexion);

$respuesta = ['mensaje'=>1,];

echo json_encode($respuesta);