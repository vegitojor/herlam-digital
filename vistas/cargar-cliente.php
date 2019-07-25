<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 28/09/17
 * Time: 20:55
 */

include_once ('../incluciones/verificacionAdmin.php');
?>

<!DOCTYPE html>
<html>
<head>
    <?php include_once ('../incluciones/headAdmin.php'); ?>
    <script type="text/javascript" src="../js/adminModule.js"></script>
    <!-- Controlador angular -->
    <script type="text/javascript" src="../js/adminClienteController.js"></script>
    <title>Clientes</title>
</head>

<body ng-app="admin" class="w3-light-gray" ng-controller="adminCliente">
    <div class="w3-row">
        <?php include_once('../incluciones/navegadorAdmin.php');  ?>
    </div>
    <div class="w3-row">
        <div class=" w3-padding-32 w3-blue-gray">

            <h1 class="w3-jumbo w3-margin-left">Administrar Clientes</h1>
            
        </div>
    </div>
    <!-- CONTENIDO DE LA PAGINA -->
    <div class="w3-row" ng-show="divDatosClienteModal">
        <br>
        <div class="w3-content">
            <a href="" class="w3-btn w3-gray w3-right" ng-click="cerrarDivDatosClienteModal()"><span class="fa fa-close "></span></a>
            <h2>Datos del usuario</h2>
            <table class="w3-table-all">
                <tr>
                    <th>Id</th>
                    <td>{{idClienteModal}}</td>
                    <th>Usuario</th>
                    <td>{{usuarioClienteModal}}</td>
                    <th>Email</th>
                    <td>{{emailClienteModal}}</td>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <td>{{nombreClienteModal}}</td>
                    <th>Apellido</th>
                    <td>{{apellidoClienteModal}}</td>
                    <th>Rol</th>
                    <td ng-show="adminClienteModal == 1">Administrador</td>
                    <td ng-show="adminClienteModal == 0">Cliente</td>
                </tr>
                <tr>
                    <th>Fecha de nacimiento</th>
                    <td>{{fechaNacimientoClienteModal}}</td>
                    <th>Domicilio</th>
                    <td>{{domicilioClienteModal}}</td>
                    <th>Localidad</th>
                    <td>{{localidadClienteModal}}</td>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <!-- SE LISTAN LOS CLIENTES-->
    <div class="w3-row-padding">
        <div class="w3-col l6">
            <div class="w3-content w3-white">
                <div class="w3-card-4 " ng-init="listarClientes()">
                    <header class="w3-container w3-orange">
                        <h2>Clientes</h2>
                    </header>
                    <div ng-show="clientes">
                        <!-- TABLA QUE LISTA LOS CLIENTES -->
                        <table class="w3-table w3-striped w3-bordered w3-hoverable">
                            <thead>
                                <tr class="w3-green">
                                    <th>Id</th>
                                    <th>Usuario</th>
                                    
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="cliente in clientes">
                                    <td>{{cliente.id}}</td>
                                    <td>{{cliente.usuario}}</td>
                                    
                                    <td>{{cliente.nombre}}</td>
                                    <td>{{cliente.apellido}}</td>
                                    <td>
                                        <a href="" ng-click="verDetalleCliente({cliente})" class="w3-btn w3-blue">Ver detalles</a>
                                        <a href="" ng-click="activarAdmin(cliente.id, 1)" class="w3-btn w3-red">Dar permiso Admin</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- SE LISTAN LOS ADMINISTRADORES-->
        <div class="w3-col l6">
            <div class="w3-content w3-white">
                <div class="w3-card-4 " ng-init="listarAdministradores()">
                    <header class="w3-container w3-orange">
                        <h2>Administradores</h2>
                    </header>
                    <div ng-show="administradores.length > 0">
                        <!-- TABLA QUE LISTA LOS ADMINISTRADORES -->
                        <table class="w3-table w3-striped w3-bordered w3-hoverable">
                            <thead>
                                <tr class="w3-green">
                                    <th>Id</th>
                                    <th>Usuario</th>
                                    
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="cliente in administradores">
                                    <td>{{cliente.id}}</td>
                                    <td>{{cliente.usuario}}</td>
                                    
                                    <td>{{cliente.nombre}}</td>
                                    <td>{{cliente.apellido}}</td>
                                    <td>
                                        <a href="" ng-click="verDetalleCliente({cliente})" class="w3-btn w3-blue">Ver detalles</a>
                                        <a href="" ng-click="activarAdmin(cliente.id, 0)" class="w3-btn w3-red">Quitar permiso Admin</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
