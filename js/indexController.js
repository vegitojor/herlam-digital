app.controller("indexController", function ($scope, $http, $filter, $window) {
    
    
    

    $scope.listarCategorias = function () {
        $http.post('controladores/usuario/listarCategoriasController.php')
            .success(function (response) {
                $scope.categorias = response;
            })
    }

    $scope.listarproductosDestacados = function () {
        $http.post('controladores/usuario/listarProductosActivosDestacados.php', {'limite':6})
            .success(function (response) {
                $scope.productos = response;
            })
    }

    $scope.cargarMoneda = function () {
        $http.post('controladores/usuario/cargarMonedaController.php')
            .success(function (response) {
                $scope.moneda = response;
                if($scope.moneda.valor == 0 ){
                    bootbox.alert("Nos encontramos en proceso de inventario. A la brevedad encontrara el listado actualizado de productos y precios");
                }
            })
    }

    $scope.cargarFichaTecnica = function ($id) {
        $http.post('controladores/cargarFichaTecnicaController.php', {idCategoria: $id})
            .success(function (response) {
                $scope.ficha = response;
            })
    }

    //Verificacion de celular cargado
    $scope.solicitarCelular = function(idUsuario){
        $scope.usuarioId = idUsuario
        bootbox.alert('Ahora disponemos de comunicación vía Whatsapp. Para habilitarlo agreguelo en el siguiente formulario.', function(){$('#cargarCelularModal').modal('show')});
        
    }

    $scope.guardarCelular = function(){
        $http.post('controladores/cargarCelularController.php', {celular: $scope.celular, usuario: $scope.usuarioId})
            .success(function (response) {
                $('#cargarCelularModal').modal('hide')
                bootbox.alert('Gracias por ser parte del equipo Herlam.Es necesario que vuelva a iniciar seción para que se apliquen los cambios.', function(){
                    window.location.href = 'index.php'
                })
            })
    }

   //FUNCIONALIDAD DE AGREGAR AL CARRITO
   $scope.cantidad = 1;

   $scope.agregarAlCarrito = function($idUsuario,$idProducto, $cantidad){
      $scope.fechaActual = new Date();
      $scope.fechaActual = $filter('date')($scope.fechaActual, 'yyyy-MM-dd HH:mm:ss');
      $http.post('controladores/usuario/agregarAlCarritoController.php', {'usuario':$idUsuario, 'producto':$idProducto, 'fecha':$scope.fechaActual,'cantidad': $cantidad})
      .success(function(response){
        $scope.agregado = response;

               if ($scope.agregado.respuesta == 1) {
                   
                   $window.location.href = "vistas/carrito.php";  
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

   //FUNCIONALIDAD DE PREGUNTAS
    $scope.preguntas;

   $scope.listarPreguntas = function($idProducto){
      $http.post('controladores/usuario/listarPreguntasController.php', {'idProducto':$idProducto, 'todas': 0})
      .success(function(response){
         $scope.preguntas = response;
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
                                          $http.post('controladores/usuario/guardarPreguntaController.php', 
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

   //LIBRERIA DE VIDEOS PARA ACEPTAR LOS LINK
    $scope.cargarVideo = function ($producto) {
       $scope.link = $sce.trustAsResourceUrl($producto.video);
       return $scope.link;
   }
});