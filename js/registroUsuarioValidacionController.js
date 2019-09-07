app.controller("formularioRegistro", function($scope, $http, $window, $filter){
	$scope.preloader = true;
	$scope.condicionIva = "";
	$scope.condicionesIva = [
		{"id":1, "name":"Consumidor final"},
		{"id":2, "name":"Monotributista"},
		{"id":3, "name":"Exento"},
		{"id":4, "name":"Responsable inscripto"},
		{"id":'', "name":"Seleccione su condicion de IVA"},
	];


//		*****este metodo quedo obsoleto al empezar a utilizar EnvioPack
	$scope.cargarProvincias = function(){
		$http.get("../controladores/cargarProvinciasController.php")
			.success(function(data){
				$scope.provincias =  data;
				$scope.preloader = false;
			})
	}

	// $scope.cargarProvincias = function(){
	// 	$http.get("../controladores/cargarProvinciaEnvioPackController.php", {'idProvincia': null})
	// 		.success(function(data){
	// 			$scope.preloader = false;
	// 			$scope.provincias =  data;
	// 		})
	// }

//		*****este metodo quedo obsoleto al empezar a utilizar EnvioPack
	$scope.cargarLocalidades = function(){
		$http.post("../controladores/cargarLocalidadesController.php", {'idProvincia': $scope.provincia})
			.success(function(data){
				$scope.preloader = false;
				$scope.localidades = data;
			})
	}

	// $scope.cargarLocalidades = function(){
	// 	$scope.preloader = true;
	// 	$http.post("../controladores/cargarProvinciaEnvioPackController.php", {'idProvincia': $scope.provincia})
	// 		.success(function(data){
	// 			$scope.localidades = data;
	// 			$scope.preloader = false;
	// 		})
	// }
	
	$scope.listarCategorias = function () {

       $http.post('../controladores/usuario/listarCategoriasController.php')
           .success(function (response) {
               $scope.categorias = response;
           })
    }
	
	$scope.submitFormulario = function(isValid){
		//item.dateAsString = $filter('date')(item.date, "yyyy-MM-dd");
		$scope.fechaNacimiento = $filter('date')($scope.fechaNacimiento, "yyyy-MM-dd");
		if (isValid){	
			$http.post("../controladores/registrarUsuarioController.php", 
					{ 
					'nombre': $scope.nombre,
					'apellido': $scope.apellido,
					'telefono': $scope.telefono,
					'fechaNacimiento': $scope.fechaNacimiento,
					'email': $scope.email,
					'direccion': $scope.direccion,
					'codPostal': $scope.codPostal,
					'provincia': $scope.provincia,
					'localidad': $scope.localidad,
					'usuario': $scope.nombreUsuario,
					'cuitCuil': $scope.cuil,
					'condicionIva': $scope.condicionIva,
					'piso': $scope.piso,
					'depto': $scope.depto,
					'pass': $scope.passValid})
				.success(function(response){
					$scope.data = response;

					if($scope.data.respuesta == 1){
						$window.location.href = "../home.php";
					}else if ($scope.data.respuesta == 0){
						alert("El email ingresado ya esta en uso. Por favor ingrese un email diferente.");
					}else {
						alert("Error en la conexion a la base de datos.");
					}
				})
		}else{
			bootbox.alert("El formulario no es valido.")
			// alert("El formulario no es valido.");
		}
	}
});