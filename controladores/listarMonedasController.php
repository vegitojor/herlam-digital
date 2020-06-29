<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 21/10/17
 * Time: 10:15
 */
include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/MonedaClass.php');

//CONEXION CON BD
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//LISTADO DE MONEDAS
$monedas = Moneda::listarMonedas($conexion);

echo json_encode($monedas);