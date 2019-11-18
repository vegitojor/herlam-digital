<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 24/10/17
 * Time: 23:54
 */

include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/ClienteClass.php');

//DATOS DEL AJAX
$data = json_decode(file_get_contents('php://input'));



//CONEXION DE DB
$conn = new ConexionBD();
$conexion = $conn->getConexion();

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


//LISTAR CATEGORIAS
$cantidad = Cliente::contarCantidadClientes($conexion, $nombre, $apellido, $cuil, $razonSocial);

$conn->cerrarConexion();

echo json_encode($cantidad);