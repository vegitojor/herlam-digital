app.controller("adminIndexController", function ($scope, $http, $filter) {
    
    $scope.validarModal = false;
    $scope.estadoPedidoGenerarPedidoSupervisor = 2;
    $scope.productosPedidoSupervisor = [];


    //SE BUSCAN LAS CATEGORIAS PARA LISTARLAS EN LA TABLA
    $scope.listarPedidos = function(){
        $http.post('../controladores/listarPedidosController.php', {'desde': $scope.desde, 'limite': $scope.limite})
        .success(function(response){
            $scope.pedidos = response;
        });
    }


    $scope.cancelarPedido = function(pedido){
        if(confirm('Esta por eliminar definitivamente el pedido N ' + pedido.id + '. ¿Desea Continuar?')){
            $http.post('../controladores/cancelarPedidoController.php', {'idPedido': pedido.id})
            .success(function(response){
                if (response.respuesta == 1) {
                    alert('La eliminación se realizó exitosamente.');
                    // $scope.listarPedidos();
                    // $scope.listarAdministradores();
                    $scope.buscarPedidosFiltro();
                }
                else if (response.respuesta.respuesta == 2)
                    alert('Falló el intento de eliminar el usuario. Por favor vuelva a intentarlo mas tarde.');
                else if (response.respuesta.respuesta == 3)
                    alert('Se introducieron valores erroneos!');
                else
                    alert('Ocurrio un error con la conexción. Vuelva a intentarlo en unos momentos.');
            });
            
        }
    }

    $scope.mostrarProductos = function(pedido){
        // $scope.validarModal = true;
        // if(pedido.id_estado_pedido == 1){
            $scope.productosPedidoSupervisor = [];
            $scope.pedidoModal = pedido;
            $scope.permitirValidar = true;
            $http.post('../controladores/traerProductosPedido.php', {'idPedido': pedido.id})
            .success(function(response){
                $scope.productos = response;
                angular.forEach($scope.productos, function(item, index){
                    if(item.disponible == 0 )
                        $scope.permitirValidar = false;
                })
                document.getElementById('validarModal').style.display='block';
            })
            // document.getElementById('validarModal').style.display='block';
        // } else{
        //     $scope.validarPedido(pedido);
        // }
    }

    $scope.cerrarModal = function(pedido){
        // $scope.validarModal = false;
        document.getElementById('validarModal').style.display='none';
    }

    $scope.quitarProductoPedido = function(id){
        $http.post('../controladores/quitarProductoPedido.php', {'idCarrito': id})
        .success(function(response){
            // $scope.productos = response;
            if(response.respuesta == 1){
                $http.post('../controladores/traerProductosPedido.php', {'idPedido': $scope.pedidoModal.id})
                .success(function(response){
                    $scope.productos = response;
                    angular.forEach($scope.productos, function(item, index){
                        if(item.disponible == 0 )
                            $scope.permitirValidar = false;
                    })
                    // document.getElementById('validarModal').style.display='block';
                });
            }else{
                alert('Ocurrió un problema al querer eliminar el producto del pedido. Por favor intentelo nuevamente en unos minutos.'); 
            }
        })
    }

    $scope.cargarEstadosPedido = function(){
        $http.post('../controladores/cargarEstadosPedido.php')
        .success(function(response){
            $scope.estados = response;
        });
    }

    $scope.buscarPedidosFiltro = function(){
        $scope.desde = 0;
        $scope.buscarPedidos();

    }

    $scope.buscarPedidos = function(){
        $http.post('../controladores/listarPedidosController.php', {
            'estado': $scope.estadoFiltro, 
            'cliente': $scope.buscarPorCliente, 
            'pedido': $scope.buscarPorPedido,
            'desde': $scope.desde, 
            'limite': $scope.limite})
        .success(function(response){
            $scope.pedidos = response;
            $scope.cantidadDePaginacion();
        });
    }

    $scope.limpiarFiltros = function(){
        $scope.estadoFiltro = undefined;
        $scope.buscarPorCliente = undefined;
        $scope.buscarPorPedido = undefined;
    }

    $scope.validarPedido = function(pedido){
        if((!$scope.permitirValidar || $scope.productos.length == 0)){
            alert('Este pedido no puede ser validado.');
        }else{
            $http.post('../controladores/validarPedidoController.php',{'idPedido': pedido.id, 'idEstadoPedido': pedido.id_estado_pedido})
            .success(function(response){
                if(response.respuesta == 1)
                    alert('El estado del pedido se modifico correctamente.');
                    $scope.buscarPedidosFiltro();
                    document.getElementById('validarModal').style.display='none';
            })
        }
    }

    $scope.generarExel = function(pedido){
        window.open('./generarExel.php?p=' + pedido.id);
    }

    $scope.prueba = function(){
        alert('hola');
    }

    $scope.agregarArrayPedidoSupervisor = function(action, producto){
        let indice = $scope.productos.indexOf(producto);
        //ESTABLECEMOS EN EL PRODUCTO ELEGIDO NULL EL ID PEDIDO SUOERVISOR
        //SI LA ACTION ES AGREGARLO, ENTON RECIEN SE ESTABLECE EN UN VALOR DISTINTO DE NULL
        $scope.productos[indice].id_pedido_supervisor = null;
        if(action == 1){
            $scope.productos[indice].id_pedido_supervisor = action;
            //SE AGREGA EL PRODUCTO AL ARRAY DE PRODUCTOS QUE SE ENVIARA AL BACK PARA ESTABLECER EL PEDIDO SUERVISOR
            $scope.productosPedidoSupervisor.push(producto)
        }else{
            let index = $scope.productosPedidoSupervisor.indexOf(producto);
            if( index > -1 ){
                $scope.productosPedidoSupervisor.splice(index, 1);
            }
        }

    }

    $scope.generarPedidoSupervisor = function(){
        let index = $scope.pedidos.indexOf($scope.pedidoModal);
        $scope.pedidos[index].id_pedido_supervisor = true;
        $scope.pedidoModal.id_pedido_supervisor = true;
        $scope.fecha = new Date();
        $scope.fecha = $filter('date')($scope.fecha, 'yyyy-MM-dd HH:mm:ss');
        $http.post("../controladores/generarPedidoSupervisorController.php", {'pedido': $scope.pedidoModal.id, 'productos': $scope.productosPedidoSupervisor, 'fecha': $scope.fecha})
        .success(function(response){
            if(response,respuesta == 1){

            }
        })
    }

    /**************** PAGINACION ***********************/
    $scope.desde = 0;
    $scope.limite = 10;
    $scope.claseActive = {'w3-green': true};

    //SE BUSCA EL TOTAL DE PRODUCTOS PARA CALCULAR LA CANTIDAD DE PAGINAS
    $scope.cantidadDePaginacion = function(){
        $http.post('../controladores/contarCantidadPedidosAdminController.php', {'estado': $scope.estadoFiltro, 'cliente': $scope.buscarPorCliente, 'pedido': $scope.buscarPorPedido})
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
    $scope.cambiarPagina = function(direccion, categoria){
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