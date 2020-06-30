app.controller("formularioFichaTecnica", function ($scope, $http, $window) {

    $scope.campo02 = "0";
    $scope.campo03 = "0";
    $scope.campo04 = "0";
    $scope.campo05 = "0";
    $scope.campo06 = "0";
    $scope.campo07 = "0";
    $scope.campo08 = "0";
    $scope.campo09 = "0";
    $scope.campo10 = "0";
    $scope.campo11 = "0";
    $scope.campo12 = "0";
    $scope.campo13 = "0";
    $scope.campo14 = "0";
    $scope.campo15 = "0";
    $scope.campo16 = "0";
    $scope.campo17 = "0";
    $scope.campo18 = "0";
    $scope.campo19 = "0";
    $scope.campo20 = "0";

    $scope.guardarFichaTecnica = function () {
        $http.post("../controladores/guardarFichaTecnicaController.php", {
            'nombreFicha': $scope.nombreFicha,
            'campo01': $scope.campo01,
            'campo02': $scope.campo02,
            'campo03': $scope.campo03,
            'campo04': $scope.campo04,
            'campo05': $scope.campo05,
            'campo06': $scope.campo06,
            'campo07': $scope.campo07,
            'campo08': $scope.campo08,
            'campo09': $scope.campo09,
            'campo10': $scope.campo10,
            'campo11': $scope.campo11,
            'campo12': $scope.campo12,
            'campo13': $scope.campo13,
            'campo14': $scope.campo14,
            'campo15': $scope.campo15,
            'campo16': $scope.campo16,
            'campo17': $scope.campo17,
            'campo18': $scope.campo18,
            'campo19': $scope.campo19,
            'campo20': $scope.campo20,
        }).success(function (response) {
            $scope.respuesta = response;

            if($scope.respuesta.mensaje == 2){
                alert("La ficha se guardo correctamente. Puede continuar cargando más fichas o volver al menú de categorias.");

            }else if ($scope.respuesta.mensaje == 1){
                alert("El nombre introducido ya existe.");
            }else {
                alert("Ocurrio un error con la carga de la ficha.");
            }

        })
    }
})