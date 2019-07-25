app.controller("formularioLogin", function($scope, $http, $window){
	$scope.iniciarSesion = function(){
		//se realiza lamado ajax al controlador de login
		$http.post('../controladores/loginController.php',
					{'email': $scope.emailLogin,
					'pass': $scope.passLogin})
		.success(function(data){
			$scope.data = data;
			//se redirige al home si el mail se encuentra en la BD o se envia mensaje de alerta en caso contrario
			if($scope.data.respuesta == 1){
				if($scope.data.admin == 1){
					$window.location.href = "../vistas/admin-home.php";
				}else {
					$window.location.href = "../index.php";	
				}
				
			}else if($scope.data.respuesta == 0){
				alert("El email o la contraseña son incorrectos.");
			}else{
				alert("Ha ocurrido un error con la conexion a la base de datos. Por favor vuelva a intenter iniciar sesión.");
			}
		})
	}
});