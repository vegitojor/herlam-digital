<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 9/12/17
 * Time: 11:32
 */

//include_once('../incluciones/verificacionUsuario.php');
include_once ('../incluciones/verificacionSupervisor.php');
//$idCategoria = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="es" >

<head>
    <?php include_once ('../incluciones/head.php'); ?>
    <script type="text/javascript" src="../js/adminModule.js"></script>
    <script type="text/javascript" src="../js/supervisorPedidoController.js?<?= $versionJs ?>"></script>

    <title>Pedido - Herlam</title>

</head>

<body ng-app="admin" ng-controller="supervisorPedidoController">
<!-- Navigation -->
<?php include_once('../incluciones/navbarVistas.php'); ?>
<!-- FIN DEL NAV   -->

<!-- Page Content -->
<div class="container">
    <div id="preloader" ng-show="preloader">
        <div class="sk-cube-grid">
            <div class="sk-cube sk-cube1"></div>
            <div class="sk-cube sk-cube2"></div>
            <div class="sk-cube sk-cube3"></div>
            <div class="sk-cube sk-cube4"></div>
            <div class="sk-cube sk-cube5"></div>
            <div class="sk-cube sk-cube6"></div>
            <div class="sk-cube sk-cube7"></div>
            <div class="sk-cube sk-cube8"></div>
            <div class="sk-cube sk-cube9"></div>
        </div>
    </div>

    <h1>Pedidos</h1>
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped" ng-init="buscarPedidos()">
                <thead>
                    <tr>
                        <th>N&deg; pedido</th>
                        <th>Estado</th>
                        <th>Cliente</th>
                        <th>fecha</th>
                        <th>Domicilio</th>
                        <th>C&oacute;digo Postal</th>
                        <th>Localidad</th>
                        <th>Provincia</th>
                        <th>Tipo de envio</th>
                        <th>Dia de entrega</th>
                        <th>Horario</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="pedido in pedidos">
                        <td>{{pedido.id_pedido}}</td>
                        <td class="{{pedido.id_estado_pedido_supervisor == 1 ? 'text-primary' : 'text-warning'}}" >{{pedido.estado_pedido_supervisor}}</td>
                        <td>{{pedido.nombre_cliente}} {{pedido.apellido_cliente}}</td>
                        <td>{{pedido.fecha_pedido}}</td>
                        <td>{{pedido.calle}} {{pedido.numero}} {{pedido.piso}} {{pedido.depto}}</td>
                        <td>{{pedido.codigo_postal}}</td>
                        <td>{{pedido.localidad}}</td>
                        <td>{{pedido.provincia}}</td>
                        <td>
                            <span ng-if="!pedido.tipo_pedido">Retiro acordado c/ vendedor</span>
                            <span ng-if="pedido.tipo_pedido">Env&iacute;o a domicilio</span>
                        </td>
                        <td>{{pedido.dia_envio == 0 ? 'Lunes' :
                            (pedido.dia_envio == 1 ? 'Martes' :
                                (pedido.dia_envio == 2 ? 'Miercoles' :
                                    (pedido.dia_envio == 3 ? 'Jueves' : 'Viernes')))}}
                        </td>
                        <td>{{pedido.horario_envio == 0 ? 'Mañana' : 'Tarde'}}</td>
                        <td>
                            <a href="javascript:void(0)"
                            class="btn btn-info"
                            ng-click="mostrarProductos(pedido)"
                            >Ver productos</a>
                            <a href="javascript:void(0)"
                            class="btn btn-success"
                            ng-click="cambiarARealizado(pedido)"
                            ng-if="pedido.id_estado_pedido_supervisor == 1"
                            >Cambiar a Realizado</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- PAGINACION DE PRODUCTOS-->
    <div class="text-center">
        <ul class="pagination pagination-lg">
            <li  ><a href="" ng-click="cambiarPagina(0)" >&laquo;</a></li>
            <li ng-repeat="paginacion in paginaciones" ng-class="{active: (desde==(paginacion * limite - limite))}"><a href="" ng-click="buscarSegunPagina(paginacion)">{{paginacion}}</a></li>
            
            <li><a href="" ng-click="cambiarPagina(1)">&raquo;</a></li>
        </ul>
    </div>
    <!-- FIN PAGINACION -->

    <!-- modal de productos para cada pedido supervisor -->
    <div id="verProductos" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Pedido N&deg;: {{pedidoModal.id_pedido}}</h4>
                </div>
                <div class="modal-body table-responsive" >
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Descripcion</th>
                                <th>Modelo</th>
                                <th>Categoria</th>
                                <th>Marca</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="producto in productos">
                                <td>{{producto.cantidad}}</td>
                                <td>{{producto.descripcion}}</td>
                                <td>{{producto.medelo}}</td>
                                <td>{{producto.categoria_nombre}}</td>
                                <td>{{producto.marca_descripcion}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container -->

<div class="container">
    <hr>
    <?php include_once('../incluciones/footer.php') ?>
</div>
<!-- /.container -->

<!-- jQuery -->
<script src="../librerias/template/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../librerias/template/js/bootstrap.min.js"></script>

<!-- Bootbox js -->
<script type="text/javascript" src="../librerias/bootbox/bootbox.min.js"></script>




</body>

</html>
