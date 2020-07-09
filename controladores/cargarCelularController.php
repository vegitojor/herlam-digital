<?php 
require_once('../clases/ConexionBDClass.php');
require_once('../clases/ClienteClass.php');

//toma de datos desde llamado ajax
$data = json_decode(file_get_contents('php://input'));

$celular = $data->celular;
$id = (int) $data->usuario;


//se crea objeto y se pide conexion a BD
$objetoConexion = new ConexionBD();
$conexion = $objetoConexion->getConexion();

$mensaje = array();

$resultado = Cliente::cambiarCelular($conexion, $id, $celular);

$mensaje = ['respuesta'=> 1,];
echo json_encode($mensaje);

?>