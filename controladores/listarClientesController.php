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


$desde = strip_tags($data->desde);
$desde = (int)$desde;
$limite = strip_tags($data->limite);
$limite = (int)$limite;
//CONEXION CON BD
$conn = new ConexionBD();
$conexion = $conn->getConexion();


// var_dump($desde);
// var_dump($limite);
//LISTADO DE ClienteClass
$clientes = Cliente::listarClientes($conexion, $admin, $desde, $limite);

$conn->cerrarConexion();

echo json_encode($clientes);