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

$desde = strip_tags($data->desde);
$limite = strip_tags($data->limite);
$limite = (int)$limite;
//CONEXION CON BD
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//LISTADO DE ClienteClass
$clientes = Cliente::listarClientes($conexion, $admin, $desde, $limite);

echo json_encode($clientes);