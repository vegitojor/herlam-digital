app.controller("adminMarca", function ($scope, $http, $window) {
    $scope.guardarMarca = function () {
        $http.post('../controladores/guardarMarcaController.php', {'descripcion': $scope.descripcion})
            .success(function (response) {
                $scope.respuesta = response;

                if($scope.respuesta.mensaje == 1)
                    alert('La nueva marca se guardo correctamente.');
                else
                    alert('Ocurrió un error al momento de guardar la marca.');

                $scope.descripcion = "";
                $scope.cerrarCargaMarca();
                $scope.listarMarcas();
            })
    }

    $scope.listarMarcas = function () {
        $http.post('../controladores/listarMarcasController.php')
            .success(function (response) {
                $scope.marcas = response;
            })
    }

    $scope.traerMarca = function ($id) {
        $http.post('../controladores/buscarMarcaController.php', {'id': $id})
            .success(function (response) {
                $scope.marca = response;

                $scope.descripcionEditar = $scope.marca.descripcion;
                $scope.idEditar = $scope.marca.id;
            })
    }

    $scope.editarMarca = function () {
        $http.post('../controladores/editarMarcaController.php', {'id': $scope.idEditar, 'descripcion': $scope.descripcionEditar})
            .success(function (response) {
                $scope.respuesta = response;

                if ($scope.respuesta.mensaje == 1){
                    alert('La marca se editó correctamente.');
                    $window.location.href = "../vistas/cargar-marca.php";
                }else
                    alert('Ocurrió un inconveniente al editar la marca.');
            })
    }

    //MODAL PARA CARGA DE NUEVA MARCA
    $scope.divCargaMarca = false;
    $scope.abrirCargaMarca = function(){
        $scope.divCargaMarca = true;
    }

    $scope.cerrarCargaMarca = function(){
        $scope.divCargaMarca = false;
    }

});