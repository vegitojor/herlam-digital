<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 17/12/17
 * Time: 19:02
 */


include_once ('../../clases/ConexionBDClass.php');
include_once ('../../clases/ProductoClass.php');

session_start();

//TOMO LOS DATOS DEL AJAX DEL JS
$data = json_decode(file_get_contents('php://input'));

$usuario = strip_tags($data->usuario);
$usuario = (int)$usuario;

//CREO LA CONEXION A LA BASE DE DATOS
$conn = new ConexionBD();
$conexion = $conn->getConexion();

if( $usuario == 0 ){
	$carrito = $_SESSION['carrito'];
	// var_dump($_SESSION['control']);
	// var_dump($carrito);
	// die();

	$output = array();
	foreach ($carrito as $key => $value) {
		// var_dump($carrito[$key]);

		$producto = Producto::obtenerProductoCarritoSinUsuario($conexion, $carrito[$key]['producto']);
		$fila = ['idProducto' => $carrito[$key]['producto'], 'cantidad' => $carrito[$key]['cantidad'],];
		// var_dump($key);
		// var_dump($fila);
		// die();
		$fila += $producto;
		// var_dump($fila);
		// die();
		$output[] = $fila;
	}

	//CIERRO CONEXION A BASE DE DATOS
	$conn->cerrarConexion();

	// var_dump($output);
	// die();

	//RETORNO LOS DATOS OBTENIDOS
	echo json_encode($output);

}else{ //el usuario esta logueado

	

	//BUSCO TODOS LOS PRODUCTOS QUE EL USUARIO AGREGO AL CARRITO
	$output = Producto::cargarProductosCarrito($conexion, $usuario);

	//CIERRO CONEXION A BASE DE DATOS
	$conn->cerrarConexion();

	//RETORNO LOS DATOS OBTENIDOS
	echo json_encode($output);
}






