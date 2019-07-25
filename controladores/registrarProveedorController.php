<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 24/09/17
 * Time: 1:14
 */

include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/proveedorClass.php');

$data = json_decode(file_get_contents('php://input'));

//INICIALIZACION DE VARIABLES
$id = null;
$nombre = strip_tags($data->nombre);
$telefono = strip_tags($data->telefono);
$email = strip_tags($data->email);
$direccion = strip_tags($data->direccion);
$codigoPostal = strip_tags($data->codigoPostal);
$localidad = strip_tags($data->localidad);

$codigoPostal = (int)$codigoPostal;
$localidad = (int)$localidad;

//conexion a la base de datos
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//crecion de objeto proveedor
$proveedor = new Proveedor($id, $nombre,$telefono, $direccion, $codigoPostal, $email, $localidad);

//comprobacion de que no existe otro proveedor de igual nombre
$existeProveedor = $proveedor->buscarNombre($conexion);

//validacion y persistencia
$mensaje = array();
if($existeProveedor == Null){
    $proveedor->persistirse($conexion);
    $mensaje = ['respuesta'=> 1,];
    echo json_encode($mensaje);
}elseif ($existeProveedor){
    $mensaje = ['respuesta'=> 0,];
    echo json_encode($mensaje);
}else{
    $mensaje = ['respuesta'=> 2,];
    echo json_encode($mensaje);
}