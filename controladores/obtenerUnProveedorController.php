<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 26/09/17
 * Time: 18:49
 */
include_once('../incluciones/adminControlerVerificacion.php');

include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/proveedorClass.php');


//CAPTURA DE DATOS DEL AJAX
$data = json_decode(file_get_contents('php://input'));

$id = strip_tags("$data->id");
$id = (int)$id;


//CONEXIONA LA BD
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//obtencion de datos del proveedor
$proveedor = array();
$proveedor = Proveedor::obtenerProveedorPorId($conexion, $id);

echo json_encode($proveedor);

