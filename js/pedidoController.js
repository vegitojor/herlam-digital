app.controller("pedidoController", function ($scope, $http, $sce, $filter, $window) {
	$scope.totalDelCarrito = 0;

	$scope.preloader = false;

	$scope.tab1 = true;
	$scope.tab2 = false;
	$scope.tab3 = false;

	$scope.usuarioSesion;

	// $scope.estiloEstado = {
	// 	info: pedido.id_estado_pedido == 1,
	// 	success: pedido.id_estado_pedido == 3,
	// 	warning: pedido.id_estado_pedido == 4 || pedido.id_estado_pedido == 2,
	// 	danger: pedido.id_estado_pedido == 6
	// }



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

   	$scope.pedidos = [];
	$scope.cargarPedidos = function(){
		// $scope.usuario = $idUsuario;
		$http.post('../controladores/usuario/cargarPedidosController.php', {'usuario': $scope.usuarioSesion.id})
		.success(function(response){
			$scope.pedidos = response;
		});
	}



//========================================================================================
//   ***funciones para el envio de la compra
//========================================================================================
  
  
	// $scope.validarFormEnvio = function(){
	// 	if($scope.envioNoSeleccionado){
	// 		if($scope.tipoEnvio == 1 ){
	// 			if(!$scope.envioDomiciolioForm.$valid){
	// 			bootbox.alert("Debe completar los campos requeridos.");
	// 			return false;
	// 			}
	// 		}
	// 		$scope.determinarTipoDeEnvio("sucursal");
	// 	}else{
	// 		bootbox.alert("Debe elegir una forma de envio y completar los datos requeridos para continuar.");
	// 	}
	// }

	// $scope.cargarProvincias = function(){
	// 		$http.get("../controladores/cargarProvinciasController.php")
	// 			.success(function(data){
	// 				$scope.provincias =  data;
	// 				$scope.preloader = false;
	// 			})
	// }
  
	// $scope.cargarLocalidades = function(){
	// 		$http.post("../controladores/cargarLocalidadesController.php", {'idProvincia': $scope.provincia})
	// 			.success(function(data){
	// 				$scope.preloader = false;
	// 				$scope.localidades = data;
	// 			})
	// 	}

  // $scope.cargarLocalidades = function(){
  //   $scope.preloader = true;
  //   $http.post("../controladores/cargarProvinciaEnvioPackController.php", {'idProvincia': $scope.provincia})
  //     .success(function(data){
  //       $scope.localidades = data;
  //       $scope.preloader = false;
  //     })
  // }


  


	$scope.obtenerUsuario = function(array){
		// console.log(array);
		$scope.usuarioSesion = array;
	}

	// $scope.generarPedido = function(){
	// 	$scope.preloader = true;
	// 	$scope.fechaActual = new Date();
	// 		$scope.fechaActual = $filter('date')($scope.fechaActual, 'yyyy-MM-dd HH:mm:ss');
	// 	$http.post('../controladores/usuario/generarPedidoController.php', {
	// 		"localidad": $scope.localidad,
	// 		"domicilio": $scope.calleDomicilio,
	// 		"piso": $scope.pisoDomicilio,
	// 		"codigoPostal": $scope.codigoPostal,
	// 		"cuitCuil": $scope.cuitCuil,
	// 		"depto": $scope.deptoDomicilio,
	// 		"condicionIva": $scope.condicionIva,
	// 		"idUsuario": $scope.usuarioSesion.id,
	// 		"fechaActual": $scope.fechaActual
	// 	})
	// 	.success(function(response){
	// 		if(response.respuesta == 1){
	// 			$window.location.href='./pedido.php';
	// 		}
	// 		else if(response.respuesta == 2){
	// 			bootbox.alert('No fue posible generar el pedido. Por favor vuelva a intentarlo en unos momentos');
	// 		}
	// 		else if (response.respuesta == 3) 
	// 			bootbox.alert('Se introducieron valores erroneos!');
	// 		else
	// 			bootbox.alert('Ocurrio un error con la conexción. Vuelva a intentarlo en unos momentos.');
	// 	});
	// }
	$scope.mostrarEnvio = function(pedido){
		//este valor esta clavado hasta que se agregue el campo tipo envio ala tabla pedido
		$scope.tipoEnvioId = pedido.envio_domicilio;
		$scope.tipoEnvioNombre = 'Retiro acordado con vendedor';
		if($scope.tipoEnvioId == 1)
			$scope.tipoEnvioNombre = 'Envio a domicilio';
		$scope.tipoEnvioProvincia = pedido.provincia;
		$scope.tipoEnvioLocalidad = pedido.localidad;
		$scope.tipoEnvioDomicilio = pedido.calle;
		$scope.tipoEnvioPiso = pedido.piso;
		$scope.tipoEnvioDepto = pedido.depto;
		$scope.tipoEnvioCodigoPostal = pedido.codigo_postal;

		$('#modalEnvio').modal('show');
	}

	$scope.mostrarProductos = function(pedido){
		//este valor esta clavado hasta que se agregue el campo tipo envio ala tabla pedido
		$scope.detalleProducto = {};
		$scope.detalleProducto.numeroPedido = pedido.id;
		$http.post('../controladores/usuario/buscarCarritoCompraPorIdPedido.php', {
			'idPedido' : pedido.id
		})
		.success(function(response){
			$scope.detalleProducto.productos = response;
			$scope.detalleProducto.sumaTotal = 0;
			angular.forEach($scope.detalleProducto.productos, function(value, key){
				$scope.detalleProducto.sumaTotal += value.precio * value.cantidad * $scope.moneda.valor;
			})
			$('#modalProductos').modal('show');
		})
	}

});