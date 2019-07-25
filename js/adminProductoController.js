app.controller("adminProducto", function ($scope, $http) {
    $scope.cargarProveedores = function () {
        $http.post("../controladores/listarProveedoresController.php")
            .success(function (response) {
                $scope.proveedores = response;
            })
    }

    $scope.cargarMarca = function () {
        $http.post('../controladores/listarMarcasController.php')
            .success(function (response) {
                $scope.marcas = response;
            })
    }

    $scope.cargarCategoria = function () {
        $http.post('../controladores/listarCategoriasController.php')
            .success(function (response) {
                $scope.categorias = response;
            })
    }

    $scope.cargarFichaTecnica = function () {
        $http.post('../controladores/cargarFichaTecnicaController.php', {'idCategoria': $scope.categoria})
            .success(function (response) {
                $scope.fichaParaElProducto = response;
            })
    }


    $scope.campoProducto01 = 0;
    $scope.campoProducto02 = 0;
    $scope.campoProducto03 = 0;
    $scope.campoProducto04 = 0;
    $scope.campoProducto05 = 0;
    $scope.campoProducto06 = 0;
    $scope.campoProducto07 = 0;
    $scope.campoProducto08 = 0;
    $scope.campoProducto09 = 0;
    $scope.campoProducto10 = 0;
    $scope.campoProducto11 = 0;
    $scope.campoProducto12 = 0;
    $scope.campoProducto13 = 0;
    $scope.campoProducto14 = 0;
    $scope.campoProducto15 = 0;
    $scope.campoProducto16 = 0;
    $scope.campoProducto17 = 0;
    $scope.campoProducto18 = 0;
    $scope.campoProducto19 = 0;
    $scope.campoProducto20 = 0;

    $scope.cargaProducto = false;
    $scope.mostrarCargaProducto = function () {
        $scope.cargaProducto = true;
    }

    $scope.cerrarCargaProducto = function () {
        $scope.cargaProducto = false;
        
    }

    $scope.listarProductos = function () {
        $http.post('../controladores/listarProductosController.php', {'desde': $scope.desde, 'limite': $scope.limite})
            .success(function (response) {
                $scope.productos = response;
        })
    }

    $scope.editarProductoModal = false;

    $scope.editarProducto = function($producto){
        $scope.id = $producto.id;
        $scope.modeloEditar = $producto.modelo;
        $scope.descripcionEditar = $producto.descripcion;
        $scope.precioEditar = parseFloat($producto.precio);
        
        $scope.mesesGarantiaEditar = $producto.mesesGarantia;
        $scope.codigoFabricanteEditar = $producto.codFabricante;
        $scope.codigoProveedorEditar = $producto.codProveedor;
        $scope.skuEditar = $producto.sku;
        $scope.videoEditar = $producto.video;
        $scope.proveedorEditar = $producto.proveedorId;
        $scope.altoEditar = parseFloat($producto.alto);
        $scope.anchoEditar = parseFloat($producto.ancho);
        $scope.profundidadEditar = parseFloat($producto.profundidad);
        $scope.pesoEditar = parseFloat($producto.peso);
        $scope.marcaEditar = $producto.marcaId;
        $scope.categoriaEditar = $producto.categoriaId;
        //se setea categoria para la busqueda de la funcion
        $scope.categoria = $producto.categoriaId;
        $scope.cargarFichaTecnica();

        $scope.campoProducto01Editar = $producto.campo01;
        $scope.campoProducto02Editar = $producto.campo02;
        $scope.campoProducto03Editar = $producto.campo03;
        $scope.campoProducto04Editar = $producto.campo04;
        $scope.campoProducto05Editar = $producto.campo05;
        $scope.campoProducto06Editar = $producto.campo06;
        $scope.campoProducto07Editar = $producto.campo07;
        $scope.campoProducto08Editar = $producto.campo08;
        $scope.campoProducto09Editar = $producto.campo09;
        $scope.campoProducto10Editar = $producto.campo10;
        $scope.campoProducto11Editar = $producto.campo11;
        $scope.campoProducto12Editar = $producto.campo12;
        $scope.campoProducto13Editar = $producto.campo13;
        $scope.campoProducto14Editar = $producto.campo14;
        $scope.campoProducto15Editar = $producto.campo15;
        $scope.campoProducto16Editar = $producto.campo16;
        $scope.campoProducto17Editar = $producto.campo17;
        $scope.campoProducto18Editar = $producto.campo18;
        $scope.campoProducto19Editar = $producto.campo19;
        $scope.campoProducto20Editar = $producto.campo20;

        $scope.editarProductoModal = true;

    }

    $scope.cerrarEditarProductoModal = function(){
        $scope.editarProductoModal = false;
    }

    $scope.guardarEditarProducto =function(){
        $http.post('../controladores/guardarEditarProductoController.php', {
            'id': $scope.id,
            'modelo':$scope.modeloEditar,
            'descripcion': $scope.descripcionEditar,
            'precio':$scope.precioEditar,
            'mesesGarantia':$scope.mesesGarantiaEditar,
            'codigoFabricante':$scope.codigoFabricanteEditar,
            'codigoProveedor':$scope.codigoProveedorEditar,
            'sku':$scope.skuEditar,
            'video':$scope.videoEditar,
            'proveedor':$scope.proveedorEditar,
            'alto':$scope.altoEditar,
            'ancho':$scope.anchoEditar,
            'profundidad':$scope.profundidadEditar,
            'peso':$scope.pesoEditar,
            'marca':$scope.marcaEditar,
            'categoria':$scope.categoriaEditar,
            'campo01':$scope.campoProducto01Editar,
            'campo02':$scope.campoProducto02Editar,
            'campo03':$scope.campoProducto03Editar ,
            'campo04':$scope.campoProducto04Editar ,
            'campo05':$scope.campoProducto05Editar,
            'campo06':$scope.campoProducto06Editar,
            'campo07':$scope.campoProducto07Editar,
            'campo08':$scope.campoProducto08Editar,
            'campo09':$scope.campoProducto09Editar,
            'campo10':$scope.campoProducto10Editar,
            'campo11':$scope.campoProducto11Editar,
            'campo12':$scope.campoProducto12Editar,
            'campo13':$scope.campoProducto13Editar,
            'campo14':$scope.campoProducto14Editar,
            'campo15':$scope.campoProducto15Editar,
            'campo16':$scope.campoProducto16Editar,
            'campo17':$scope.campoProducto17Editar,
            'campo18':$scope.campoProducto18Editar,
            'campo19':$scope.campoProducto19Editar,
            'campo20':$scope.campoProducto20Editar
        
        }).success(function(response){
            if(response.respuesta == 1){
                alert('El producto se edito correctamente');
            }else if (response.respuesta == 0) {
                alert('Error al editar el producto.');
            }else if (response.respuesta == 2) {
                alert('Ocurrio un error al conectarse con la base de datos. Por favor vuelva a intentarlo mas tarde.');
            }else{
                alert('Se enviaron datos incorrectos a la base de datos.');
            }

            $scope.listarProductos();
            $scope.cerrarEditarProductoModal();
        });
    }

    $scope.editarFotoModal = false;

    $scope.cerrarEditarFotoModal = function(){
        $scope.editarFotoModal = false;
    }

    $scope.editarFoto = function($producto){
        $scope.imagenAnterior = $producto.imagen;
        $scope.productoAEditar = $producto.descripcion;
        $scope.productoAEditarId = $producto.id;

        $scope.editarFotoModal = true;
    }

    $scope.guardarEditarFoto = function(){
        var data = new FormData();
        var foto = document.getElementById('foto').files[0];

        data.append("foto", foto);
        data.append("idProducto", $scope.productoAEditarId);

        $http({
            method: 'POST',
            url: "../controladores/guardarEditarFotoProductoController.php",
            data: data,
            headers: {
                //'Content-Type': 'multipart/form-data'
                'Content-Type': undefined
            },
            //transformRequest: angular.identity
        }).success(function(response){
            
            if(response.respuesta == 1){
                alert('La imagen se cambio correctamente');
            }else if (response.respuesta == 0) {
                alert('Error al cambiar la imagen.');
            }else if (response.respuesta == 2) {
                alert('Ocurrio un error al conectarse con la base de datos. Por favor vuelva a intentarlo mas tarde.');
            }else{
                alert('Se enviaron datos incorrectos a la base de datos.');
            }

            document.getElementById('foto').value = '';
            $scope.listarProductos();
            $scope.cerrarEditarFotoModal();
        });
    }

    $scope.cambiarDisponible = function($id, $activo){
        $http.post('../controladores/cambiarDisponibleAdminController.php', {'idProducto': $id, 'activo': $activo, 'disponible': 1})
        .success(function(response){
            if(response.respuesta == 1){
                if(response.activo == 1 )
                    alert('El producto cambio su estado a disponible.');
                else
                    alert('El producto cambio su estado a NO disponible.');
            }else if (response.respuesta == 0) {
                alert('Error al cambiar el estado del producto.');
            }else if (response.respuesta == 2) {
                alert('Ocurrio un error al conectarse con la base de datos. Por favor vuelva a intentarlo mas tarde.');
            }else{
                alert('Se enviaron datos incorrectos a la base de datos.');
            }

            $scope.listarProductos();
        });
    }

    $scope.cambiarDestacado = function($id, $activo){
        $http.post('../controladores/cambiarDisponibleAdminController.php', {'idProducto': $id, 'activo': $activo, 'disponible':0})
        .success(function(response){
            if(response.respuesta == 1){
                if(response.activo == 1)
                    alert('El producto cambio a destacado.');
                else
                    alert('El producto cambio a NO destacado.');
            }else if (response.respuesta == 0) {
                alert('Error al cambiar el estado del producto.');
            }else if (response.respuesta == 2) {
                alert('Ocurrio un error al conectarse con la base de datos. Por favor vuelva a intentarlo mas tarde.');
            }else{
                alert('Se enviaron datos incorrectos a la base de datos.');
            }

            $scope.listarProductos();
        });
    }

     //CARGA MASIVA DE PRODUCTO
    $scope.cargaMasivaProductoDiv = false;

    $scope.mostrarCargaMasiva = function(){
        $scope.cargaMasivaProductoDiv = true;        
    }

    $scope.cerrarCargaMasiva = function(){
        $scope.cargaMasivaProductoDiv = false;
    }

    $scope.enviarArchivoCargaMasiva = function(){

        var data = new FormData();
        var archivoCarga = document.getElementById('archivoCarga').files[0];

        data.append("archivoCarga", archivoCarga);

        $http({
            method: 'POST',
            url: "../controladores/cargaMasivaProducto.php",
            data: data,
            headers: {
                'Content-Type': undefined
            }
        }).success(function(response){
            
            if(response.respuesta == 1){
                alert('Se cargaron los productos desde el archivo. ' + response.filas + ' productos fueron agregados.');
            }else if (response.respuesta == 0) {
                alert('Error al cargar el archivo. El archivo seleccionado supera el tamaño maximo de 2 Mb.');
            }else if (response.respuesta == 2) {
                alert('Ocurrio un error al intentar leer el archivo. Por favor vuelva a intentarlo mas tarde.');
            }else{
                alert('Se proceso mal el archivo.');
            }

            document.getElementById('archivoCarga').value = '';
            $scope.cantidadDePaginacion();
            $scope.listarProductos();
            $scope.cerrarCargaMasiva();
            $scope.cerrarCargaProducto();
        });
    }


    /**************** PAGINACION ***********************/
    $scope.desde = 0;
    $scope.limite = 5;
    $scope.claseActive = {'w3-green': true};

    //SE BUSCA EL TOTAL DE PRODUCTOS PARA CALCULAR LA CANTIDAD DE PAGINAS
    $scope.cantidadDePaginacion = function(){
      $http.post('../controladores/contarCantidadProductosAdminController.php', {})
      .success(function(response){
         $scope.cantidadProductos = response.cantidad;
         resto = $scope.cantidadProductos % $scope.limite;
         $scope.numeroDePaginas = ($scope.cantidadProductos - resto) / $scope.limite;
         if(resto > 0){
            $scope.numeroDePaginas++;
         }
         array = [];
         for(var i = 0; i<$scope.numeroDePaginas; i++){
            array.push((i+1));
         }
         $scope.paginaciones = array;
      });
    } 



    //BUSCA EL RESULTADO DE PRODUCTOS SEGUN LA PAGINA SELECCIONADA
    $scope.buscarSegunPagina = function( desdePaginacion){
      $scope.desde = desdePaginacion*$scope.limite - $scope.limite;
      $scope.listarProductos();
    }

    //BUSCA EL RESULTADO DE PRODUCTOS SEGUN LAS FLACHAS PULSADAS (ADELANTE O ATRAS)
    $scope.cambiarPagina = function(direccion, categoria){
      if(direccion == 0){
         if($scope.desde > 0)
            $scope.desde = $scope.desde - $scope.limite;
      }else{
         cantidadMaxima = $scope.numeroDePaginas * $scope.limite - $scope.limite;
         if($scope.desde < cantidadMaxima)
            $scope.desde = $scope.desde + $scope.limite;
      }
      $scope.listarProductos();
    }
    /****************** FIN PAGINACION */


});