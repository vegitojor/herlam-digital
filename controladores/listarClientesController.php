<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 21/10/17
 * Time: 10:15
 */
include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/ClienteClass.php');
//OBTENEMOS LOS DATOS DEL AJAX
$data = json_decode(file_get_contents('php://input'));
$admin = strip_tags($data->admin);
$admin = (int)$admin;
// if($admin == 1)
//     $admin = (bool)$admin;

// var_dump($admin);
$supervisor = 0;
if($admin == 0){
    $supervisor = (int) strip_tags($data->supervisor);
}


$desde = strip_tags($data->desde);
$desde = (int)$desde;
$limite = strip_tags($data->limite);
$limite = (int)$limite;

$nombre = null;

if(isset($data->nombre))
    $nombre = utf8_decode( strip_tags($data->nombre));

$apellido = null;
if(isset($data->apellido))
    $apellido = utf8_decode( strip_tags($data->apellido));

$cuil = null;
if(isset($data->cuil))
    $cuil = utf8_decode( strip_tags($data->cuil));

$razonSocial = null;
if(isset($data->razonSocial))
    $razonSocial = utf8_decode( strip_tags($data->razonSocial));

//CONEXION CON BD
$conn = new ConexionBD();
$conexion = $conn->getConexion();


// var_dump($razonSocial);
// var_dump($limite);
//LISTADO DE ClienteClass
$clientes = Cliente::listarClientes($conexion, $admin, $desde, $limite, $supervisor, $nombre, $apellido, $cuil, $razonSocial);

$conn->cerrarConexion();

echo json_encode($clientes);