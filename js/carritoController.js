app.controller("carritoController", function ($scope, $http, $sce, $filter) {


	/*$scope.productosDelCarrito = [];*/
  $scope.totalDelCarrito = 0;

  $scope.preloader = false;
  // $scope.tabPaso1 = true;

  $scope.tab1 = true;
  $scope.tab2 = false;
  $scope.tab3 = false;

	$scope.listarCategorias = function () {
       $http.post('../controladores/usuario/listarCategoriasController.php')
           .success(function (response) {
               $scope.categorias = response;
           })
   }



   $scope.cargarMoneda = function () {
       $http.post('../controladores/usuario/cargarMonedaController.php')
           .success(function (response) {
               $scope.moneda = response;
           })
   }

   $scope.cargarProductosCarrito = function($idUsuario){
      $scope.usuario = $idUsuario;
   		$http.post('../controladores/usuario/cargarProductosCarritoController.php', {'usuario': $idUsuario})
   		.success(function(response){
   			$scope.productosDelCarrito = response;

        $scope.totalDelCarrito = 0;
        $scope.pesoTotal = 0;
        $scope.paquetes = "";
        angular.forEach($scope.productosDelCarrito, function(value, key){
            $scope.totalDelCarrito = $scope.totalDelCarrito + (value.cantidad * (value.precio * $scope.moneda.valor));

            $scope.pesoTotal = $scope.pesoTotal + (value.peso * value.cantidad);

            $scope.paquetes = $scope.paquetes + value.alto + "x" + value.ancho + "x" + value.largo;
            if ( key > $scope.productosDelCarrito.lentgh - 1 ){
              $scope.paquetes += ",";
            }
        });

        //generarCheckoutBasicoMP($scope.usuario);
   		});
   }

   $scope.generarCheckoutBasicoMP = function($idUsuario){
      $http.post('../controladores/usuario/generarCheckoutBasicoMPController.php', {'usuario': $idUsuario})
      .success(function(response){
        $scope.linkPagoMercadoPago = response;
      });
   }

   $scope.quitarDelCarrito = function($idUsuario, $idProducto, cantidad){
   		$scope.usuario = $idUsuario;
   		$http.post('../controladores/usuario/quitarDelCarritoController.php', {'usuario': $idUsuario, 'producto': $idProducto, 'cantidad': cantidad})
   		.success(function(response){

   			
 			if(response.respuesta == 1){
				$scope.cargarProductosCarrito($scope.usuario);	
        $scope.totalDelCarrito = 0;
        angular.forEach($scope.productosDelCarrito, function(value, key){
            $scope.totalDelCarrito = $scope.totalDelCarrito + (value.cantidad * (value.precio * $scope.moneda.valor));
        });
			}
			else if(response.respuesta == 2){
				bootbox.alert('No fue posible eliminar este producto del carrito! Por favor vuelva a intentarlo en unos momentos.');
			}
			else if (response.respuesta == 3) 
				bootbox.alert('Se introducieron valores erroneos!');
			else
				bootbox.alert('Ocurrio un error con la conexción. Vuelva a intentarlo en unos momentos.');
   		});
   }

   $scope.setearProductoCambioCantidad = function(idUsuario, idProducto, cantidad){
      $scope.usuario = idUsuario;
      $scope.productoParamodificarCantidad = idProducto;
      $scope.viejaCantidad = cantidad;
   }

   $scope.modificarCantidadDesdeModal = function(){
      $http.post("../controladores/usuario/cambiarCantidadProductoEncarritoController.php", 
        {'usuario': $scope.usuario, 'producto': $scope.productoParamodificarCantidad, 'cantidad': $scope.nuevaCantidad, 'viejaCantidad': $scope.viejaCantidad})
      .success( function( response ){
          $("#modificarCantidadModal").modal('hide');
          $scope.nuevaCantidad = null;

          if(response.respuesta == 1){
            $scope.cargarProductosCarrito($scope.usuario);
          }
          else if(response.respuesta == 2){
            bootbox.alert('No fue posible modificar la cantidad a este producto! Por favor vuelva a intentarlo en unos momentos.');
          }
          else if (response.respuesta == 3) 
            bootbox.alert('Se introducieron valores erroneos!');
          else
            bootbox.alert('Ocurrio un error con la conexción. Vuelva a intentarlo en unos momentos.');
          
          
      } );
   }

   $scope.pasarAlSiguente = function( tab ){
      if ( tab == 2 ){
        $scope.tab1 = false;
        $scope.tab2 = true;
        $scope.tab3 = false;
      }else if( tab == 3 ){
        $scope.tab1 = false;
        $scope.tab2 = false;
        $scope.tab3 = true;
      }else if( tab == 1 ){
        $scope.tab1 = true;
        $scope.tab2 = false;
        $scope.tab3 = false;
      }
   }


//========================================================================================
//   ***funciones para el envio de la compra
//========================================================================================
   $scope.envioVendedorDiv = false;
   $scope.envioDomicilioDiv = true;
   $scope.envioProvinciaLocalidad = true;
   $scope.costoEnvio = null;
   $scope.tipoServicioEntrega = "N";
   $scope.costoSucursalATotalizar = null;
   
   $scope.determinarTipoDeEnvio = function( tipo ){
      if (tipo == "domicilio") {
        $scope.envioDomicilioDiv = true;
        $scope.envioProvinciaLocalidad = true;
        $scope.envioVendedorDiv = false;

       $scope.correo = "";
      }else if( tipo == "sucursal" ){
        $scope.envioProvinciaLocalidad = true;
        $scope.envioDomicilioDiv = false;
        $scope.envioVendedorDiv = false;

        $scope.calleDomicilio = "";
      }else if( tipo == "vendedor" ){
        $scope.envioVendedorDiv = true;
        $scope.envioProvinciaLocalidad = false;
        $scope.envioDomicilioDiv = false;
      }
   }

   $scope.cargarProvincias = function(){
    $http.get("../controladores/cargarProvinciaEnvioPackController.php", {'idProvincia': null})
      .success(function(data){
        $scope.preloader = false;
        $scope.provincias =  data;
      })
  }

  $scope.cargarLocalidades = function(){
    $scope.preloader = true;
    $http.post("../controladores/cargarProvinciaEnvioPackController.php", {'idProvincia': $scope.provincia})
      .success(function(data){
        $scope.localidades = data;
        $scope.preloader = false;
      })
  }


  $scope.calcularCostoEnvio = function( domicilio, sucursal ){
    $scope.preloader = true;
    if(domicilio){
      if( $scope.envioDomicilioDiv ){
          $scope.calcularCostoEnvioDomicilio();
      }
    }else if(sucursal){
      if( !$scope.envioDomicilioDiv )
          $scope.costoSucursalATotalizar = null;
          $scope.calcularCostoenvioSucursal()
    }else{
      bootbox.alert("El formulario no es valido.");
    }
  }

  $scope.calcularCostoEnvioDomicilio = function(){
    $http.post("../controladores/calcularCostoEnvioDomicilioController.php", {'provincia': $scope.provincia, 'codigoPostal': $scope.codigoPostal, 
                    'peso': $scope.pesoTotal, 'paquetes': $scope.paquetes, 'servicio': $scope.tipoServicioEntrega})
    .success( function(response){
        $scope.costoEnvio = response[0];
        $scope.preloader = false;
    } );
  }

  $scope.cargarCorreos = function(){
    $http.post("../controladores/obtenerCorreosController.php", {'filtrarActivos': 1})
    .success( function(response){
      $scope.correos = response;
    } );
  }

  $scope.calcularCostoenvioSucursal = function(){
    $http.post("../controladores/calcularCostoEnvioSucursalController.php", {'provincia': $scope.provincia, 'localidad': $scope.localidad, 'correo': $scope.correo,
                'peso': $scope.pesoTotal, 'paquetes': $scope.paquetes})
    .success(function(response){
      $scope.costoEnvioSucursal = response;
      $scope.preloader = false;
    });
  }

  $scope.confirmarValorDeEnviosucursal = function( index ){
      $scope.costoSucursalATotalizar = $scope.costoEnvioSucursal[index];
  }
});