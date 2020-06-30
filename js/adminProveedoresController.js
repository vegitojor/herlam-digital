app.controller("formularioProveedor", function ($http, $scope, $window) {
    $scope.provinciasProveedores = function () {

        $http.post('../controladores/cargarProvinciasController.php')
            .success(function (response) {
                $scope.provincias = response;
            })
    }

    $scope.localidadesProveedores = function () {
        $http.post('../controladores/cargarLocalidadesController.php', {idProvincia: $scope.provincia})
            .success(function (response) {
                $scope.localidades = response;
            })
    }
    
    $scope.persistirProveedor = function () {
        $http.post('../controladores/registrarProveedorController.php', {
                    'nombre': $scope.nombre,
                    'telefono': $scope.telefono,
                    'email': $scope.email,
                    'direccion': $scope.direccion,
                    'codigoPostal': $scope.codigoPostal,
                    'localidad': $scope.localidad})
            .success(function (response) {
                $scope.respuesta = response;
                if($scope.respuesta.respuesta == 1){
                    alert("El proveedor se guardo correctamente.");

                    $scope.divCargarProveedor = false;
                }else if ($scope.respuesta.respuesta == 0){
                    alert("El proveedor ya se encuentra registrado.");
                }else {
                    alert("Ocurrio un inconveniente al registrar el proveedor.");
                }
            })
    }

    $scope.listarProveedores = function () {
        $http.post('../controladores/listarProveedoresController.php')
            .success(function (response) {
                $scope.proveedores = response;
            })
    }

    //PARA ABRIR MODAL DE CARGA DE PROVEEDOR
    $scope.divCargarProveedor = false;
    $scope.abrirCargaProveedor = function(){
        $scope.divCargarProveedor = true;
    }

    $scope.cerrarCargaProveedor = function(){
        $scope.divCargarProveedor = false;
    }

})