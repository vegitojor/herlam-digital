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
    $versionJs = rand();

    ?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
      <?php include_once('../incluciones/head.php'); ?>
      <script type="text/javascript" src="../js/indexModulo.js?<?= $versionJs ?>"></script>
      <script type="text/javascript" src="../js/carritoController.js?<?= $versionJs ?>"></script>
      <!-- AngularVideo directive -->
      <script type="text/javascript" src="../librerias/angular-video/anguvideo.js?<?= $versionJs ?>"></script>
      <script type="text/javascript" src="../librerias/angular-video/controller.js?<?= $versionJs ?>"></script>

      <title>Carrito - Herlam</title>

  </head>

  <body ng-app="index" ng-controller="carritoController">
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

                      <div class="content">
                          <!-- <ul class="nav nav-tabs dtabs-justified"> -->
                              <!-- <ul class="nav nav-tabs nav-justified">
                                  <li ng-class="{'active' : tab1}"><a data-toggle="tab" href="#paso1">Generacion de pedido</a></li>
                                  <li ng-class="{'active' : tab2}"><a data-toggle="tab" href="#paso2">Datos de envio y facturaci&oacute;n</a></li>
                                   <li ng-class="{'active' : tab3}"><a data-toggle="tab" href="#paso3" >Confirmaci&oacute;n de compra</a></li> 
                              </ul> -->
                              <!-- <div class="tab-content"> -->
                                <div>
                                  <div class="" id="paso1" ng-show="paso1Div">
                                      <br>
                                      <!-- CADA UNO DE LOS PRODUCTOS EN EL CARRITO -->
                                      <div class="col-sm-12 col-lg-12 col-md-12 panel-group" ng-show="productosDelCarrito.length > 0">
                                          <div class="panel panel-default" ng-repeat="productoCarrito in productosDelCarrito">
                                              <div class="panel-heading"></div>
                                              <div class="panel-body">
                                                  <div class="col-md-3">
                                                      <img src="../resourses/imagen_producto/{{productoCarrito.imagen}}" class="foto320x100" alt="imagen-{{productoCarrito.modelo}}" ng-hide="productoCarrito.imagen == '<--NoFoto-->'">
                                                      <img src="../img/empty.jpeg" alt="{{productoCarrito.modelo}}" class="foto320x100" ng-show="productoCarrito.imagen == '<--NoFoto-->'">
                                                  </div>
                                                  <div class="col-md-4">
                                                      <br>
                                                      <p><label>Producto:</label> {{productoCarrito.descripcion}}</p>
                                                      <p>cantidad: <span><strong>{{productoCarrito.cantidad}}</strong></span></p>
                                                      <a href="" id="modificarCantidad" ng-model="modificarCantidad" data-toggle="modal" data-target="#modificarCantidadModal" ng-click="setearProductoCambioCantidad(<?= $id ?>, productoCarrito.id_producto, productoCarrito.cantidad)">Modificar cantidad</a>
                                                  </div>
                                                  <div class="col-md-3">
                                                      <h3 class="pull-right">{{productoCarrito.precio * moneda.valor * productoCarrito.cantidad | currency}}</h3>
                                                      <h5>Subtotal:</h5>
                                                      <br>


                                                  </div>
                                                  <div class="col-md-2">
                                                      <div class=" pull-right">
                                                          <a href="" class="btn btn-danger" ng-click="quitarDelCarrito(<?= $id ?>, productoCarrito.id_producto, productoCarrito.cantidad)" " data-tooltip=" tooltip" title="Quitar del carrito" onmouseenter="$(this).tooltip('show')"><span class="fa fa-times"></span></a>

                                                      </div>
                                                  </div>
                                              </div>
                                          </div>

                                      </div>
                                      <!-- FIN PRODUCTOS DEL CARRITO -->
                                      <div class="col-lg-12" ng-show="productosDelCarrito.length == 0">
                                          <p>No hay productos agregados al carrito. Naveg&aacute; por las categorias para agregar el producto que busc&aacute;s.</p>
                                      </div>
                                      <!-- TOTAL DE COMPRA -->
                                      <div class="col-sm-12 col-lg-12 col-md-12">
                                          <div class="col-md-4 text-center">
                                              <h2>TOTAL:</h2>
                                          </div>
                                          <div class="col-md-4 text-center">
                                              <h3>{{totalDelCarrito | currency}}</h3>
                                          </div>
                                          <div class="col-md-4">
                                              <!-- {{linkPagoMercadoPago}} -->
                                              <!-- data-toggle="tab" href="#paso2" -->
                                              <a href="javascript:void(0);" class="btn btn-warning" ng-disabled="totalDelCarrito == 0" ng-click="pasarAlSiguente(2)">Siguiente</a>
                                          </div>
                                      </div>
                                      <!-- FIN TOTAL -->
                                  </div>

                                  <!-- paso 2  -->
                                  <div class="" id="paso2" ng-hide="paso1Div">
                                      <div>

                                          <div>
                                              <h3>Complete los pasos para realizar su pedido:</h3>
                                          </div>
                                          <div class="btn-group btn-group-justified">
                                              <a class="btn btn-default" ng-class="{'active': envioDiv}" ng-click="determinarTipoDeEnvio('domicilio')">Env&iacute;o</a>
                                              <!-- <a class="btn btn-default" ng-class="{'active': envioVendedorDiv}" ng-click="determinarTipoDeEnvio('vendedor')">Retiro acordado con el vendedor</a> -->
                                              <a class="btn btn-default" ng-class="{'active': datosFacturacionDiv}" ng-click="determinarTipoDeEnvio('sucursal')">Datos de Facturacion</a>
                                          </div>

                                          <div class="">
                                              <!-- <form name="formularioEnvio" novalidate class="form-horizontal"> -->
                                                <div id="envioDiv" ng-show="envioDiv">
                                                    
                                                    <div id="selectTipoEnvio" ng-show="tipoEnvioDiv">
                                                        <form name="tipoEnvioForm">
                                                            <div class="form-group">
                                                                <label class="col-md-2" for="provincia">Tipo de env&iacute;o</label>
                                                                <div class="col-md-10">
                                                                    <select class="form-control" id="tipoEnvio" name="tipoEnvio" ng-model="tipoEnvio" ng-change="mostrarFormEnvio()" required="">
                                                                        <option value="">Seleccione una opci&oacute;n de env&iacute;o</option>
                                                                        <option value=0>Retiro acordado con vendedor</option>
                                                                        <option value=1>Env&iacute;o a domicilio</option>
                                                                    </select>
                                                                    <div ng-show="formProvinciaLocalidad.$submitted || formProvinciaLocalidad.provincia.$touched">
                                                                        <span class="text-danger" ng-show="formProvinciaLocalidad.provincia.$error.required">El campo es obligatorio.</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    
                                                    <br>
                                                    <hr>

                                                    <div id="envioADomicilioDiv" ng-show="envioDomicilioDiv">
                                                        <h5>Completar con los datos del punto de entrega</h5>
                                                        <form name="envioDomiciolioForm" novalidate="" class="form-horizontal">
                                                            <div class="form-group" ng-init="cargarProvincias()">

                                                                <label class="col-md-2" for="provincia">Provincia</label>

                                                                <div class="col-md-10">
                                                                    <select class="form-control" id="provincia" name="provincia" ng-model="provincia" ng-change="cargarLocalidades()">
                                                                        <option value="">Seleccione una provincia</option>
                                                                        <option ng-repeat="provincia in provincias" value={{provincia.id}}>{{provincia.provincia}}</option>
                                                                    </select>
                                                                    <div ng-show="envioDomiciolioForm.$submitted || envioDomiciolioForm.provincia.$touched">
                                                                        <span class="text-danger" ng-show="envioDomiciolioForm.provincia.$error.required">El campo es obligatorio.</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">

                                                                <label class="col-md-2" for="localidad">Localidad</label>

                                                                <div class="col-md-10">
                                                                    <select class="form-control" name="localidad" ng-model="localidad" required="">
                                                                        <option value="">Seleccione una localidad</option>
                                                                        <option ng-repeat="localidad in localidades" value="{{localidad.id}}">{{localidad.localidad }}</option>
                                                                    </select>
                                                                    <div ng-show="envioDomiciolioForm.$submitted || envioDomiciolioForm.localidad.$touched">
                                                                        <span class="text-danger" ng-show="envioDomiciolioForm.localidad.$error.required">El campo es obligatorio.</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="col-md-12">
                                                                <div class="form-group col-md-10">

                                                                    <label class="col-md-2" for="calleDomicilio">Calle</label>

                                                                    <div class="col-md-10">
                                                                        <input type="text" class="form-control" id="calleDomicilio" name="calleDomicilio" placeholder="Introduzca su domicilio" ng-model="calleDomicilio" ng-model-options="{ updateOn: 'blur' }" required>
                                                                        <span ng-show="envioDomiciolioForm.$submitted || envioDomiciolioForm.calleDomicilio.$touched">
                                                                            <span class="text-danger" ng-show="envioDomiciolioForm.calleDomicilio.$error.required">El campo es obligatorio.</span>
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group col-md-4">

                                                                    <label class="col-md-4" for="pisoDomicilio">Piso</label>

                                                                    <div class="col-md-8">
                                                                        <input type="text" class="form-control" id="pisoDomicilio" name="pisoDomicilio"  placeholder="Introduzca el piso" ng-model="pisoDomicilio" ng-model-options="{ updateOn: 'blur'}">
                                                                        <span ng-show="envioDomiciolioForm.$submitted || envioDomiciolioForm.pisoDomicilio.$touched">
                                                                            <span class="text-danger" ng-show="envioDomiciolioForm.pisoDomicilio.$error.required">El campo es obligatorio.</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-4">

                                                                    <label class="col-md-4" for="deptoDomicilio">Depto.</label>

                                                                    <div class="col-md-8">
                                                                        <input type="text" class="form-control" id="deptoDomicilio" name="deptoDomicilio"  placeholder="Introduzca el depto." ng-model="deptoDomicilio" ng-model-options="{ updateOn: 'blur'}">
                                                                        <span ng-show="envioDomiciolioForm.$submitted || envioDomiciolioForm.deptoDomicilio.$touched">
                                                                            <span class="text-danger" ng-show="envioDomiciolioForm.deptoDomicilio.$error.required">El campo es obligatorio.</span>
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group col-md-4">
                                                                    <label class="col-md-4" for="codigoPostal">C&oacute;d. Postal</label>
                                                                    <div class="col-md-8">
                                                                        <input type="number" min=0 class="form-control" id="codigoPostal" name="codigoPostal" placeholder="Introduzca el cod. postal" ng-model="codigoPostal" ng-model-options="{ updateOn: 'blur'}" required>
                                                                        <span ng-show="envioDomiciolioForm.$submitted || envioDomiciolioForm.codigoPostal.$touched">
                                                                            <span class="text-danger" ng-show="envioDomiciolioForm.codigoPostal.$error.required">El campo es obligatorio.</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-md-12">
                                                                <p>Dias y horarios de entrega: Lun. a Vier. de 8:30 a 12:30 y 13:30 a 18:00</p>
                                                            </div> -->
                                                            <div class=" col-md-12">
                                                                <div class="col-md-4">
                                                                    <p>Dia preferencial de entrega: </p>
                                                                </div>
                                                                <div class="col-md-8 btn-group ">
                                                                    <button class="btn btn-default" ng-click="setEnvioDia(0)" ng-class="{'active': envioDia == 0}" >Lunes</button>
                                                                    <!-- <a class="btn btn-default" ng-class="{'active': envioVendedorDiv}" ng-click="determinarTipoDeEnvio('vendedor')">Retiro acordado con el vendedor</a> -->
                                                                    <button class="btn btn-default" ng-click="setEnvioDia(1)" ng-class="{'active': envioDia == 1}">Martes</button>
                                                                    <button class="btn btn-default" ng-click="setEnvioDia(2)" ng-class="{'active': envioDia == 2}">Miercoles</button>
                                                                    <button class="btn btn-default" ng-click="setEnvioDia(3)" ng-class="{'active': envioDia == 3}">Jueves</button>
                                                                    <button class="btn btn-default" ng-click="setEnvioDia(4)" ng-class="{'active': envioDia == 4}">Viernes</button>
                                                                </div>
                                                            </div>
                                                            <div class=" col-md-12">
                                                                <div class="col-md-4">
                                                                    <p>Horario preferencial de entrega: </p>
                                                                </div>
                                                                <div class="col-md-8 btn-group ">
                                                                    <button class="btn btn-default" ng-click="setEnvioDia(0, 1)" ng-class="{'active': envioHorario == 0}" >Ma&ntilde;ana</button>
                                                                    <button class="btn btn-default" ng-click="setEnvioDia(1, 1)" ng-class="{'active': envioHorario == 1}">Tarde</button>
                                                                    <!-- <button class="btn btn-default" ng-click="setEnvioDia(2)" ng-class="{'active': envioDia == 2}">Miercoles</button>
                                                                    <button class="btn btn-default" ng-click="setEnvioDia(3)" ng-class="{'active': envioDia == 3}">Jueves</button>
                                                                    <button class="btn btn-default" ng-click="setEnvioDia(4)" ng-class="{'active': envioDia == 4}">Viernes</button> -->
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <br>
                                                        </form>
                                                    </div>

                                                    <div id="envioVendedorDiv" ng-show="envioVendedorDiv">
                                                        <h5>Al finalizar la solicitud de pedido uno de nuestros vendedores le informar&aacute; la direcci&oacute;n de entrega. Tambi&eacute;n puede consultar por horarios en la secci&oacute;n "contacto" o a trav&eacute;s de las "preguntas" de cada producto.</h5>
                                                    </div>
                                                    <div class="text-center">
                                                        <button class="btn btn-warning" ng-click="validarFormEnvio()" >Continuar</button>
                                                    </div>
                                                </div> 

                                                <div id="datosFacturacionDiv" ng-show="datosFacturacionDiv">
                                                    <div id="datosFacturacion">
                                                        <br>
                                                        <br>
                                                        <form name="datosFacturacionForm">
                                                            <div class="form-group col-md-12">
                                                                <label class="col-md-4" for="nombre">Nombre y apellido</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control" id="nombreApellido" name="nombreApellido" ng-model="nombreApellido"  placeholder="" readonly>
                                                                    <span ng-show="datosFacturacionForm.$submitted || datosFacturacionForm.deptoDomicilio.$touched">
                                                                        <span class="text-danger" ng-show="datosFacturacionForm.deptoDomicilio.$error.required">El campo es obligatorio.</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label class="col-md-4" for="nombre">Raz&oacute;n social</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control" id="razonSocial" name="razonSocial" ng-model="razonSocial"  placeholder="" readonly>
                                                                    <span ng-show="datosFacturacionForm.$submitted || datosFacturacionForm.deptoDomicilio.$touched">
                                                                        <span class="text-danger" ng-show="datosFacturacionForm.deptoDomicilio.$error.required">El campo es obligatorio.</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label class="col-md-4" for="nombre">Cuit/Cuil</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control" id="cuitCuil" name="cuitCuil" ng-model="cuitCuil"  placeholder="" >
                                                                    <span ng-show="datosFacturacionForm.$submitted || datosFacturacionForm.deptoDomicilio.$touched">
                                                                        <span class="text-danger" ng-show="datosFacturacionForm.deptoDomicilio.$error.required">El campo es obligatorio.</span>
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label class="col-md-4" for="nombre">Condicion IVA</label>
                                                                <div class="col-md-8">
                                                                    <select class="form-control" name="condicionIva" ng-model="condicionIva" required=""
                                                                    ng-options="item.id as item.name for item in condicionesIva">
                                                                        <!-- <option value="">Seleccione su condicion de IVA</option>
                                                                        <option value="1">Consumidor final</option>
                                                                        <option value="2">Monotributista</option>
                                                                        <option value="3">Exento</option>
                                                                        <option value="4">Responsable inscripto</option> -->
                                                                    </select>
                                                                    <div ng-show="datosFacturacionForm.$submitted || datosFacturacionForm.localidad.$touched">
                                                                        <span class="text-danger" ng-show="datosFacturacionForm.localidad.$error.required">El campo es obligatorio.</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="text-center">
                                                                <button class="btn btn-success" ng-click="generarPedido()" >Generar pedido</button>
                                                            </div>
                                                            <br>
                                                        </form>
                                                    </div>
                                                </div>

                                          </div>
                                      </div>
                                  </div>

                                  <!-- paso 3 -->
                                  <!-- <div class="tab-pane fade" id="paso3">
                                  
                              </div> -->
                              <!-- </div> -->
                          <!-- </ul> -->
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
