<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 12/10/17
 * Time: 22:56
 */

include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/CategoriaClass.php');

//se capturan los datos del Ajax
$data = json_decode(file_get_contents('php://input'));

$id = null;
$descripcion = strip_tags($data->descripcion);
$fichaTecnica = strip_tags($data->fichaTecnica);

$fichaTecnica = (int)$fichaTecnica;

//Conexion a la BD
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//instanciacion de Categoria
$categoria = new Categoria($id, $descripcion, $fichaTecnica);

//guardado de la catgoria
$categoria->guardarCategoria($conexion);

$mensaje = ['mensaje'=>1,];

echo json_encode($mensaje);