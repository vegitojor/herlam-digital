app.controller("nosotrosController", function ($scope, $http, $sce, $filter) {


	$scope.listarCategorias = function () {
       $http.post('../controladores/usuario/listarCategoriasController.php')
           .success(function (response) {
               $scope.categorias = response;
           })
   }

});