<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 9/12/17
 * Time: 13:53
 */

include_once ('../../clases/ConexionBDClass.php');
include_once ('../../clases/ProductoClass.php');

//se toman los datos del ajax
$data = json_decode(file_get_contents('php://input'));

$idCategoria = strip_tags($data->idCategoria);
$idCategoria = (int)$idCategoria;
$campo = strip_tags($data->campo);
$campo = (int)$campo;


//SE CREA CONEXION A BASE DE DATOS
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//SE BUSCA LA INFORMACION NECESARIA
$resultado = Producto::obtenerOpcionesFiltrosPorCampo($conexion, $idCategoria, $campo);

//SE CIERRA CONEXION A BD 
$conn->cerrarConexion();

//para que se muestren correctamente acentos y ñ
header("Content-Type: text/html; charset=iso-8859-1");  

//SE DEVUELVE LA INFO OBTENIDA
echo json_encode($resultado);