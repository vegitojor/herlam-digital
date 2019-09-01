<?php 

require_once("../clases/ConexionBDClass.php");
require_once ("../clases/PedidoClass.php");

$conn = new ConexionBD();
$conexion = $conn->getConexion();

//Consulta a la base de datos
$output = Pedido::cargarEstadosPedido($conexion);


//devolucion del resultado en json
echo json_encode($output); 

?>