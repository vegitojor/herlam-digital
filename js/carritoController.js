app.controller("carritoController", function ($scope, $http, $sce, $filter, $window) {
	$scope.totalDelCarrito = 0;

	$scope.preloader = false;

	$scope.tab1 = true;
	$scope.tab2 = false;
	$scope.tab3 = false;

	$scope.usuarioSesion;

	$scope.condicionesIva = [
		{"id":1, "name":"Consumidor final"},
		{"id":2, "name":"Monotributista"},
		{"id":3, "name":"Exento"},
		{"id":4, "name":"Responsable inscripto"},
		{"id":'', "name":"Seleccione su condicion de IVA"},
	];

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
   $scope.envioDomicilioDiv = false;

   $scope.envioNoSeleccionado = false;
   $scope.tipoEnvioDiv = true;

   	$scope.datosFacturacionDiv = false;
	$scope.envioDiv = true;
   
	$scope.determinarTipoDeEnvio = function( tipo ){
		if (tipo == "domicilio") {
			$scope.datosFacturacionDiv = false;
			$scope.envioDiv = true;
		}else if( tipo == "sucursal" ){
			$scope.datosFacturacionDiv = true;
      $scope.envioDiv = false;
      
		}
	}

	$scope.mostrarFormEnvio = function(){
    $scope.envioNoSeleccionado = true;
		if($scope.tipoEnvio == 1){
      $scope.envioDomicilioDiv = true;
      $scope.envioVendedorDiv = false;
		}	else{
      $scope.envioDomicilioDiv = false;
      $scope.envioVendedorDiv = true;
    }
  }
  
  $scope.validarFormEnvio = function(){
		if($scope.envioNoSeleccionado){
      if($scope.tipoEnvio == 1 ){
        if(!$scope.envioDomiciolioForm.$valid){
          bootbox.alert("Debe completar los campos requeridos.");
          return false;
        }
      }
      $scope.determinarTipoDeEnvio("sucursal");
		}	else{
      bootbox.alert("Debe elegir una forma de envio y completar los datos requeridos para continuar.");
    }
	}

  $scope.cargarProvincias = function(){
		$http.get("../controladores/cargarProvinciasController.php")
			.success(function(data){
				$scope.provincias =  data;
				$scope.preloader = false;
			})
  }
  
  $scope.cargarLocalidades = function(){
		$http.post("../controladores/cargarLocalidadesController.php", {'idProvincia': $scope.provincia})
			.success(function(data){
				$scope.preloader = false;
				$scope.localidades = data;
			})
	}

  // $scope.cargarLocalidades = function(){
  //   $scope.preloader = true;
  //   $http.post("../controladores/cargarProvinciaEnvioPackController.php", {'idProvincia': $scope.provincia})
  //     .success(function(data){
  //       $scope.localidades = data;
  //       $scope.preloader = false;
  //     })
  // }


  $scope.calcularCostoEnvio = function( domicilio, sucursal ){
    // $scope.preloader = true;
    // if(domicilio){
    //   if( $scope.envioDomicilioDiv ){
    //       $scope.calcularCostoEnvioDomicilio();
    //   }
    // }else if(sucursal){
    //   if( !$scope.envioDomicilioDiv )
    //       $scope.costoSucursalATotalizar = null;
    //       $scope.calcularCostoenvioSucursal()
    // }else{
    //   bootbox.alert("El formulario no es valido.");
    // }
  }

  $scope.calcularCostoEnvioDomicilio = function(){
    // $http.post("../controladores/calcularCostoEnvioDomicilioController.php", {'provincia': $scope.provincia, 'codigoPostal': $scope.codigoPostal, 
    //                 'peso': $scope.pesoTotal, 'paquetes': $scope.paquetes, 'servicio': $scope.tipoServicioEntrega})
    // .success( function(response){
    //     $scope.costoEnvio = response[0];
    //     $scope.preloader = false;
    // } );
  }

  $scope.cargarCorreos = function(){
    // $http.post("../controladores/obtenerCorreosController.php", {'filtrarActivos': 1})
    // .success( function(response){
    //   $scope.correos = response;
    // } );
  }

  $scope.calcularCostoenvioSucursal = function(){
    // $http.post("../controladores/calcularCostoEnvioSucursalController.php", {'provincia': $scope.provincia, 'localidad': $scope.localidad, 'correo': $scope.correo,
    //             'peso': $scope.pesoTotal, 'paquetes': $scope.paquetes})
    // .success(function(response){
    //   $scope.costoEnvioSucursal = response;
    //   $scope.preloader = false;
    // });
  }

  $scope.confirmarValorDeEnviosucursal = function( index ){
      $scope.costoSucursalATotalizar = $scope.costoEnvioSucursal[index];
  }


  $scope.obtenerUsuario = function(array){
    // console.log(array);
    $scope.usuarioSesion = array;

    $scope.localidad = $scope.usuarioSesion.id_localidad;
    $scope.calleDomicilio = $scope.usuarioSesion.domicilio;
    $scope.pisoDomicilio = $scope.usuarioSesion.piso;
    $scope.deptoDomicilio = $scope.usuarioSesion.depto;
    $scope.codigoPostal = $scope.usuarioSesion.codigo_postal;
    $scope.nombreApellido = $scope.usuarioSesion.nombre + " " + $scope.usuarioSesion.apellido;
    $scope.razonSocial = $scope.usuarioSesion.usuario;
    $scope.cuitCuil = $scope.usuarioSesion.cuit_cuil;
    $scope.condicionIva = $scope.usuarioSesion.id_condicion_iva
 }

	$scope.generarPedido = function(){
		$scope.preloader = true;
		$scope.fechaActual = new Date();
			$scope.fechaActual = $filter('date')($scope.fechaActual, 'yyyy-MM-dd HH:mm:ss');
		$http.post('../controladores/usuario/generarPedidoController.php', {
			"localidad": $scope.localidad,
			"domicilio": $scope.calleDomicilio,
			"piso": $scope.pisoDomicilio,
			"codigoPostal": $scope.codigoPostal,
			"cuitCuil": $scope.cuitCuil,
			"depto": $scope.deptoDomicilio,
			"condicionIva": $scope.condicionIva,
			"idUsuario": $scope.usuarioSesion.id,
			"fechaActual": $scope.fechaActual,
			"tipoEnvio": $scope.tipoEnvio
		})
		.success(function(response){
			if(response.respuesta == 1){
				$window.location.href='./pedido.php';
			}
			else if(response.respuesta == 2){
				bootbox.alert('No fue posible generar el pedido. Por favor vuelva a intentarlo en unos momentos');
			}
			else if (response.respuesta == 3) 
				bootbox.alert('Se introducieron valores erroneos!');
			else
				bootbox.alert('Ocurrio un error con la conexción. Vuelva a intentarlo en unos momentos.');
		});
	}
});