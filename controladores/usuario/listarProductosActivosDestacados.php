<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 9/12/17
 * Time: 13:53
 */

include_once('../../clases/ConexionBDClass.php');
include_once('../../clases/ProductoClass.php');

//se toman los datos del ajax
$data = json_decode(file_get_contents('php://input'));

$limite = strip_tags($data->limite);
$limite = (int)$limite;

//SE CREA CONEXION A BASE DE DATOS
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//SE BUSCA LA INFORMACION NECESARIA
$resultado = Producto::listarProductosDisponiblesDestacados($conexion, $limite);

//SE CIERRA CONEXION A BD 
$conn->cerrarConexion();

//para que se muestren correctamente acentos y ñ
header("Content-Type: text/html; charset=iso-8859-1");  

//SE DEVUELVE LA INFO OBTENIDA
echo json_encode($resultado);