app.controller("adminCategoriaController", function ($scope, $http) {
    

    $scope.cargarFichasTecnicas = function () {
        $http.post("../controladores/cargarFichasTecnicasController.php")
            .success(function (response) {
                $scope.fichas = response;
        })
    }

    $scope.guardarCategoria = function () {
        $http.post('../controladores/guardarCategoriaController.php', {'descripcion': $scope.descripcion,
            'fichaTecnica': $scope.fichaTecnica})
            .success(function (response) {
                $scope.respuesta = response;

                if($scope.respuesta.mensaje == 1)
                    alert('La categoria se guardo correctamente.');
                else
                    alert('Ocurrio un error al guardar la categoria.');

                $scope.cerrarCargaCategoria();
                $scope.descripcion = "";
                $scope.fichaTecnica = "";
                $scope.listarCategorias();
            });
    }

    // CUADRO DE CARGA DE CATEGORIA
    $scope.divFormularioCategoria = false;

    $scope.abrirCargaCategoria = function(){
        $scope.divFormularioCategoria = true;
    }

    $scope.cerrarCargaCategoria = function(){
        $scope.divFormularioCategoria = false;
    }

    //SE BUSCAN LAS CATEGORIAS PARA LISTARLAS EN LA TABLA
    $scope.listarCategorias = function(){
        $http.post('../controladores/listarCategoriasController.php')
        .success(function(response){
            $scope.categorias = response;
        });
    }

    //FUNCION PARA EDITAR
    $scope.divEditarCategoria = false;
    $scope.editarCategoria = function(categoria){
        $scope.idCategoriaAEditar = categoria.id;
        $scope.NombreAEditar = categoria.descripcion;

        $scope.divEditarCategoria = true;
    }

    $scope.cerrarEditarCategoria = function(){
        $scope.divEditarCategoria = false;
    }

    $scope.guardarEditarCategoria = function(){
        $http.post('../controladores/editarCategoriaController.php', {'nombreAEditar': $scope.NombreAEditar, 'categoria': $scope.idCategoriaAEditar})
        .success(function(response){
            if (response.respuesta == 1) {
                alert('La categoria se editó exitosamente.');

                $scope.listarCategorias();

                $scope.divEditarCategoria = false;
            }
            else if (response.respuesta == 2)
                alert('Falló el intento de editar la categoria. Por favor vuelva a intentarlo mas tarde.');
            else if (response.respuesta == 3)
                alert('Se introducieron valores erroneos!');
            else
                alert('Ocurrio un error con la conexción. Vuelva a intentarlo en unos momentos.');
        });
    }
})