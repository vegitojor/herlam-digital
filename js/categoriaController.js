app.controller("categoriaController", function ($scope, $http, $sce, $filter, $window) {
   

   $scope.mostrarLinea = false;
   $scope.mostrarCuadrado = true;
   $scope.ordenamiento = 0;

   $scope.preguntas;
   $scope.cantidad = 1;

   $scope.obtenerCategoria = function($id){
      $scope.idCategoriaModel = $id;
   }

   $scope.listarCategorias = function () {
       $http.post('../controladores/usuario/listarCategoriasController.php')
           .success(function (response) {
               $scope.categorias = response;
           })
   }

   $scope.listarMarcas = function () {
       $http.post('../controladores/usuario/listarMarcasController.php')
           .success(function (response) {
               $scope.marcas = response;
           })
   }

   

   $scope.listarproductosPorCategoria = function ($id) {
       $http.post('../controladores/usuario/listarProductosActivosPorCategoria.php', {'idCategoria': $id,'desde': $scope.desde,'limite':$scope.limite,
                                 'destacados': $scope.destacados,
                                 'marcaFiltro' : $scope.marcaFiltro,
                                 'campo01': $scope.campo01,
                                 'campo02': $scope.campo02,
                                 'campo03': $scope.campo03,
                                 'campo04': $scope.campo04,
                                 'campo05': $scope.campo05,
                                 'campo06': $scope.campo06,
                                 'campo07': $scope.campo07,
                                 'campo08': $scope.campo08,
                                 'campo09': $scope.campo09,
                                 'campo10': $scope.campo10,
                                 'campo11': $scope.campo11,
                                 'campo12': $scope.campo12,
                                 'campo13': $scope.campo13,
                                 'campo14': $scope.campo14,
                                 'campo15': $scope.campo15,
                                 'campo16': $scope.campo16,
                                 'campo17': $scope.campo17,
                                 'campo18': $scope.campo18,
                                 'campo19': $scope.campo19,
                                 'campo20': $scope.campo20,
                                 'orden': $scope.ordenamiento
                              })
           .success(function (response) {
               $scope.productos = response;
           })
   }

   $scope.traerCategoria = function ($id) {
       $http.post('../controladores/usuario/traerCategoria.php', {categoria: $id})
           .success(function (response) {
               $scope.categoria = response;
           })
   }

   $scope.cargarMoneda = function () {
       $http.post('../controladores/usuario/cargarMonedaController.php')
           .success(function (response) {
               $scope.moneda = response;
           })
   }


   $scope.cargarFichaTecnica = function ($id) {
       $http.post('../controladores/cargarFichaTecnicaController.php', {idCategoria: $id})
           .success(function (response) {
               $scope.ficha = response;
           })
   }


   $scope.cargarVideo = function ($producto) {
       $scope.link = $sce.trustAsResourceUrl($producto.video);
       return $scope.link;
   }

   $scope.urlVideo;
   $scope.asignarVideoAlModelo = function ($productoIterado) {
       $scope.urlVideo = $productoIterado.video;
   }

   //$scope.videoPrueba = "https://www.youtube.com/embed/y910FVrywFU";
   $scope.formularioPregunta = false;

   $scope.mostrarPregunta = function () {
       $scope.formularioPregunta = true;
   }

   $scope.ocultarPregunta = function () {
       $scope.formularioPregunta = false;

   }
   
   $scope.valorarProducto = function ($idUsuario, $idProducto) {
       if ($idUsuario == 0)
           bootbox.alert('Debe iniciar seción para poder valorar el producto. Gracias');
       else $http.post('../controladores/usuario/valorarProductoController.php', {
           usuario: $idUsuario,
           producto: $idProducto
            }).success(function (response) {
               $scope.valoracion = response;

               if ($scope.valoracion.respuesta == 1) {
                   bootbox.alert('Ha valorado un producto. Gracias por su colaboración!');

               }
               else if ($scope.valoracion.respuesta == 2)
                   bootbox.alert('Usted ya ha valorado este producto.');
               else if ($scope.valoracion.respuesta == 3)
                   bootbox.alert('Se introducieron valores erroneos!');
               else
                   bootbox.alert('Ocurrio un error con la conexción. Vuelva a intentarlo en unos momentos.');
           });
   }

   $scope.enviarPregunta = function($idUsuario, $idProducto){
         $scope.preguntaBoootbox = "";
         $scope.idProducto = $idProducto;
         $scope.fechaActual = new Date();
         $scope.fechaActual = $filter('date')($scope.fechaActual, 'yyyy-MM-dd HH:mm:ss');
         bootbox.prompt({ 
           size: "medium",
           title: "Acerquenos su inquietud:",
           buttons: {
              confirm: {
                  label: 'Enviar',
                  className: 'btn-success'
              },
              cancel: {
                  label: 'Cancelar',
                  className: 'btn-danger'
              }
          }, 
           callback: function(result){ if(result != null){
                                          $scope.preguntaBoootbox = result;
                                          $http.post('../controladores/usuario/guardarPreguntaController.php', 
                                             {'idUsuario':$idUsuario, 'pregunta': $scope.preguntaBoootbox , 'idProducto':$idProducto, 'fecha': $scope.fechaActual})
                                          .success(function(response){
                                             if(response.respuesta == 1){
                                                bootbox.alert('Su pregunta se envió con éxito! El vendedor la respondera a la brevedad.',
                                                   function(){
                                                      $scope.listarPreguntas($scope.idProducto);
                                                   });
                                             }
                                             else if(response.respuesta == 2){
                                                bootbox.alert('Su pregunta no pudo ser enviada! Por favor vuelva a intentarlo en unos momentos.');
                                             }
                                             else if (response.respuesta == 3) 
                                                bootbox.alert('Se introducieron valores erroneos!');
                                             else
                                                bootbox.alert('Ocurrio un error con la conexción. Vuelva a intentarlo en unos momentos.');
                                          });
                                        } 
              }
         })
   }

   $scope.listarPreguntas = function($idProducto, todas){
      $http.post('../controladores/usuario/listarPreguntasController.php', {'idProducto':$idProducto, 'todas': todas})
      .success(function(response){
         $scope.preguntas = response;
      });

      if(todas == 1 )
        $scope.botonVerTodasPreguntas = false;
      else
        $scope.botonVerTodasPreguntas = true;
   }

   $scope.agregarAlCarrito = function($idUsuario, $idProducto, $cantidad){
      $scope.fechaActual = new Date();
      $scope.fechaActual = $filter('date')($scope.fechaActual, 'yyyy-MM-dd HH:mm:ss');
      $http.post('../controladores/usuario/agregarAlCarritoController.php', {'usuario':$idUsuario, 'producto':$idProducto, 'fecha':$scope.fechaActual,'cantidad': $cantidad})
      .success(function(response){
        $scope.agregado = response;

               if ($scope.agregado.respuesta == 1) {
                   
                   $window.location.href = "carrito.php";  
               }
               else if ($scope.agregado.respuesta == 2)
                   bootbox.alert('Usted ya ha agregado este producto a su carrito de compras.');
               else if ($scope.agregado.respuesta == 3)
                   bootbox.alert('Se introducieron valores erroneos!');
               else
                   bootbox.alert('Ocurrio un error con la conexción. Vuelva a intentarlo en unos momentos.');
      });
   }

   $scope.restarCantidad = function(){
      if ($scope.cantidad > 1 )
         $scope.cantidad --;
   }

   $scope.sumarCantidad = function(){
      $scope.cantidad ++;
   }

   //BUSQUEDA DE FILTROS - SE REALIZA UN LLAMADO AJAX POR CADA CAMPO DE LA FICHA TECNICA
   $scope.traerOpcionesDeFiltrosCampo01 = function(){
      $http.post('../controladores/usuario/traerOpcionesDeFiltrosController.php', {'idCategoria': $scope.idCategoriaModel, 'campo': 1 })
      .success(function(response){
         $scope.opcionesFiltroCampo01 = response;
      });
   }

   $scope.traerOpcionesDeFiltrosCampo02 = function(){
      $http.post('../controladores/usuario/traerOpcionesDeFiltrosController.php', {'idCategoria': $scope.idCategoriaModel, 'campo': 2 })
      .success(function(response){
         $scope.opcionesFiltroCampo02 = response;
      });
   }

   $scope.traerOpcionesDeFiltrosCampo03 = function(){
      $http.post('../controladores/usuario/traerOpcionesDeFiltrosController.php', {'idCategoria': $scope.idCategoriaModel, 'campo': 3 })
      .success(function(response){
         $scope.opcionesFiltroCampo03 = response;
      });
   }

   $scope.traerOpcionesDeFiltrosCampo04 = function(){
      $http.post('../controladores/usuario/traerOpcionesDeFiltrosController.php', {'idCategoria': $scope.idCategoriaModel, 'campo': 4 })
      .success(function(response){
         $scope.opcionesFiltroCampo04 = response;
      });
   }

   $scope.traerOpcionesDeFiltrosCampo05 = function(){
      $http.post('../controladores/usuario/traerOpcionesDeFiltrosController.php', {'idCategoria': $scope.idCategoriaModel, 'campo': 5 })
      .success(function(response){
         $scope.opcionesFiltroCampo05 = response;
      });
   }

   $scope.traerOpcionesDeFiltrosCampo06 = function(){
      $http.post('../controladores/usuario/traerOpcionesDeFiltrosController.php', {'idCategoria': $scope.idCategoriaModel, 'campo': 6 })
      .success(function(response){
         $scope.opcionesFiltroCampo06 = response;
      });
   }

   $scope.traerOpcionesDeFiltrosCampo07 = function(){
      $http.post('../controladores/usuario/traerOpcionesDeFiltrosController.php', {'idCategoria': $scope.idCategoriaModel, 'campo': 7 })
      .success(function(response){
         $scope.opcionesFiltroCampo07 = response;
      });
   }

   $scope.traerOpcionesDeFiltrosCampo08 = function(){
      $http.post('../controladores/usuario/traerOpcionesDeFiltrosController.php', {'idCategoria': $scope.idCategoriaModel, 'campo': 8})
      .success(function(response){
         $scope.opcionesFiltroCampo08 = response;
      });
   }

   $scope.traerOpcionesDeFiltrosCampo09 = function(){
      $http.post('../controladores/usuario/traerOpcionesDeFiltrosController.php', {'idCategoria': $scope.idCategoriaModel, 'campo': 9 })
      .success(function(response){
         $scope.opcionesFiltroCampo09 = response;
      });
   }

   $scope.traerOpcionesDeFiltrosCampo10 = function(){
      $http.post('../controladores/usuario/traerOpcionesDeFiltrosController.php', {'idCategoria': $scope.idCategoriaModel, 'campo': 10})
      .success(function(response){
         $scope.opcionesFiltroCampo10 = response;
      });
   }

   $scope.traerOpcionesDeFiltrosCampo11 = function(){
      $http.post('../controladores/usuario/traerOpcionesDeFiltrosController.php', {'idCategoria': $scope.idCategoriaModel, 'campo': 11 })
      .success(function(response){
         $scope.opcionesFiltroCampo11 = response;
      });
   }

   $scope.traerOpcionesDeFiltrosCampo12 = function(){
      $http.post('../controladores/usuario/traerOpcionesDeFiltrosController.php', {'idCategoria': $scope.idCategoriaModel, 'campo': 12})
      .success(function(response){
         $scope.opcionesFiltroCampo12 = response;
      });
   }

   $scope.traerOpcionesDeFiltrosCampo13 = function(){
      $http.post('../controladores/usuario/traerOpcionesDeFiltrosController.php', {'idCategoria': $scope.idCategoriaModel, 'campo': 13 })
      .success(function(response){
         $scope.opcionesFiltroCampo13 = response;
      });
   }

   $scope.traerOpcionesDeFiltrosCampo14 = function(){
      $http.post('../controladores/usuario/traerOpcionesDeFiltrosController.php', {'idCategoria': $scope.idCategoriaModel, 'campo': 14 })
      .success(function(response){
         $scope.opcionesFiltroCampo14 = response;
      });
   }

   $scope.traerOpcionesDeFiltrosCampo15 = function(){
      $http.post('../controladores/usuario/traerOpcionesDeFiltrosController.php', {'idCategoria': $scope.idCategoriaModel, 'campo': 15 })
      .success(function(response){
         $scope.opcionesFiltroCampo15 = response;
      });
   }

   $scope.traerOpcionesDeFiltrosCampo16 = function(){
      $http.post('../controladores/usuario/traerOpcionesDeFiltrosController.php', {'idCategoria': $scope.idCategoriaModel, 'campo': 16 })
      .success(function(response){
         $scope.opcionesFiltroCampo16 = response;
      });
   }

   $scope.traerOpcionesDeFiltrosCampo17 = function(){
      $http.post('../controladores/usuario/traerOpcionesDeFiltrosController.php', {'idCategoria': $scope.idCategoriaModel, 'campo': 17 })
      .success(function(response){
         $scope.opcionesFiltroCampo17 = response;
      });
   }

   $scope.traerOpcionesDeFiltrosCampo18 = function(){
      $http.post('../controladores/usuario/traerOpcionesDeFiltrosController.php', {'idCategoria': $scope.idCategoriaModel, 'campo': 18 })
      .success(function(response){
         $scope.opcionesFiltroCampo18 = response;
      });
   }

   $scope.traerOpcionesDeFiltrosCampo19 = function(){
      $http.post('../controladores/usuario/traerOpcionesDeFiltrosController.php', {'idCategoria': $scope.idCategoriaModel, 'campo': 19 })
      .success(function(response){
         $scope.opcionesFiltroCampo19 = response;
      });
   }

   $scope.traerOpcionesDeFiltrosCampo20 = function(){
      $http.post('../controladores/usuario/traerOpcionesDeFiltrosController.php', {'idCategoria': $scope.idCategoriaModel, 'campo': 20 })
      .success(function(response){
         $scope.opcionesFiltroCampo20 = response;
      });
   }

   $scope.traerOpcionesDeFiltros = function(){
      $scope.traerOpcionesDeFiltrosCampo01();
      $scope.traerOpcionesDeFiltrosCampo02();
      $scope.traerOpcionesDeFiltrosCampo03();
      $scope.traerOpcionesDeFiltrosCampo04();
      $scope.traerOpcionesDeFiltrosCampo05();
      $scope.traerOpcionesDeFiltrosCampo06();
      $scope.traerOpcionesDeFiltrosCampo07();
      $scope.traerOpcionesDeFiltrosCampo08();
      $scope.traerOpcionesDeFiltrosCampo09();
      $scope.traerOpcionesDeFiltrosCampo10();
      $scope.traerOpcionesDeFiltrosCampo11();
      $scope.traerOpcionesDeFiltrosCampo12();
      $scope.traerOpcionesDeFiltrosCampo13();
      $scope.traerOpcionesDeFiltrosCampo14();
      $scope.traerOpcionesDeFiltrosCampo15();
      $scope.traerOpcionesDeFiltrosCampo16();
      $scope.traerOpcionesDeFiltrosCampo17();
      $scope.traerOpcionesDeFiltrosCampo18();
      $scope.traerOpcionesDeFiltrosCampo19();
      $scope.traerOpcionesDeFiltrosCampo20();
   }

   $scope.buscarProductosPorFiltro = function(){
      $scope.desde = 0;
      $scope.cantidadDePaginacion($scope.idCategoriaModel);
      $scope.listarproductosPorCategoria($scope.idCategoriaModel);
   }
   /**********************FIN BUSQUEDA DE FILTROS****************/


   /* FILTRAR DESTACADOS */
   $scope.destacados = false;
   $scope.filtrarDestacados = function(){
    
    $scope.buscarProductosPorFiltro();
   }

   $scope.elegirVistaLinea = function(){
    $scope.mostrarCuadrado = false;
    $scope.mostrarLinea = true;
   }

   $scope.elegirVistaCuadrado = function(){
    $scope.mostrarCuadrado = true;
    $scope.mostrarLinea = false;
   }

   // ************** Compartir en redes sociales  *******/
   $scope.callShareSocial = function(id, imagen){
    // var divRedSocial = document.getElementById("share-" + id);
    shareSocial( id, imagen, $scope.idCategoriaModel );
   }

   /* ORDENAMIENTO ALFABETICO Y POR PRECIO */
   $scope.ordenAlfabetico = function(indice){
    switch ( indice ){
        case 0:
            $scope.ordenamiento = 0;
            break;
        case 1:
            $scope.ordenamiento = 1;
            break;
        case 2:
            $scope.ordenamiento = 2;
            break;
        case 3:
            $scope.ordenamiento = 3;
            break;
    }

    $scope.listarproductosPorCategoria($scope.idCategoriaModel);
   }


   /**************** PAGINACION ***********************/
   $scope.desde = 0;
   $scope.limite = 15;
   $scope.claseActive = {active: true};

   //SE BUSCA EL TOTAL DE PRODUCTOS PARA CALCULAR LA CANTIDAD DE PAGINAS
   $scope.cantidadDePaginacion = function($idCategoria){
      $http.post('../controladores/usuario/contarCantidadDeProdutosController.php', {'idCategoria': $idCategoria,
                                  'destacados': $scope.destacados,
                                  'marcaFiltro': $scope.marcaFiltro,
                                 'campo01': $scope.campo01,
                                 'campo02': $scope.campo02,
                                 'campo03': $scope.campo03,
                                 'campo04': $scope.campo04,
                                 'campo05': $scope.campo05,
                                 'campo06': $scope.campo06,
                                 'campo07': $scope.campo07,
                                 'campo08': $scope.campo08,
                                 'campo09': $scope.campo09,
                                 'campo10': $scope.campo10,
                                 'campo11': $scope.campo11,
                                 'campo12': $scope.campo12,
                                 'campo13': $scope.campo13,
                                 'campo14': $scope.campo14,
                                 'campo15': $scope.campo15,
                                 'campo16': $scope.campo16,
                                 'campo17': $scope.campo17,
                                 'campo18': $scope.campo18,
                                 'campo19': $scope.campo19,
                                 'campo20': $scope.campo20
                              })
      .success(function(response){
         $scope.cantidadProductos = response.cantidad;
         resto = $scope.cantidadProductos%$scope.limite;
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
   $scope.buscarSegunPagina = function(categoria, desdePaginacion){
      $scope.desde = desdePaginacion*$scope.limite - $scope.limite;
      $scope.listarproductosPorCategoria(categoria);
   }

   //BUSCA EL RESULTADO DE PRODUCTOS SEGUN LAS FLECHAS PULSADAS (ADELANTE O ATRAS)
   $scope.cambiarPagina = function(direccion, categoria){
      if(direccion == 0){
         if($scope.desde > 0)
            $scope.desde = $scope.desde - $scope.limite;
      }else{
         cantidadMaxima = $scope.numeroDePaginas * $scope.limite - $scope.limite;
         if($scope.desde < cantidadMaxima)
            $scope.desde = $scope.desde + $scope.limite;
      }
      $scope.listarproductosPorCategoria(categoria);
   }
   /****************** FIN PAGINACION */
});

