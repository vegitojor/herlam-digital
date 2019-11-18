app.controller('adminCliente', function ($scope, $http, $window) {
    
    // var desdeCliente = 0;
    // var desdeAdmin = 0;
    // var limite = 15;

    $scope.idClienteModal;
    $scope.usuarioClienteModal;
    $scope.emailClienteModal;
    $scope.nombreClienteModal;
    $scope.apellidoClienteModal;
    $scope.domicilioClienteModal;
    $scope.adminClienteModal;
    $scope.fechaNacimientoClienteModal;
    $scope.localidadClienteModal;

    $scope.mostrarCliente = true;
    $scope.mostrarAdministrador = false;
    $scope.mostrarSupervisor = false;

    $scope.mostrarFiltro = false;

    $scope.listarClientes = function () {
        $http.post('../controladores/listarClientesController.php', {
            'admin': 0, 
            'supervisor': 0, 
            'desde': $scope.desdeCliente, 
            'limite': $scope.limite,
            'nombre': $scope.nombreFiltro,
            'apellido': $scope.apellidoFiltro,
            'cuil': $scope.cuilFiltro,
            'razonSocial': $scope.razonSocialFiltro
        })
            .success(function (response) {
                $scope.clientes = response;
            })
    }

    $scope.listarAdministradores = function () {
        $http.post('../controladores/listarClientesController.php', {'admin': 1, 'supervisor': 0, 'desde': $scope.desdeAdmin, 'limite': $scope.limite})
            .success(function (response) {
                $scope.administradores = response;
            })
    }

    $scope.listarSupervisores = function () {
        $http.post('../controladores/listarClientesController.php', {'admin': 0, 'supervisor': 1, 'desde': $scope.desdeSupervisor, 'limite': $scope.limite})
            .success(function (response) {
                $scope.supervisores = response;
            })
    }

    $scope.divDatosClienteModal = false;

    $scope.cerrarDivDatosClienteModal = function(){
        $scope.divDatosClienteModal = false;
    }

    $scope.verDetalleCliente = function(cliente){
        $scope.clienteModal = cliente;
        $scope.divDatosClienteModal = true;
    }

    $scope.activarAdmin = function($id, $permiso){
        var option;
        if($permiso == 1)
            opcion = confirm('Esta a punto de conceder permisos de administrador a un cliente. ¿Desea continuar?');
        else
            opcion = confirm('Esta a punto de quitar permisos de administrador a un administrador. ¿Desea continuar?');
        if(opcion){
            $http.post('../controladores/darPermisoDeAdminController.php', {'usuario': $id, 'permiso': $permiso})
            .success(function(response){
                if (response.respuesta == 1) {
                    alert('El cambio se realizó exitosamente.');
                    $scope.listarClientes();
                    $scope.listarAdministradores();
                }
                else if (response.respuesta.respuesta == 2)
                    alert('Falló el intento de conceder permisos de administrador. Por favor vuelva a intentarlo mas tarde.');
                else if (response.respuesta.respuesta == 3)
                    alert('Se introducieron valores erroneos!');
                else
                    alert('Ocurrio un error con la conexción. Vuelva a intentarlo en unos momentos.');
            });
        }
    }

    $scope.activarSupervisor = function($id, $permiso){
        var option;
        if($permiso == 1)
            opcion = confirm('Esta a punto de conceder permisos de supervisor a un cliente. ¿Desea continuar?');
        else
            opcion = confirm('Esta a punto de quitar permisos de supervisor a un supervisor. ¿Desea continuar?');
        if(opcion){
            $http.post('../controladores/darPermisoDeSupervisorController.php', {'usuario': $id, 'permiso': $permiso})
            .success(function(response){
                if (response.respuesta == 1) {
                    alert('El cambio se realizó exitosamente.');
                    $scope.listarClientes();
                    $scope.listarSupervisores();
                }
                else if (response.respuesta.respuesta == 2)
                    alert('Falló el intento de conceder permisos de administrador. Por favor vuelva a intentarlo mas tarde.');
                else if (response.respuesta.respuesta == 3)
                    alert('Se introducieron valores erroneos!');
                else
                    alert('Ocurrio un error con la conexción. Vuelva a intentarlo en unos momentos.');
            });
        }
    }

    $scope.eliminarCliente = function(cliente){
        var option;

        let idAEliminar = prompt("Por favor introduzca el id del usuario a eliminar");
        if(idAEliminar == cliente.id){
            option = confirm("Esta accion eliminará definitivamente al usuario y todo su historial de pedidos. ¿Desea continuar?");
            if(option){
                $http.post('../controladores/eliminarClienteController.php', {'usuario': cliente.id})
                .success(function(response){
                    if (response.respuesta == 1) {
                        alert('La eliminación se realizó exitosamente.');
                        $scope.listarClientes();
                        // $scope.listarAdministradores();
                    }
                    else if (response.respuesta.respuesta == 2)
                        alert('Falló el intento de eliminar el usuario. Por favor vuelva a intentarlo mas tarde.');
                    else if (response.respuesta.respuesta == 3)
                        alert('Se introducieron valores erroneos!');
                    else
                        alert('Ocurrio un error con la conexción. Vuelva a intentarlo en unos momentos.');
                });
                }
        }else{
            alert("El id ingresado no coincide con el del usuario que intento eliminar.");
        }

        
    }

    $scope.activarCliente = function(cliente){
        let permiso = 1;
        if(cliente.activo)
            permiso = 0;
        var option = true;
        if(cliente.activo)
            option = confirm("Esta accion desactivará al usuario " + cliente.nombre + " " + cliente.apellido +". ¿Desea continuar?");
        if(option){
            $http.post('../controladores/activarClienteController.php', {'usuario': cliente.id, 'permiso': permiso })
            .success(function(response){
                if (response.respuesta == 1) {
                    
                    alert('El cambio se realizó exitosamente.');
                    $scope.listarClientes();
                    // $scope.listarAdministradores();
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

    $scope.mostrarUsuario = function(tipo){
        switch(tipo){
            case 1:
                $scope.mostrarCliente = true;
                $scope.mostrarAdministrador = false;
                $scope.mostrarSupervisor = false;
                break;
            case 2:
                $scope.mostrarCliente = false;
                $scope.mostrarAdministrador = false;
                $scope.mostrarSupervisor = true;
                break;
            case 3:
                $scope.mostrarCliente = false;
                $scope.mostrarAdministrador = true;
                $scope.mostrarSupervisor = false;
                break;
        }
    }

    $scope.mostraFiltrosBusqueda = function(){
        $scope.mostrarFiltro = !$scope.mostrarFiltro;
    }

    /**************** PAGINACION ***********************/
    $scope.desdeCliente = 0;
    $scope.desdeAdmin = 0;
    $scope.desdeSupervisor = 0;
    $scope.limite = 8;
    $scope.claseActive = {'w3-green': true};
    $scope.amplitud = 5;

    //SE BUSCA EL TOTAL DE PRODUCTOS PARA CALCULAR LA CANTIDAD DE PAGINAS
    $scope.cantidadDePaginacion = function(){
        $http.post('../controladores/contarCantidadClientesConsumidorAdminController.php', {
            'nombre': $scope.nombreFiltro,
            'apellido': $scope.apellidoFiltro,
            'cuil': $scope.cuilFiltro,
            'razonsocial': $scope.razonSocialFiltro
        })
        .success(function(response){
            $scope.cantidadProductos = response.cantidad;
            resto = $scope.cantidadProductos % $scope.limite;
            $scope.numeroDePaginas = ($scope.cantidadProductos - resto) / $scope.limite;
            if(resto > 0){
                $scope.numeroDePaginas++;
            }
            let array = [];
            for(var i = 0; i<$scope.numeroDePaginas; i++){
                // array.push((i+1));
                if(i == 0)
                    array.push((i+1));
                else{
                    if( (i*$scope.limite >= $scope.desdeCliente - $scope.amplitud * $scope.limite) 
                    && (i*$scope.limite < $scope.desdeCliente + $scope.amplitud * $scope.limite))
                        array.push((i+1));
                    else{
                        if(i+1==$scope.numeroDePaginas){
                            if((array[array.length - 1] != "..."))
                                array.push("...");
                            array.push((i+1));
                        }else{
                            if((array[array.length - 1] != "..."))
                                array.push("...");
                                // array.push((i+1));
                        }
                    }
                }
                
            }
            $scope.paginaciones = array;
        });
    }
    
    //SE BUSCA EL TOTAL DE PRODUCTOS PARA CALCULAR LA CANTIDAD DE PAGINAS Para los administradores
    $scope.cantidadDePaginacionAdmin = function(){
        $http.post('../controladores/contarCantidadClientesAdministradorAdminController.php')
        .success(function(response){
            $scope.cantidadClienteAdmin = response.cantidad;
            resto = $scope.cantidadClienteAdmin % $scope.limite;
            $scope.numeroDePaginasAdmin = ($scope.cantidadClienteAdmin - resto) / $scope.limite;
            if(resto > 0){
                $scope.numeroDePaginasAdmin++;
            }
            let arrayAdmin = [];
            for(var i = 0; i<$scope.numeroDePaginasAdmin; i++){
                // array.push((i+1));
                if(i == 0)
                arrayAdmin.push((i+1));
                else{
                    if( (i*$scope.limite >= $scope.desdeAdmin - $scope.amplitud * $scope.limite) 
                    && (i*$scope.limite < $scope.desdeAdmin + $scope.amplitud * $scope.limite))
                        arrayAdmin.push((i+1));
                    else{
                        if(i+1==$scope.numeroDePaginas){
                            if((arrayAdmin[arrayAdmin.length - 1] != "..."))
                                arrayAdmin.push("...");
                                arrayAdmin.push((i+1));
                        }else{
                            if((arrayAdmin[arrayAdmin.length - 1] != "..."))
                                arrayAdmin.push("...");
                                // array.push((i+1));
                        }
                    }
                }
                
            }
            $scope.paginacionesAdmin = arrayAdmin;
        });
    }
     



    //BUSCA EL RESULTADO DE PRODUCTOS SEGUN LA PAGINA SELECCIONADA
    $scope.buscarSegunPagina = function( desdePaginacion){
        if(desdePaginacion != "..."){
            $scope.desdeCliente = desdePaginacion*$scope.limite - $scope.limite;
            $scope.cantidadDePaginacion();
            $scope.listarClientes();
        }
    }

    //BUSCA EL RESULTADO DE PRODUCTOS SEGUN LA PAGINA SELECCIONADA Para los administradores
    $scope.buscarSegunPaginaAdmin = function( desdePaginacion){
        if(desdePaginacion != "..."){
            $scope.desdeAdmin = desdePaginacion*$scope.limite - $scope.limite;
            $scope.cantidadDePaginacionAdmin();
            $scope.listarAdministradores();
        }
    } 

    //BUSCA EL RESULTADO DE PRODUCTOS SEGUN LAS FLACHAS PULSADAS (ADELANTE O ATRAS)
    $scope.cambiarPagina = function(direccion, categoria){
        if(direccion == 0){
            if($scope.desdeCliente > 0)
                $scope.desdeCliente = $scope.desdeCliente - $scope.limite;
        }else{
            cantidadMaxima = $scope.numeroDePaginas * $scope.limite - $scope.limite;
            if($scope.desdeCliente < cantidadMaxima)
                $scope.desdeCliente = $scope.desdeCliente + $scope.limite;
        }
        // $scope.buscarPedidos();
        $scope.cantidadDePaginacion();
        $scope.listarClientes();
    }

    //BUSCA EL RESULTADO DE PRODUCTOS SEGUN LAS FLACHAS PULSADAS (ADELANTE O ATRAS)
    $scope.cambiarPaginaAdmin = function(direccion, categoria){
        if(direccion == 0){
            if($scope.desdeAdmin > 0)
                $scope.desdeAdmin = $scope.desdeAdmin - $scope.limite;
        }else{
            cantidadMaximaAdmin = $scope.numeroDePaginasAdmin * $scope.limite - $scope.limite;
            if($scope.desdeAdmin < cantidadMaximaAdmin)
                $scope.desdeAdmin = $scope.desdeAdmin + $scope.limite;
        }
        // $scope.buscarPedidos();
        $scope.cantidadDePaginacionAdmin();
        $scope.listarAdministradores();
    }
    /****************** FIN PAGINACION */

})