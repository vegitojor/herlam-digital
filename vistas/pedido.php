  <?php
    /**
     * Created by PhpStorm.
     * User: vegitojor
     * Date: 9/12/17
     * Time: 11:32
     */

    include_once('../incluciones/verificacionUsuario.php');

    // if(!isset($_SESSION['usuario'])){
    //     header('location: ../index.php');
    // }

    ?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
      <?php include_once('../incluciones/head.php'); ?>
      <script type="text/javascript" src="../js/indexModulo.js"></script>
      <script type="text/javascript" src="../js/pedidoController.js"></script>
      <!-- AngularVideo directive -->
      <script type="text/javascript" src="../librerias/angular-video/anguvideo.js"></script>
      <script type="text/javascript" src="../librerias/angular-video/controller.js"></script>

      <title>Carrito - Herlam</title>

  </head>

  <body ng-app="index" ng-controller="pedidoController">
      <!-- Navigation -->
      <?php include_once('../incluciones/navbarVistas.php'); ?>
      <!-- FIN DEL NAV   -->

      <!-- Page Content -->
      <div class="container">

            <div class="row">
                <!-- ASIDE - COLUMNA LATERAL -->
                <div class="col-md-3" ng-init='cargarMoneda(); obtenerUsuario(<?= json_encode($usuarioArray); ?>)'>
                    <div class="col-md-12" >
                        <p class="lead">Categorias:</p>
                        <div class="list-group" ng-init="listarCategorias()" ng-show="categorias.length > 0">
                            <a ng-repeat="categoria in categorias" href="categoria.php?id={{categoria.id}}" class="list-group-item">{{categoria.nombre}}</a>
                        </div>
                    </div>
                </div>
                <!-- fin ASIDE -->
                <!--SECTION -->
                <div class="col-md-9">

                    <div class="row">
                        <div class="jumbotron" ng-init="cargarProductosCarrito(<?= $id ?>)">
                            <h1>Solicitud de pedido</h1>
                        </div>
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

                        <div class="content" ng-init="cargarPedidos()">
                            <div ng-if="pedidos.length == 0">
                                <p>A&uacute;n no se genero ningun pedido.</p>
                            </div> 

                            <div id="tablePedido" ng-if="pedidos.length > 0" class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <td>Pedido N&deg;</td>
                                            <td>Fecha</td>
                                            <td>Estado</td>
                                            <td>Domicilio entrega</td>
                                            <td>Productos</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="pedido in pedidos">
                                            <td>{{pedido.id}}</td>
                                            <td>{{pedido.fecha}}</td>
                                            <td ng-class="{
                                                    info: pedido.id_estado_pedido == 1,
                                                    success: pedido.id_estado_pedido == 3,
                                                    warning: pedido.id_estado_pedido == 4 || pedido.id_estado_pedido == 2,
                                                    danger: pedido.id_estado_pedido == 6
                                                }">{{pedido.estado_descripcion}}</td>
                                            <td>
                                                <a href="javascript:void(0);" ng-click="mostrarEnvio(pedido)">Ver domicilio</a>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" ng-click="mostrarProductos(pedido)">Ver productos</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin SECTION -->
            </div>

      </div>
      <!-- /.container -->

      <div class="container">
          <hr>
          <?php include_once('../incluciones/footer.php') ?>
      </div>
      <!-- /.container -->

      <!-- modal modicar cantidad -->
      <div id="modificarCantidadModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Modificar cantidad</h4>
                  </div>
                  <div class="modal-body">
                      <form name="cambiarCantidad">
                          <div class="form-group">
                              <label for="cantidad">Ingresar la nueva cantidad</label>
                              <input type="number" class="form-control" ng-model="nuevaCantidad" min=0 required>
                          </div>
                          <div>
                              <button type="button" class="btn btn-success" ng-disabled="cambiarCantidad.$invalid" ng-click="modificarCantidadDesdeModal()">Cambiar</button>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
              </div>

          </div>
      </div>
        <!-- final de modal -->

        <!-- Modal Envio-->
        <div id="modalEnvio" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tipo y Datos de env&iacute;o</h4>
                </div>
                <div class="modal-body">
                    <p>Tipo de env&iacute;o: {{tipoEnvioNombre}}</p>
                    <div class="table-responsive">
                        <table ng-if="tipoEnvioId == 1" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Provincia</th>
                                    <th>Localidad</th>
                                    <th>Domicilio</th>
                                    <th>Piso</th>
                                    <th>Depto.</th>
                                    <th>C&oacute;digo postal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{tipoEnvioProvincia}}</td>
                                    <td>{{tipoEnvioLocalidad}}</td>
                                    <td>{{tipoEnvioDomicilio}}</td>
                                    <td>{{tipoEnvioPiso}}</td>
                                    <td>{{tipoEnvioDepto}}</td>
                                    <td>{{tipoEnvioCodigoPostal}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </div>

            </div>
        </div>


        <!-- Modal Productos-->
        <div id="modalProductos" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Productos del pedido N&deg;: {{detalleProducto.numeroPedido}}</h4>
                </div>
                <div class="modal-body table-responsive">
                    <table  class="table table-striped">
                        <thead>
                            <tr>
                                <th>Modelo</th>
                                <th>Descripci&oacute;n</th>
                                <th>Cantidad</th>
                                <th>Precio unitario</th>
                                <th>Monto</th>
                                <!-- <th></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="producto in detalleProducto.productos">
                                <td>{{producto.modelo}}</td>
                                <td>{{producto.descripcion}}</td>
                                <td>{{producto.cantidad}}</td>
                                <td>{{producto.precio * moneda.valor | currency}}</td>
                                <td>{{producto.precio * producto.cantidad * moneda.valor | currency}}</td>
                                <!-- <td>{{detalleProducto}}</td> -->
                            </tr>
                        </tbody>
                    </table>
                    <p>Total: {{detalleProducto.sumaTotal | currency}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </div>

            </div>
        </div>




      <!-- jQuery -->
      <script src="../librerias/template/js/jquery.js"></script>

      <!-- Bootstrap Core JavaScript -->
      <script src="../librerias/template/js/bootstrap.min.js"></script>

      <!-- Bootbox js -->
      <script type="text/javascript" src="../librerias/bootbox/bootbox.min.js"></script>

      <!-- modal de contacto -->
      <?php include_once('../incluciones/formularioContacto.php'); ?>
      <script src="../librerias/formulario_contacto/jqBootstrapValidation.js"></script>
      <script src="../librerias/formulario_contacto/contact_me.js"></script>

  </body>

  </html>
