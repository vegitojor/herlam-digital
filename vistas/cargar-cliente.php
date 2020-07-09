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
    <script type="text/javascript" src="../js/adminClienteController.js?<?= $versionJs ?>"></script>
    <title>Clientes</title>
</head>

<body ng-app="admin" class="w3-light-gray" ng-controller="adminCliente">
    <div class="w3-row">
        <?php include_once('../incluciones/navegadorAdmin.php');  ?>
    </div>
    <div class="w3-row">
        <div class=" w3-padding-16 w3-blue-gray">
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
                    <td>{{clienteModal.id}}</td>
                    <th>Usuario</th>
                    <td>{{clienteModal.usuario}}</td>
                    <th>Email</th>
                    <td>{{clienteModal.email}}</td>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <td>{{clienteModal.nombre}}</td>
                    <th>Apellido</th>
                    <td>{{clienteModal.apellido}}</td>
                    <th>Rol</th>
                    <td >{{clienteModal.admin == 1 ? 'Administrador' : 'Cliente'}}</td>
                    <!-- <td ng-show="adminClienteModal == 0">Cliente</td> -->
                </tr>
                <tr>
                    <th>Fecha de nacimiento</th>
                    <td>{{clienteModal.fechanacimiento}}</td>
                    <th>Domicilio</th>
                    <td>{{clienteModal.domicilio}}</td>
                    <th>Localidad</th>
                    <td>{{clienteModal.localidad}}</td>
                </tr>
                <tr>
                    <th>Tel&eacute;fono</th>
                    <td>{{clienteModal.telefono}}</td>
                    <th>C&oacute;digo postal</th>
                    <td>{{clienteModal.codigo_postal}}</td>
                    <th>Provincia</th>
                    <td>{{clienteModal.provincia}}</td>
                </tr>
                <tr>
                    <th>Condici&oacute;n IVA</th>
                    <td>{{ (clienteModal.id_condicion_iva == 1 
                        ? 'Consumidor Final' 
                        : (clienteModal.id_condicion_iva == 2 
                            ? 'Monotributista' 
                            : (clienteModal.id_condicion_iva == 3 
                                ? 'Exento'
                                : 'Responsable inscripto')))}}</td>
                    <th>Depto.</th>
                    <td>{{clienteModal.depto}}</td>
                    <th>Piso</th>
                    <td>{{clienteModal.piso}}</td>
                </tr>
                <tr>
                    <th>Cuit/Cuil</th>
                    <td>{{clienteModal.cuit_cuil}}</td>
                    <th>Celular</th>
                    <td>{{clienteModal.celular == null ? '--' : clienteModal.celular}}</td>
                </tr>
            </table>
        </div>
        <br>
    </div>
    <!-- <br> -->
    <!-- SE LISTAN LOS CLIENTES-->
    <div class="w3-bar w3-black">
        <button class="w3-bar-item w3-button" ng-click="mostrarUsuario(1)">Clientes</button>
        <button class="w3-bar-item w3-button" ng-click="mostrarUsuario(2)">Supervisores</button>
        <button class="w3-bar-item w3-button" ng-click="mostrarUsuario(3)">Administradores</button>
    </div>
    
    <div class="w3-row-padding">
        <div class="" ng-show="mostrarCliente">
            <div class="w3-container w3-white">
                <div class="w3-card-4 " ng-init="listarClientes()">
                    <header class="w3-container w3-orange">
                        <a href="" class="w3-btn w3-orange w3-right" ng-click="mostraFiltrosBusqueda()">
                            <span class="fa fa-filter " ng-if="!mostrarFiltro"></span>
                            <span class="fa fa-close " ng-if="mostrarFiltro"></span>
                        </a>
                        <h2>Clientes</h2>
                        <div ng-show="mostrarFiltro">
                            <form action="" name="filtroClienteForm" class="w3-container">
                                <div class="w3-quarter">
                                    <label>Nombre</label>
                                    <input class="w3-input w3-border w3-round" type="text" name="nombreFiltro" ng-model="nombreFiltro">
                                </div>
                                <div class="w3-quarter">
                                    <label>Apellido</label>
                                    <input class="w3-input w3-border w3-round" type="text" name="apellidoFiltro" ng-model="apellidoFiltro">
                                </div>
                                <div class="w3-quarter">
                                    <label>Cuil-cuit</label>
                                    <input class="w3-input w3-border w3-round" type="text" name="ciulFiltro" ng-model="cuilFiltro">
                                </div>
                                <div class="w3-quarter">
                                    <label>Raz&oacute;n social</label>
                                    <input class="w3-input w3-border w3-round" type="text" name="razonSocialFiltro" ng-model="razonSocialFiltro">
                                </div>   
                                
                            </form>
                        </div>
                        <div ng-show="mostrarFiltro" class="w3-margin"> 
                            <!-- <button class="w3-btn w3-blue w3-round w3-right" 
                            ng-click="listarClientes()" >Filtrar</button> -->
                            <input type="submit" class="w3-btn w3-blue w3-round w3-right" 
                            ng-click="listarClientes();cantidadDePaginacion()" value="Filtrar" />
                            <br><br>
                        </div>

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
                                        <a href="" ng-click="verDetalleCliente(cliente)" class="w3-btn w3-blue w3-round">Ver detalles</a>
                                        <a href="" ng-click="activarAdmin(cliente.id, 1)" class="w3-btn w3-orange w3-round">Dar permiso Admin</a>
                                        <a href="" ng-click="activarSupervisor(cliente.id, 1)" class="w3-btn w3-deep-purple w3-round">Dar permiso Supervisor</a>
                                        <a href="" ng-click="activarCliente(cliente)" class="w3-btn w3-round "  ng-class="{'w3-blue': cliente.activo ==1, 'w3-green': cliente.activo != 1}" >
                                            <span ng-if="cliente.activo != 1" >Activar</span><span ng-if="cliente.activo == 1" >Desactivar</span></a>
                                        <a href="" ng-click="resetPass(cliente)" class="w3-btn w3-lime w3-round">Resetear contrase&ntilde;a</a>
                                        <a href="" ng-click="eliminarCliente(cliente)" class="w3-btn w3-red w3-round">Eliminar</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- PAGINACION -->
                <br>
                <div class="w3-bar w3-border w3-round w3-center " ng-init="cantidadDePaginacion()">
                    <a href="" class="w3-button" ng-click="cambiarPagina(0)">&#10094; Previous</a>
                    
                    <a href="" class="w3-button " ng-repeat="paginacion in paginaciones track by $index" ng-class="{'w3-green': (desdeCliente==(paginacion * limite - limite))}" ng-click="buscarSegunPagina(paginacion)">{{paginacion}}</a>

                    <a href="" class="w3-button" ng-click="cambiarPagina(1)">Next &#10095;</a>
                </div>
                <!-- FIN PAGINACION -->
            </div>
        </div>
        <!-- SE LISTAN LOS ADMINISTRADORES-->
        <div class="" ng-show="mostrarAdministrador">
            <div class="w3-container w3-white">
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
                                        <a href="" ng-click="verDetalleCliente(cliente)" class="w3-btn w3-blue">Ver detalles</a>
                                        <a href="" ng-click="activarAdmin(cliente.id, 0)" class="w3-btn w3-red">Quitar permiso Admin</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- PAGINACION -->
                <br>
                    <div class="w3-bar w3-border w3-round w3-center " ng-init="cantidadDePaginacionAdmin()">
                        <a href="" class="w3-button" ng-click="cambiarPaginaAdmin(0)">&#10094; Previous</a>
                        
                        <a href="" class="w3-button " ng-repeat="paginacion in paginacionesAdmin track by $index" ng-class="{'w3-green': (desdeAdmin==(paginacion * limite - limite))}" ng-click="buscarSegunPaginaAdmin(paginacion)">{{paginacion}}</a>
    
                        <a href="" class="w3-button" ng-click="cambiarPaginaAdmin(1)">Next &#10095;</a>
                    </div>
                    <!-- FIN PAGINACION -->
            </div>
        </div>
        <!-- SE LISTAN LOS SUPERVISORES-->
        <div class="" ng-show="mostrarSupervisor">
            <div class="w3-container w3-white">
                <div class="w3-card-4 " ng-init="listarSupervisores()">
                    <header class="w3-container w3-orange">
                        <h2>Supervisores</h2>
                    </header>
                    <div ng-show="supervisores.length > 0">
                        <!-- TABLA QUE LISTA LOS SUPERVISORES -->
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
                                <tr ng-repeat="cliente in supervisores">
                                    <td>{{cliente.id}}</td>
                                    <td>{{cliente.usuario}}</td>
                                    
                                    <td>{{cliente.nombre}}</td>
                                    <td>{{cliente.apellido}}</td>
                                    <td>
                                        <a href="" ng-click="verDetalleCliente(cliente)" class="w3-btn w3-blue">Ver detalles</a>
                                        <a href="" ng-click="activarSupervisor(cliente.id, 0)" class="w3-btn w3-red">Quitar permiso Supervisor</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- PAGINACION -->
                <br>
                <div class="w3-bar w3-border w3-round w3-center " ng-init="cantidadDePaginacionSupervisor()">
                    <a href="" class="w3-button" ng-click="cambiarPaginaSupervisor(0)">&#10094; Previous</a>
                    
                    <a href="" class="w3-button " ng-repeat="paginacion in paginacionesSupervisor track by $index" ng-class="{'w3-green': (desdeSupervisor==(paginacion * limite - limite))}" ng-click="buscarSegunPaginaSupervisor(paginacion)">{{paginacion}}</a>

                    <a href="" class="w3-button" ng-click="cambiarPaginaSupervisor(1)">Next &#10095;</a>
                </div>
                <!-- FIN PAGINACION -->
            </div>
        </div>
    </div>

</body>
</html>
