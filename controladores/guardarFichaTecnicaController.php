<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 29/09/17
 * Time: 22:04
 */

include_once('../incluciones/adminControlerVerificacion.php');
include_once ('../clases/ConexionBDClass.php');
include_once('../clases/ProductoClass.php');

//CAPTURA DE DATOS DEL AJAX

$data = json_decode(file_get_contents('php://input'));

$nombre = strip_tags($data->nombreFicha);
$campo01 = strip_tags($data->campo01);
$campo02 = strip_tags($data->campo02);
$campo03 = strip_tags($data->campo03);
$campo04 = strip_tags($data->campo04);
$campo05 = strip_tags($data->campo05);
$campo06 = strip_tags($data->campo06);
$campo07 = strip_tags($data->campo07);
$campo08 = strip_tags($data->campo08);
$campo09 = strip_tags($data->campo09);
$campo10 = strip_tags($data->campo10);
$campo11 = strip_tags($data->campo11);
$campo12 = strip_tags($data->campo12);
$campo13 = strip_tags($data->campo13);
$campo14 = strip_tags($data->campo14);
$campo15 = strip_tags($data->campo15);
$campo16 = strip_tags($data->campo16);
$campo17 = strip_tags($data->campo17);
$campo18 = strip_tags($data->campo18);
$campo19 = strip_tags($data->campo19);
$campo20 = strip_tags($data->campo20);


//CONEXION CON BASE DE DATOS
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//PERSISTENCIA DE LA FICHA TECNICA
$listaNombresFichas = Producto::listarNombresFichas($conexion);
$fichaSinRegistrar = true;
foreach ($listaNombresFichas as $item) {
    if ($nombre == $item['nombre_ficha']){
        $fichaSinRegistrar = false;
        break;
    }
}

if ($fichaSinRegistrar){
    Producto::guardarFichaTecnica($conexion,
                                    $nombre,
                                    $campo01,
                                    $campo02,
                                    $campo03 ,
                                    $campo04 ,
                                    $campo05 ,
                                    $campo06 ,
                                    $campo07 ,
                                    $campo08 ,
                                    $campo09 ,
                                    $campo10,
                                    $campo11,
                                    $campo12 ,
                                    $campo13,
                                    $campo14,
                                    $campo15,
                                    $campo16,
                                    $campo17,
                                    $campo18,
                                    $campo19,
                                    $campo20);

    $respuesta = ['mensaje'=>2,];
    echo json_encode($respuesta);


}else{
    $respuesta = ['mensaje'=>1,];
    echo json_encode($respuesta);
}