<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 27/09/17
 * Time: 18:01
 */

include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/proveedorClass.php');
/*
//CAPTURA DE DATOS DEL AJAX
$data = json_decode(file_get_contents('php://input'));

$id = strip_tags($data->id);
$nombre = strip_tags($data->nombre);
$telefono = strip_tags($data->telefono);
$email = strip_tags($data->email);
$direccion = strip_tags($data->direccion);
$codigoPostal = strip_tags($data->codigoPostal);
$localidad = strip_tags($data->localidad);
*/

//uso del controller directo
$id = strip_tags( $_POST['id']);
$nombre = strip_tags($_POST['nombre']);
$telefono = strip_tags($_POST['telefono']);
$email = strip_tags($_POST['email']);
$direccion = strip_tags($_POST['direccion']);
$codigoPostal = strip_tags($_POST['codigoPostal']);
$localidad = strip_tags($_POST['idLocalidad']);


$id = (int)$id;
$codigoPostal = (int)$codigoPostal;
$localidad = (int)$localidad;

//CONEXION CON LA BASE
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//CREACION DEL OBJETO PROVEEDOR
$proveedor = new Proveedor($id,$nombre, $telefono, $direccion, $codigoPostal, $email, $localidad);

$proveedor->editarse($conexion);

/*
//ARRAY DE RESPUESTA
$respuesta = array();

$respuesta = ['mensaje'=> 1,];

echo json_encode($respuesta);
*/

header('location: ../vistas/cargar-proveedor.php');
echo "Elproveedor se edito correctamente.";
die();