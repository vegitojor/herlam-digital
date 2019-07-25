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

//conexxion a la base de datos
$conn = new ConexionBD();
$conexion = $conn->getConexion();

//DATOS DEL AJAX
$archivoCarga = $_FILES['archivoCarga'];


if($archivoCarga["size"]>2000000){
    $mensaje = ['respuesta'=> 0,];
    echo json_encode($mensaje);
}else{
    // sacamos todas las propiedades del archivo
    $nombre_archivo = $archivoCarga['name'];
    $tipo_archivo= $archivoCarga['type'];
    $tamano_archivo = $archivoCarga['size'];
    $direccion_temporal = $archivoCarga['tmp_name'];
    // movemos el archivo a la capeta de nuestro servidor 
    //move_uploaded_file($archivoCarga['tmp_name'],"../resourses/cargaMasiva/". "'" .$archivoCarga['name'] . "'");
    move_uploaded_file($_FILES['archivoCarga']['tmp_name'],"../resourses/cargaMasiva/" .$archivoCarga['name'] );

    //iteramos cada fila buscando datos 
    $fila = 0;

    //inicializamos el puntero del archivo
    if(($gestor = fopen($direccion_temporal, "r")) !== FALSE){
    	
	    while (($data = fgetcsv($gestor, 0, ",")) !== FALSE){
	    	if($fila == 0){

	    		$fila++;
	    		
	    	}else{
	    		//se obtiene cada dato a partir del array $data
	    		$descripcion = strip_tags($data[0]);
	    		$precio = strip_tags($data[1]);
	    		$ganancia = strip_tags($data[2]);
	    		$mesesGarantia = strip_tags($data[3]);
	    		$mesesGarantia = (int)$mesesGarantia;
	    		$nuevo = strip_tags($data[4]);
	    		$nuevo = (int)$nuevo;
	    		$codigoFabricante = strip_tags($data[5]);
	    		$modelo = strip_tags($data[6]);
	    		$disponible = strip_tags($data[7]);
	    		$disponible = (int)$disponible;
	    		$codigoProveedor = strip_tags($data[8]);
	    		$codigoProveedor = (int)$codigoProveedor;
	    		$pathImagen = "<--NoFoto-->";
	    		$pathVideo = strip_tags($data[10]);
	    		$idCategoria = strip_tags($data[11]);
	    		$idCategoria = (int)$idCategoria;
	    		$idProveedor = strip_tags($data[12]);
	    		$idProveedor = (int)$idProveedor;
	    		$idMarca = strip_tags($data[13]);
	    		$idMarca = (int)$idMarca;
	    		$codigoSku = strip_tags($data[14]);
	    		$peso = strip_tags($data[15]);
	    		$alto = strip_tags($data[16]);
	    		$ancho = strip_tags($data[17]);
	    		$profundidad = strip_tags($data[18]);
	    		$idFichaTecnica = null;
	    		$destacado = strip_tags($data[20]);
	    		$destacado = (int)$destacado;

	    		//se da el formato correcto a las variables que lo requieren
	    		$precio = ($precio * ($ganancia / 100)) + $precio;
	    		$precio = number_format($precio, 2, '.','');
			    $alto = number_format($alto, 2, '.','');
			    $ancho = number_format($ancho, 2, '.','');
			    $profundidad = number_format($profundidad, 2, '.','');
			    $peso = number_format($peso, 2, '.','');

			    //se continua con la obtencion de datos de ficha tecnica
			    $campo01 = strip_tags($data[21]);
			    $campo02 = strip_tags($data[22]);
			    $campo03 = strip_tags($data[23]);
			    $campo04 = strip_tags($data[24]);
			    $campo05 = strip_tags($data[25]);
			    $campo06 = strip_tags($data[26]);
			    $campo07 = strip_tags($data[27]);
			    $campo08 = strip_tags($data[28]);
			    $campo09 = strip_tags($data[29]);
			    $campo10 = strip_tags($data[30]);
			    $campo11 = strip_tags($data[31]);
			    $campo12 = strip_tags($data[32]);
			    $campo13 = strip_tags($data[33]);
			    $campo14 = strip_tags($data[34]);
			    $campo15 = strip_tags($data[35]);
			    $campo16 = strip_tags($data[36]);
			    $campo17 = strip_tags($data[37]);
			    $campo18 = strip_tags($data[38]);
			    $campo19 = strip_tags($data[39]);
			    $campo20 = strip_tags($data[40]);

			    
			    $resultadoSku = Producto::buscarProductoPorSku($codigoSku, $conexion);
			    
			    if(sizeof($resultadoSku) > 0){
			    	
			    	//se trata de la actualizacion de producto
			    	$id = $resultadoSku[0]['id'];
			    	//se inicializa el producto con el id
			    	$producto = new Producto($id);
			    	$idFichaTecnicaAEditar = $producto->obtenerFichaTecnica($conexion);
			    	
			    	$producto->editarFichaTecnica($conexion,
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
				    	$campo20,
				    	$idFichaTecnicaAEditar);

			    	$producto->editarse($conexion, $modelo, $descripcion, $precio, $mesesGarantia, $codigoFabricante, $codigoProveedor, $codigoSku, $pathVideo,
			    						$idProveedor, $alto, $ancho, $profundidad, $peso, $idMarca, $idCategoria, $id);
			    		
			    	//aumentamos el valor de fila
			    	$fila++;

			    }else{
			    	//se trata de la carga de un producto nuevo
				    $id = null;
				    $idFichaTecnica = Producto::guardarFichaTecnicaDelProducto(
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
				    	$campo20,
				    	$conexion);

				    //se inicializa el producto y se persiste
				    $nuevoProducto = new Producto($id, $descripcion, $precio, $mesesGarantia, $nuevo, $codigoFabricante, $modelo,
                            $disponible, $codigoProveedor, $pathImagen, $pathVideo, $idCategoria, $idProveedor,
                            $idMarca, $codigoSku, $peso, $alto, $ancho, $profundidad, $idFichaTecnica, $destacado);

				    $nuevoProducto->persistirse($conexion);

		    		//aumentamos el numero de fila
		    		$fila++;
			    }
			    
	    	}
	    }//fin del while
	    fclose($gestor);
	    
	    $mensaje = ['respuesta'=>1,'filas'=>($fila - 1),];
	    echo json_encode($mensaje);
	    
	}else{
		
		$mensaje = ['respuesta'=>2,];
		echo json_encode($mensaje);
		
	}
}

