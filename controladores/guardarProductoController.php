<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 23/11/17
 * Time: 23:35
 */

include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once('../clases/ProductoClass.php');

error_reporting('E_All' ^ 'E_NOTICE');
//SE CAPTURAN LOS DATOS DEL AJAX
$modelo = strip_tags($_POST['modelo']);
$descripcion = strip_tags($_POST['descripcion']);

$mesesGarantia = strip_tags($_POST['mesesGarantia']);
$mesesGarantia = (int)$mesesGarantia;
$sku = strip_tags($_POST['sku']);
$proveedor = strip_tags($_POST['proveedor']);
$proveedor = (int)$proveedor;
$marca = strip_tags($_POST['marca']);
$marca = (int)$marca;
$categoria = strip_tags($_POST['categoria']);
$categoria = (int)$categoria;
$codigoFabricante = strip_tags($_POST['codigoFabricante']);
$nuevo = $_POST['nuevo'];
$disponible = $_POST['disponible'];
$codigoProveedor = strip_tags($_POST['codigoProveedor']);
$video = strip_tags($_POST['video']);

$precio = strip_tags($_POST['precio']);
$alto = strip_tags($_POST['alto']);
$ancho = strip_tags($_POST['ancho']);
$profundidad = strip_tags($_POST['profundidad']);
$peso = strip_tags($_POST['peso']);

$campo01 = $_POST['campo01'];
$campo02 = $_POST['campo02'];
$campo03 = $_POST['campo03'];
$campo04 = $_POST['campo04'];
$campo05 = $_POST['campo05'];
$campo06 = $_POST['campo06'];
$campo07 = $_POST['campo07'];
$campo08 = $_POST['campo08'];
$campo09 = $_POST['campo09'];
$campo10 = $_POST['campo10'];
$campo11 = $_POST['campo11'];
$campo12 = $_POST['campo12'];
$campo13 = $_POST['campo13'];
$campo14 = $_POST['campo14'];
$campo15 = $_POST['campo15'];
$campo16 = $_POST['campo16'];
$campo17 = $_POST['campo17'];
$campo18 = $_POST['campo18'];
$campo19 = $_POST['campo19'];
$campo20 = $_POST['campo20'];
$destacado = $_POST['destacado'];
if(!isset($destacado)){
    $destacado = 0;
}


//$valor = number_format($valor, 2, '.','');
    $precio = number_format($precio, 2, '.','');
    $alto = number_format($alto, 2, '.','');
    $ancho = number_format($ancho, 2, '.','');
    $profundidad = number_format($profundidad, 2, '.','');
    $peso = number_format($peso, 2, '.','');


//************************************************************

//********SE INICIA CONEXCION A BD*****************************
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//********SE GUARDAN LOS DATOS DE FICHA TECNICA*****************
$idProductoFichaTecnica = Producto::guardarFichaTecnicaDelProducto(
                                        $campo01,
                                        $campo02,
                                        $campo03,
                                        $campo04,
                                        $campo05,
                                        $campo06,
                                        $campo07,
                                        $campo08,
                                        $campo09,
                                        $campo10,
                                        $campo11,
                                        $campo12,
                                        $campo13,
                                        $campo14,
                                        $campo15,
                                        $campo16,
                                        $campo17,
                                        $campo18,
                                        $campo19,
                                        $campo20, $conexion);
//***************************************************************************
$foto = $_FILES['foto'];

if(!empty($foto['name'])){
    //********SE PROCESA LA IMAGEN********************************
    //se obtiene el nombre y extencion
    $nombreFoto = $foto['name'];
    $extencion = pathinfo($nombreFoto, PATHINFO_EXTENSION);

    if($extencion != null || $extencion != ""){
        $nombreFoto = $sku ."-".$idProductoFichaTecnica. ".".$extencion;
        //defino la ruta de almacenamiento y muevo la imagen
        $ruta = "resourses/imagen_producto/".$nombreFoto;
        @move_uploaded_file($foto['tmp_name'], "../".$ruta);
    }else{
        $nombreFoto = "<--NoFoto-->";
    }

}else{
    $nombreFoto = "<--NoFoto-->";
}

//************SE INICIALIZA EL PRODUCTO Y SE PERSISTE*********************
$id = null;
$nuevoProducto = new Producto($id, $descripcion, $precio, $mesesGarantia, $nuevo, $codigoFabricante, $modelo,
                            $disponible, $codigoProveedor, $nombreFoto, $video, $categoria, $proveedor,
                            $marca, $sku, $peso, $alto, $ancho, $profundidad, $idProductoFichaTecnica, $destacado);


$nuevoProducto->persistirse($conexion);
//**************************************************************************


header('location: ../vistas/cargar-producto.php');