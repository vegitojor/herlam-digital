app.controller("editarProveedor", function ($scope, $http, $window) {
    $scope.obtenerProveedor = function ($id) {
        $http.post('../controladores/obtenerUnProveedorController.php', {id: $id})
            .success(function (response) {
                $scope.proveedorObtenido = response;
                /*
                $scope.id = $scope.proveedorObtenido.id;
                $scope.nombre = $scope.proveedorObtenido.nombre;
                $scope.telefono = $scope.proveedorObtenido.telefono;
                $scope.email = $scope.proveedorObtenido.email;
                $scope.direccion = $scope.proveedorObtenido.direccion;
                $scope.codigoPostal = $scope.proveedorObtenido.codigoPostal;
                $scope.idLocalidad = $scope.proveedorObtenido.idLocalidad;
                $scope.localidadProveedor = $scope.proveedorObtenido.localidad;
                $scope.provincia = $scope.proveedorObtenido.idProvincia;
                */
            })
    }

    $scope.editarProveedor = function () {
        $http.post('../controladores/editarProveedorController.php', {
            'id': $scope.id,
            'nombre': $scope.nombre,
            'telefono': $scope.telefono,
            'email': $scope.email,
            'direccion': $scope.direccion,
            'codigoPostal': $scope.codigoPostal,
            'localidad': $scope.idLocalidad
        }).success(function (response) {
            $scope.respuesta = response;

            if($scope.respuesta.mensaje == 1){
                alert("El proveedor se editó correctamente.");

            }else{
                alert("Ocurrió un inconveniente al editar el proveedor.");
            }
        })

    }


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

})