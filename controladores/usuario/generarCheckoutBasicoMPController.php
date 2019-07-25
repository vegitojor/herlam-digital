<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 17/12/17
 * Time: 19:02
 */
/*7808904984310469*/
/*nTDv7afG77ckV38hFa3xg3xBHU1AXlOV*/

// include_once('../../incluciones/verificacionUsuario.php');

include_once ('../../clases/ConexionBDClass.php');
include_once ('../../clases/ProductoClass.php');
include_once ('../../clases/MonedaClass.php');
include_once ('../../librerias/mercadoPago/mercadopago.php');

//TOMO LOS DATOS DEL AJAX DEL JS
$data = json_decode(file_get_contents('php://input'));

$usuario = strip_tags($data->usuario);
$usuario = (int)$usuario;

//CREO LA CONEXION A LA BASE DE DATOS
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//BUSCO TODOS LOS PRODUCTOS QUE EL USUARIO AGREGO AL CARRITO
$output = Producto::cargarProductosCarrito($conexion, $usuario);

//BUSCO LA MONEDA ACTIVA PARA CALCULAR EL PRECIO EN $ARG DE LOS PRODUCTOS
$moneda = Moneda::traerMonedaActiva($conexion);


//SE PREPARAN LOS DATOS PARA GENERAR EL PREFERENCE_DATA DE MERCADO PAGO
$productos = array();
$preference_data = array();


foreach ($output as $key => $value) {
	$producto = array(
			'title'=>$value['descripcion'],
			'quantity'=>$value['cantidad'],
			'currency_id'=>"ARS",
			'unit_price'=>($value['precio'] * $moneda['valor'])
		);

	$productos[] = $producto;
}

$preference_data = ['items'=>$productos,];

//SE CREA UN OBJETO DE MERCADO PAGO
$mp = new MP('7808904984310469', 'nTDv7afG77ckV38hFa3xg3xBHU1AXlOV');

$preference = $mp->create_preference($preference_data);

echo json_encode($preference);


