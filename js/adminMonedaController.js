app.controller('adminMoneda', function ($scope, $http, $window) {
    $scope.guardarMoneda = function () {
        $http.post('../controladores/guardarMonedaController.php',{
            'descripcion': $scope.descripcion,
            'valor': $scope.valor,
            'activo': $scope.activo
        })
            .success(function (response) {
                $scope.respuesta = response;

                if($scope.respuesta.mensaje == 1){
                    alert('La Nueva moneda se guardo correctamente.');
                    $scope.divCargarMoneda = false;
                    $scope.listarMonedas();
                }
                else
                    alert('Ocurrió un inconveniente al intentar guardar la moneda.');
            })
    }

    $scope.listarMonedas = function () {
        $http.post('../controladores/listarMonedasController.php')
            .success(function (response) {
                $scope.monedas = response;
            })
    }

    $scope.obtenerMoneda = function (id) {
        $http.post('../controladores/obtenerUnaMonedaController.php', {
            'idMoneda': id
        }).success(function (response) {
            $scope.respuesta = response;

            $scope.descripcionEditar = $scope.respuesta.descripcion;
            $scope.valorEditar = $scope.respuesta.valor;
            $scope.idMoneda = $scope.respuesta.id;
            $scope.activoEditar = $scope.respuesta.valor;
        })
    }

    $scope.editarMoneda = function () {
        $http.post('../controladores/editarMonedaController.php', {
            'idMoneda': $scope.idMoneda,
            'descripcion': $scope.descripcionEditar,
            'valor': $scope.valorEditar,
            'activo': $scope.activoEditar
        }).success(function (response) {
            $scope.respuestaEditar = response;

            if($scope.respuestaEditar.mensaje == 1){
                alert('La moneda se edito correctamente');
                $window.location.href = '../vistas/cargar-moneda.php';
            }else
                alert('Ocurrio un inconveniente al editar la moneda.');
        })
    }

    $scope.divCargarMoneda = false;

    $scope.abrirCargaMoneda = function(){
        $scope.divCargarMoneda = true;
    }

    $scope.cerrarCargaMoneda = function(){
        $scope.divCargarMoneda = false;
    }

    $scope.activarMoneda = function($id, $activo){
        $http.post('../controladores/cambiarActivoMonedaController.php', {'idMoneda': $id, 'activo': $activo})
        .success(function(response){
         if (response.respuesta == 1) {
             $scope.listarMonedas();
         }
         else if (response.respuesta.respuesta == 2)
             alert('Falló el intento de modificar la moneda. Por favor vuelva a intentarlo mas tarde.');
         else if (response.respuesta.respuesta == 3)
             alert('Se introducieron valores erroneos!');
         else
             alert('Ocurrio un error con la conexción. Vuelva a intentarlo en unos momentos.');
        });
    }
})