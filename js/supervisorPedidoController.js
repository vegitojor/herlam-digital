app.controller("supervisorPedidoController", function ($scope, $http, $filter) {
    
    $scope.validarModal = false;
    $scope.estadoPedidoGenerarPedidoSupervisor = 2;
    $scope.productosPedidoSupervisor = [];

    $scope.preloader = false;

    $scope.cambiarEstado = function(pedido, estado){
        // let callback
        // bootbox.confirm('Esta por ' + (estado = 3 ? 'cancelar' : 'cambiar a realizado') +' el pedido N ' + pedido.id + '. ¿Desea Continuar?', function(result){
        //     callback = result;
        // });
        // if(callback){
            $http.post('../controladores/cambiarEstadoPedidoSupervisorController.php', {'idPedido': pedido.id, 'estado': estado})
            .success(function(response){
                if (response.respuesta == 1) {
                    bootbox.alert('La cancelación se realizó exitosamente.');
                    $scope.buscarPedidos();
                }
                else if (response.respuesta.respuesta == 2)
                    bootbox.alert('Falló el intento de cancelar el pedido. Por favor vuelva a intentarlo mas tarde.');
                else if (response.respuesta.respuesta == 3)
                    bootbox.alert('Se introducieron valores erroneos!');
                else
                    bootbox.alert('Ocurrio un error con la conexción. Vuelva a intentarlo en unos momentos.');
            });
            
        // }
    }

    $scope.cancelarPedidoSupervisor = function(pedido){
        bootbox.confirm('Esta por cancelar el pedido N ' + pedido.id + '. ¿Desea Continuar?', function(result){
            // callback = result;
            if(result)
                $scope.cambiarEstado(pedido, 3);
        });
    }

    $scope.cambiarARealizado = function(pedido){
        bootbox.confirm('Esta por cambiar a realizado el pedido N ' + pedido.id + '. ¿Desea Continuar?', function(result){
            // callback = result;
            if(result)
                $scope.cambiarEstado(pedido, 2);
        });
    }

    $scope.mostrarProductos = function(pedido){
        $scope.productosPedidoSupervisor = [];
        $scope.pedidoModal = pedido;
        $scope.permitirValidar = true;
        $http.post('../controladores/traerProductosPedidoSupervisor.php', {'idPedido': pedido.id})
        .success(function(response){
            $scope.productos = response;
            $("#verProductos").modal('show');
        })
    }

    $scope.buscarPedidos = function(){
        $http.post('../controladores/listarPedidosSupervisorController.php', {
            'pedido': $scope.buscarPorPedido,
            'desde': $scope.desde, 
            'limite': $scope.limite})
        .success(function(response){
            $scope.pedidos = response;
            $scope.cantidadDePaginacion();
        });
    }

    /**************** PAGINACION ***********************/
    $scope.desde = 0;
    $scope.limite = 10;
    $scope.claseActive = {active: true};

    //SE BUSCA EL TOTAL DE PRODUCTOS PARA CALCULAR LA CANTIDAD DE PAGINAS
    $scope.cantidadDePaginacion = function(){
        $http.post('../controladores/contarCantidadPedidosSupervisorController.php', {
            'pedido': $scope.buscarPorPedido
        })
        .success(function(response){
            $scope.cantidadProductos = response.cantidad;
            resto = $scope.cantidadProductos % $scope.limite;
            $scope.numeroDePaginas = ($scope.cantidadProductos - resto) / $scope.limite;
            if(resto > 0){
                $scope.numeroDePaginas++;
            }
            array = [];
            for(var i = 0; i<$scope.numeroDePaginas; i++){
                array.push((i+1));
            }
            $scope.paginaciones = array;
        });
    } 



    //BUSCA EL RESULTADO DE PRODUCTOS SEGUN LA PAGINA SELECCIONADA
    $scope.buscarSegunPagina = function( desdePaginacion){
        $scope.desde = desdePaginacion*$scope.limite - $scope.limite;
        $scope.buscarPedidos();
    }

    //BUSCA EL RESULTADO DE PRODUCTOS SEGUN LAS FLACHAS PULSADAS (ADELANTE O ATRAS)
    $scope.cambiarPagina = function(direccion){
        if(direccion == 0){
            if($scope.desde > 0)
                $scope.desde = $scope.desde - $scope.limite;
        }else{
            cantidadMaxima = $scope.numeroDePaginas * $scope.limite - $scope.limite;
            if($scope.desde < cantidadMaxima)
                $scope.desde = $scope.desde + $scope.limite;
        }
        $scope.buscarPedidos();
    }
    /****************** FIN PAGINACION */
})