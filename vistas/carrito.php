<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 9/12/17
 * Time: 11:32
 */

include_once ('../incluciones/verificacionUsuario.php');

// if(!isset($_SESSION['usuario'])){
//     header('location: ../index.php');
// }

?>
<!DOCTYPE html>
<html lang="es" >

<head>
    <?php include_once ('../incluciones/head.php'); ?>
    <script type="text/javascript" src="../js/indexModulo.js"></script>
    <script type="text/javascript" src="../js/carritoController.js"></script>
    <!-- AngularVideo directive -->
    <script type="text/javascript" src="../librerias/angular-video/anguvideo.js"></script>
    <script type="text/javascript" src="../librerias/angular-video/controller.js"></script>

    <title>Carrito - MODPC</title>

</head>

<body ng-app="index" ng-controller="carritoController">
<!-- Navigation -->
<?php include_once('../incluciones/navbarVistas.php'); ?>
<!-- FIN DEL NAV   -->

<!-- Page Content -->
<div class="container">

    <div class="row">
        <!-- ASIDE - COLUMNA LATERAL -->
        <div class="col-md-3" ng-init="cargarMoneda()" >
            <div class="col-md-12" ng-init="generarCheckoutBasicoMP(<?= $id ?>)">
                <p class="lead">Categorias:</p>
                <div class="list-group" ng-init="listarCategorias()" >
                    <a ng-repeat="categoria in categorias" href="categoria.php?id={{categoria.id}}" class="list-group-item" >{{categoria.descripcion}}</a>

                </div>
            </div>
            
        </div>
        <!-- fin ASIDE -->
        <!--SECTION -->
        <div class="col-md-9">

            <div class="row" >
                <div class="jumbotron" ng-init="cargarProductosCarrito(<?= $id ?>)">
                    <h1 >Carrito de compras</h1>
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
                    <ul class="nav nav-tabs dtabs-justified">
                        <ul class="nav nav-tabs nav-justified">
                            <li  ng-class="{'active' : tab1}"><a data-toggle="tab" href="#paso1">Mi compra</a></li>
                            <li ng-class="{'active' : tab2}"><a data-toggle="tab" href="#paso2" >Datos de envio</a></li>
                            <li ng-class="{'active' : tab3}"><a data-toggle="tab" href="#paso3" >Confirmaci&oacute;n de compra</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="paso1">
                                <br>
                                <!-- CADA UNO DE LOS PRODUCTOS EN EL CARRITO -->
                                <div class="col-sm-12 col-lg-12 col-md-12 panel-group" >
                                    <div class="panel panel-default" ng-repeat="productoCarrito in productosDelCarrito"> 
                                        <div class="panel-heading"></div>
                                        <div class="panel-body">
                                            <div class="col-md-3">
                                                <img src="../resourses/imagen_producto/{{productoCarrito.imagen}}" class="foto320x100" alt="imagen-{{productoCarrito.modelo}}" ng-hide="productoCarrito.imagen == '<--NoFoto-->'" >
                                                <img src="http://placehold.it/320x150" alt="{{productoCarrito.modelo}}" class="foto320x100" ng-show="productoCarrito.imagen == '<--NoFoto-->'">
                                            </div>
                                            <div class="col-md-4">
                                                <br>
                                                <p><label>Producto:</label> {{productoCarrito.descripcion}}</p>
                                                <p>cantidad: <span><strong>{{productoCarrito.cantidad}}</strong></span></p>
                                                <a href="" id="modificarCantidad" ng-model="modificarCantidad" data-toggle="modal" data-target="#modificarCantidadModal" ng-click="setearProductoCambioCantidad(<?= $id ?>, productoCarrito.idProducto, productoCarrito.cantidad)">Modificar cantidad</a>
                                            </div>
                                            <div class="col-md-3">
                                                <h3 class="pull-right">{{productoCarrito.precio * moneda.valor * productoCarrito.cantidad | currency}}</h3>
                                                <h5>Subtotal:</h5>
                                                <br>
                                                
                                                
                                            </div>
                                            <div class="col-md-2">
                                                <div class=" pull-right">
                                                    <a href="" class="btn btn-danger" ng-click="quitarDelCarrito(<?= $id ?>, productoCarrito.idProducto, productoCarrito.cantidad)" " data-tooltip="tooltip" title="Quitar del carrito" onmouseenter="$(this).tooltip('show')"><span class="fa fa-times"></span></a>    
                                                    
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
                                        <h2 >TOTAL:</h2>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <h3>{{totalDelCarrito | currency}}</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- {{linkPagoMercadoPago}} -->
                                        <a data-toggle="tab" href="#paso2" class="btn btn-warning" ng-disabled="totalDelCarrito == 0" ng-click="pasarAlSiguente(2)">Siguiente</a>
                                    </div>
                                </div>
                                <!-- FIN TOTAL -->
                            </div>

                            <!-- paso 2  -->
                            <div class="tab-pane fade" id="paso2">
                                <div>
                                     
                                    <div>
                                        <h3>Seleccione la forma de entrega:</h3>
                                    </div>
                                    <div class="btn-group btn-group-justified">
                                        <a class="btn btn-default" ng-class="{'active': envioDomicilioDiv}" ng-click="determinarTipoDeEnvio('domicilio')">Envio a domicilio</a>
                                        <a class="btn btn-default" ng-class="{'active': (!envioDomicilioDiv && !envioVendedorDiv)}" ng-click="determinarTipoDeEnvio('sucursal')">Env&iacute;o a sucursal de correo</a>
                                        <a class="btn btn-default" ng-class="{'active': envioVendedorDiv}" ng-click="determinarTipoDeEnvio('vendedor')">Retiro acordado con vendedor</a>
                                    </div>
                                    
                                    <div class="">
                                        <!-- <form name="formularioEnvio" novalidate class="form-horizontal"> -->
                                            <hr>
                                            <div id="provinciaLocalidad" ng-show="envioProvinciaLocalidad">
                                                <form name="formProvinciaLocalidad" novalidate="" class="form-horizontal">
                                                    <div class="form-group" ng-init="cargarProvincias(); cargarCorreos()">
                                                        
                                                        <label class="col-md-2" for="provincia">Provincia</label>
                                                        
                                                        <div class="col-md-10">
                                                            <select class="form-control" id="provincia" name="provincia" ng-model="provincia" ng-change="cargarLocalidades()" required="">
                                                                <option value="">Seleccione una provincia</option>
                                                                <option ng-repeat="provincia in provincias" value={{provincia.id}}>{{provincia.nombre}}</option>
                                                            </select>
                                                            <div  ng-show="formProvinciaLocalidad.$submitted || formProvinciaLocalidad.provincia.$touched">
                                                                <span class="text-danger" ng-show="formProvinciaLocalidad.provincia.$error.required">El campo es obligatorio.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" >
                                                        
                                                        <label class="col-md-2" for="localidad">Localidad</label>
                                                        
                                                        <div class="col-md-10">
                                                            <select class="form-control" name="localidad" ng-model="localidad" required="">
                                                                <option value="">Seleccione una localidad</option>
                                                                <option ng-repeat="localidad in localidades" value="{{localidad.id}}">{{localidad.nombre}}</option>
                                                            </select>
                                                            <div  ng-show="formProvinciaLocalidad.$submitted || formProvinciaLocalidad.localidad.$touched">
                                                                <span class="text-danger" ng-show="formProvinciaLocalidad.localidad.$error.required">El campo es obligatorio.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <hr>

                                            </div>
                                            <div id="envioADomicilio" ng-show="envioDomicilioDiv">
                                                <form name="formEnvioDomicilio" class="form-horizontal">
                                                    <div class="col-md-12">
                                                        <div class="form-group col-md-8">
                                                            
                                                            <label class="col-md-2" for="calleDomicilio">Calle</label>
                                                            
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control" id="calleDomicilio" name="calleDomicilio" placeholder="Introduzca su domicilio" ng-model="calleDomicilio" ng-model-options="{ updateOn: 'blur' }" required>
                                                                <span ng-show="formularioEnvio.$submitted || formularioEnvio.calleDomicilio.$touched">
                                                                    <span class="text-danger" ng-show="formularioEnvio.calleDomicilio.$error.required">El campo es obligatorio.</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            
                                                            <label class="col-md-3" for="alturaDomicilio">Altura</label>
                                                            
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" id="alturaDomicilio" name="alturaDomicilio" placeholder="Introduzca el número" ng-model="alturaDomicilio" ng-model-options="{ updateOn: 'blur'}" required>
                                                                <span ng-show="formularioEnvio.$submitted || formularioEnvio.alturaDomicilio.$touched">
                                                                    <span class="text-danger" ng-show="formularioEnvio.alturaDomicilio.$error.required">El campo es obligatorio.</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group col-md-4" >
                                                            
                                                            <label class="col-md-4" for="pisoDomicilio">Piso</label>
                                                            
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" id="pisoDomicilio" name="pisoDomicilio" placeholder="Introduzca el piso" ng-model="pisoDomicilio" ng-model-options="{ updateOn: 'blur'}" >
                                                                <span ng-show="formularioEnvio.$submitted || formularioEnvio.pisoDomicilio.$touched">
                                                                    <span class="text-danger" ng-show="formularioEnvio.pisoDomicilio.$error.required">El campo es obligatorio.</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4" >
                                                            
                                                            <label class="col-md-4" for="deptoDomicilio">Depto.</label>
                                                            
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" id="deptoDomicilio" name="deptoDomicilio" placeholder="Introduzca el depto." ng-model="deptoDomicilio" ng-model-options="{ updateOn: 'blur'}" >
                                                                <span ng-show="formularioEnvio.$submitted || formularioEnvio.deptoDomicilio.$touched">
                                                                    <span class="text-danger" ng-show="formularioEnvio.deptoDomicilio.$error.required">El campo es obligatorio.</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            
                                                            <label class="col-md-4" for="codigoPostal">C&oacute;d. Postal</label>
                                                            
                                                            <div class="col-md-8">
                                                                <input type="number" min=0 class="form-control" id="codigoPostal" name="codigoPostal" placeholder="Introduzca el cod. postal" ng-model="codigoPostal" ng-model-options="{ updateOn: 'blur'}" required>
                                                                <span ng-show="formularioEnvio.$submitted || formularioEnvio.codigoPostal.$touched">
                                                                    <span class="text-danger" ng-show="formularioEnvio.codigoPostal.$error.required">El campo es obligatorio.</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <label class="radio-inline"><input type="radio" name="tipoServicioEntrega" ng-model="tipoServicioEntrega" value="N" >Servicio est&aacute;ndar</label>
                                                        <label class="radio-inline"><input type="radio" name="tipoServicioEntrega" ng-model="tipoServicioEntrega" value="P">Servicio prioritario</label>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                            <div id="sucursalCorreo" ng-show="!envioDomicilioDiv && !envioVendedorDiv">
                                                <form name="formEnvioSucursal" class="form-horizontal">
                                                    <label class="col-md-2" for="correo">Correo</label>
                                                        
                                                    <div class="col-md-10">
                                                        <select class="form-control" id="correo" name="correo" ng-model="correo" required="">
                                                            <option value="">Seleccione un correo</option>
                                                            <option ng-repeat="correo in correos" value={{correo.id}}>{{correo.nombre}}</option>
                                                        </select>
                                                        <div  ng-show="formularioEnvio.$submitted || formularioEnvio.correo.$touched">
                                                            <span class="text-danger" ng-show="formularioEnvio.correo.$error.required">El campo es obligatorio.</span>
                                                        </div>
                                                    </div>
                                                </form>
                                                
                                            </div>
                                            <div id="acuerdoConVendedor" ng-show="envioVendedorDiv">
                                                <h5>Puede retirar personalmente por la zona de Once, CABA. Al finalizar la compra se le informaran los datos del vendedor. Tambi&eacute;n puede consultar por horarios en la secci&oacute;n "contacto" o a trav&eacute;s de las "preguntas" de cada producto.</h5>
                                            </div>
                                            <div class="text-center">
                                                <input type="submit" class="btn btn-success" ng-show="!envioVendedorDiv" ng-disabled="formEnvioDomicilio.$invalid && formEnvioSucursal.$invalid" ng-click="calcularCostoEnvio(formEnvioDomicilio.$valid, formEnvioSucursal)" value="Calcular costo de env&iacute;o" />
                                                <div ng-if="envioDomicilioDiv">
                                                    <p ng-if="costoEnvio">Envio:
                                                            <span ng-show="costoEnvio.servicio == 'N'">servicio: Normal</span>
                                                            <span ng-hide="costoEnvio.servicio == 'N'">servicio: Prioritario</span>
                                                            <span>valor: <strong>${{costoEnvio.valor}}</strong></span>
                                                    </p>
                                                </div>
                                                <div ng-if="!envioDomicilioDiv && !envioVendedorDiv">
                                                    <div ng-if="!costoSucursalATotalizar">
                                                        <h5 ng-if="costoEnvioSucursal">Selecciona una sucursal:</h5>
                                                        <div class="table-responsive" ng-if="costoEnvioSucursal">
                                                            <table class="table table-condensed table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th>Correo</th>
                                                                        <th>Sucursal</th>
                                                                        <th>Valor</th>
                                                                        <th>Servicio</th>
                                                                        <th>Tiempo de entrega</th>
                                                                        <th>direcci&oacute;n</th>
                                                                        <th>Horario</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr ng-repeat="costo in costoEnvioSucursal">
                                                                        <td>
                                                                            <input type="checkbox" name="" ng-click="confirmarValorDeEnviosucursal( $index )">
                                                                        </td>
                                                                        <td>{{costo.sucursal.correo.nombre}}</td>
                                                                        <td>{{costo.sucursal.nombre}}</td>
                                                                        <td>{{costo.valor}}</td>
                                                                        <td><span ng-if="costo.servicio == 'N'">Normal</span><span ng-if="costo.servicio != 'N'">Prioritario</span></td>
                                                                        <td>{{costo.horas_entrega}}</td>
                                                                        <td>{{costo.sucursal.calle}} {{costo.sucursal.numero}}</td>
                                                                        <td>{{costo.sucursal.horario}}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div ng-if="costoSucursalATotalizar" class="row">
                                                        <div class="col-md-6 col-md-offset-3">
                                                            <dl class="dl-horizontal">
                                                                <dt>Valor</dt>
                                                                <dd>{{costoSucursalATotalizar.valor}}</dd>
                                                                <dt>Servicio</dt>
                                                                <dd ng-show="costoSucursalATotalizar.servicio == 'N'">Normal</dd>
                                                                <dd ng-show="!costoSucursalATotalizar.servicio == 'N'">Prioritario</dd>
                                                                <dt>Correo</dt>
                                                                <dd>{{costoSucursalATotalizar.sucursal.correo.nombre}}</dd>
                                                                <dt>Sucursal</dt>
                                                                <dd>{{costoSucursalATotalizar.sucursal.nombre}}</dd>
                                                                <dt>Direcci&oacute;n</dt>
                                                                <dd>{{costoSucursalATotalizar.sucursal.calle}} {{costoSucursalATotalizar.sucursal.numero}}</dd>
                                                                <dt>Tiempo de entrega</dt>
                                                                <dd>{{costoSucursalATotalizar.horas_entrega}}hs</dd>
                                                            </dl>
                                                        </div>
                                                        <!-- <ul ng-if="costoSucursalATotalizar" class="list-group">Envio:
                                                                <li ng-show="costoSucursalATotalizar.servicio == 'N'" class="list-item">servicio: Normal</li>
                                                                <li ng-hide="costoSucursalATotalizar.servicio == 'N'" class="list-item">servicio: Prioritario</li>
                                                                <li class="list-item">Correo: {{costoSucursalATotalizar.sucursal.correo.nombre}}</li>
                                                                <li class="list-item">Sucursal: {{costoSucursalATotalizar.sucursal.nombre}}</li>
                                                                <li class="list-item">Direcci&oacute;n: {{costoSucursalATotalizar.sucursal.calle}} {{costoSucursalATotalizar.sucursal.numero}}</li>
                                                                <li class="list-item">Tiempo de entrega: {{costoSucursalATotalizar.horas_entrega}}</li>
                                                        </ul> -->
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="">
                                                <a data-toggle="tab" href="#paso1" class="btn btn-danger " ng-disabled="totalDelCarrito == 0" ng-click="pasarAlSiguente(1)">Atr&aacute;s</a>
                                                    <!-- {{linkPagoMercadoPago}} -->
                                                <a data-toggle="tab" href="#paso3" class="btn btn-warning pull-right" ng-disabled="totalDelCarrito == 0" ng-click="pasarAlSiguente(3)">Siguiente</a>
                                            </div>
                                        <!-- </form> -->
                                        
                                    </div>
                                    <div>
                                        <!-- inicio de secion -->
                                    </div>
                                </div>
                                
                               
                            </div>

                            <!-- paso 3 -->
                            <div class="tab-pane fade" id="paso3">
                                
                            </div>
                        </div>
                    </ul>
                </div>


                
                
            </div>

        </div>
        <!-- fin SECTION -->
    </div>

</div>
<!-- /.container -->

<div class="container">

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12 text-center">
                <p>Copyright &copy; ModPC 2017</p>
            </div>
        </div>
    </footer>

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
                <button type="button" class="btn btn-success" ng-disabled="cambiarCantidad.$invalid" ng-click="modificarCantidadDesdeModal()" >Cambiar</button>
            </div>
        </form>
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
