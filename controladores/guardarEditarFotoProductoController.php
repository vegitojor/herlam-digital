<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 24/10/17
 * Time: 23:54
 */

include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once ('../clases/ProductoClass.php');

//DATOS DEL AJAX
//$data = json_decode(file_get_contents('php://input'));

$id = strip_tags($_POST['idProducto']);


//CONEXION DE DB
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//INICIALIZAMOS EL PRODUCTO
$producto = new Producto($id);

$idFichaTecnica = $producto->obtenerFichaTecnica($conexion);
$sku = $producto->getSku($conexion);
//RECEPCIONAMOS LA FOTO
$foto = $_FILES['foto'];


if(!empty($foto['name'])){
    //********SE PROCESA LA IMAGEN********************************
    //se obtiene el nombre y extencion
    $nombreFoto = $foto['name'];
    $extencion = pathinfo($nombreFoto, PATHINFO_EXTENSION);

    if($extencion != null || $extencion != ""){
        $nombreFoto = $sku['sku'] ."-".$idFichaTecnica. ".".$extencion;
        //defino la ruta de almacenamiento y muevo la imagen
        $ruta = "resourses/imagen_producto/".$nombreFoto;
        @move_uploaded_file($foto['tmp_name'], "../".$ruta);
    }else{
        $nombreFoto = "<--NoFoto-->";
    }

}else{
    $nombreFoto = "<--NoFoto-->";
}

//guardamos los cambios
$respuesta = $producto->cambiarFoto($conexion, $nombreFoto);

if(($respuesta > 0 )){
	$mensaje = ['respuesta'=>1,];
	echo json_encode($mensaje);
}elseif ($respuesta == 0 ) {
	$mensaje = ['respuesta'=>0,];
	echo json_encode($mensaje);
}elseif ($respuesta < 0) {
	$mensaje = ['respuesta'=>2,];
	echo json_encode($mensaje);
}else{
	$mensaje = ['respuesta'=>3,];
	echo json_encode($mensaje);
}
