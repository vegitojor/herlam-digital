app.controller('adminCliente', function ($scope, $http, $window) {
    
    var desdeCliente = 0;
    var desdeAdmin = 0;
    var limite = 15;

    $scope.idClienteModal;
    $scope.usuarioClienteModal;
    $scope.emailClienteModal;
    $scope.nombreClienteModal;
    $scope.apellidoClienteModal;
    $scope.domicilioClienteModal;
    $scope.adminClienteModal;
    $scope.fechaNacimientoClienteModal;
    $scope.localidadClienteModal;

    $scope.listarClientes = function () {
        $http.post('../controladores/listarClientesController.php', {'admin': 0, 'desde': desdeCliente, 'limite': limite})
            .success(function (response) {
                $scope.clientes = response;
            })
    }

    $scope.listarAdministradores = function () {
        $http.post('../controladores/listarClientesController.php', {'admin': 1, 'desde': desdeAdmin, 'limite': limite})
            .success(function (response) {
                $scope.administradores = response;
            })
    }

    

    $scope.divDatosClienteModal = false;

    $scope.cerrarDivDatosClienteModal = function(){
        $scope.divDatosClienteModal = false;
    }

    $scope.verDetalleCliente = function($cliente){
        $scope.idClienteModal = $cliente.cliente.id;
        $scope.usuarioClienteModal = $cliente.cliente.usuario;
        $scope.emailClienteModal = $cliente.cliente.email;
        $scope.nombreClienteModal = $cliente.cliente.nombre;
        $scope.apellidoClienteModal = $cliente.cliente.apellido;
        $scope.adminClienteModal = $cliente.cliente.admin;
        $scope.fechaNacimientoClienteModal = $cliente.cliente.fechaNacimiento;
        $scope.domicilioClienteModal = $cliente.cliente.domicilio;
        $scope.localidadClienteModal = $cliente.cliente.localidad;

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
})