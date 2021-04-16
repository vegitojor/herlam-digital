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
    <script type="text/javascript" src="../js/adminModule.js?<?= $versionJs ?>"></script>
    <!-- Controlador angular -->
    <script type="text/javascript" src="../js/adminNotificacionesController.js?<?= $versionJs ?>"></script>
    <script src="https://cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>
    
    <title>Notificaciones</title>
</head>
<body ng-app="admin" class="w3-light-gray" ng-controller="adminCategoriaController">
    <div class="w3-row">
        <?php include_once('../incluciones/navegadorAdmin.php');  ?>
    </div>
    <div class="w3-row">
        <div class=" w3-padding-32 w3-blue-gray">
            <h1 class="w3-jumbo w3-margin-left">Notificaciones</h1>
            <!-- <a href="" class="w3-btn w3-orange w3-hover-blue-gray w3-margin-left" ng-click="abrirCargaCategoria()"><span class="fa fa-plus"></span> Agregar Categoria</a> -->
        </div>
    </div>
    <div class="w3-row">
        <div class="w3-container w3-padding-16">
            <div class="w3-container w3-padding-16 w3-col s12 l6">
                <div class="w3-container  w3-white w3-round w3-min-height-70-vh"  ng-init="cargarEditor()">
                    <form name="enviarMailForm">
                        <br>
                        <div class="">
                            <label>Destinatario/s</label>
                            <a href="" class="w3-btn w3-gray  w3-round w3-margin-bottom" ng-click="mostrarModalBusquedaDeGrupos()">buscar grupo</a>
                            <input 	type="text" class="w3-input" name="destino" ng-model="destino" placeholder="TODOS LOS CONTACTOS - o escriba los mail de destino separados por ';'." >
                        </div>
                        <div class="">
                            <label>Asunto</label>
                            <input 	type="text" class="w3-input" name="asunto" ng-model="asunto" placeholder="detalla el asunto" required>
                        </div>
                        <br>
                        <div>
                            <label for="">Mensaje</label>
                            <textarea class="w3-input" name="mensaje" id="mensajeNotificaciones" cols="30" rows="10" placeholder="Mensaje" required></textarea>
                        </div>
                        
                        <br>
                        <input type="submit" ng-disabled="enviarMailForm.$invalid" class="w3-right w3-btn w3-white w3-border w3-border-green w3-round w3-margin-bottom" value="Enviar" ng-click="enviarMail()">
                        <br>
                        <br>
                    </form>
                </div>
            </div>
            <div class="w3-container w3-padding-16 w3-col s12 l6" ng-init="listarNotificacionesEnviadas()">
                <div class="w3-container  w3-white w3-round w3-min-height-70-vh"  >
                    <div class="" ng-if="notificacionesEnviadas.length != 0 " >
                        <div>
                            <h3>Bandeja de salida</h3>
                            <table class="w3-hoverable w3-striped" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Asunto</th>
                                        <th>Fecha</th>
                                        <tH>De:</tH>
                                    </tr>
                                </thead>
                                <colgroup>
                                    <col width="60%" />
                                    <col width="0%" />
                                </colgroup>
                                <tbody>
                                    <tr ng-repeat="notificacion in notificacionesEnviadas" ng-click="mostrarModal(notificacion)">
                                        
                                        <td class="w3-text-blue">{{notificacion.asunto}}</td>
                                        <td class="w3-right-align">{{notificacion.fecha}}</td>
                                        <td class="w3-right-align">{{notificacion.nombre}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- <div ng-bind-html="mensajeEnviado"></div> -->
                        <!-- PAGINACION -->
                        <br>
                        <div class="w3-bar w3-border w3-round w3-center " ng-init="cantidadDePaginacion()">
                            <a href="" class="w3-button" ng-click="cambiarPagina(0)">&#10094; Previous</a>
                            
                            <a href="" class="w3-button " ng-repeat="paginacion in paginaciones" ng-class="{'w3-green': (desde==(paginacion * limite - limite))}" ng-click="buscarSegunPagina(paginacion)">{{paginacion}}</a>

                            <a href="" class="w3-button" ng-click="cambiarPagina(1)">Next &#10095;</a>
                        </div>
                        <!-- FIN PAGINACION -->
                    </div>
                    <div ng-if="notificacionesEnviadas.length == 0 ">No hay notificaciones enviadas.</div>
                </div>
            </div>
        </div>
        
    </div>

    <!-- The Modal -->
	<div id="mensajeModal" class="w3-modal"> 
		<div class="w3-modal-content w3-animate-bottom" >
            <header class="w3-container w3-gray">
                <span ng-click="cerrarModal()" 
                    class="w3-button w3-display-topright">&times;</span>
                <h2>Detalles del mensaje</h2>
            </header>

            <div class="w3-container w3-light-gray">
                <p>Mensaje</p>
                
                <p>Asunto: <span class="w3-text-blue">{{notificacionModal.asunto}}</span></p>
                <p>De: {{notificacionModal.nombre}}</p>
                <p>Fecha: {{notificacionModal.fecha}}</p>
                <a href="" class="w3-text-indigo" ng-click="mostrarOcultarDestinatarios()" ng-hide="mostrarDestinatarios">mostrar destinatarios ({{notificacionModal.cantidad_destinatarios}})</a>
                <div ng-show="mostrarDestinatarios" class="w3-white w3-round ">
                    <p>{{notificacionModal.destinatarios}}</p>
                    <a href="" class="w3-right w3-btn w3-white w3-border w3-border-green w3-round " ng-click="mostrarOcultarDestinatarios()">Ocultar</a>
                </div>
                <br>
                
                <div ng-bind-html="mensaje" class="w3-white w3-round" style="padding: 10px;" ></div>
                <br>
            </div>
		</div>
	</div>

    <!-- The Modal -->
	<div id="busquedaDeGrupos" class="w3-modal"> 
		<div class="w3-modal-content w3-animate-bottom" >
            <header class="w3-container w3-gray">
                <span ng-click="cerrarModalBusquedaDeGrupos()" 
                    class="w3-button w3-display-topright">&times;</span>
                <h2>Generar grupo de destinatarios</h2>
            </header>

            <div class="w3-container w3-light-gray">
                <form name="enviarMailForm">
                    <br>
                    <div class="w3-content w3-center">

                        <select class="w3-select" name="proveedor" id="proveedor"  required>
                            <option value="" disabled>Seleccione un proveedor</option>
                            <option value="1" >Segun cantidad de ingresos al sistema</option>
                            <option value="2" >Segun cantidad de Pedidos</option>
                            <option value="3" >Segun cantidad de productos en el carrito</option>
                            <option value="4" >Segun cantidad de favoritos</option>
                            <!-- <option ng-repeat="proveedor in proveedores" value="{{proveedor.id}}">{{proveedor.nombre}}</option> -->
                        </select>
                        <div ng-show="formularioProducto.$submitted || formularioProducto.proveedor.$touched">
                            <span class="w3-red" ng-show="formularioProducto.proveedor.$error.required">El campo es obligatorio.</span>
                        </div>
                        <!-- <label for="proveedor">Proveedor*</label> -->

                    </div>
                    <div>
                        <input class="w3-radio" type="radio" name="gender" value="asc" >
                        <label>Ascendente</label>
                        
                        <input class="w3-radio" type="radio" name="gender" value="desc" checked>
                        <label>Descendente</label>
                    </div>
                    <br>
                    <div class="">
                        <label>Cant. de resultados a buscar:</label>
                        <input 	type="number" class="w3-input" name="destino" ng-model="destino" placeholder="ingrese la cantidad deseada de registros a mostrar en el resultado." >
                    </div>
                    
                    <div class="">
                        <a href="" class="w3-btn w3-gray  w3-round w3-margin w3-right"   ng-click="mostrarModalBusquedaDeGrupos()">buscar grupo</a>
                    </div>
                    <hr>
                    <div>
                        <label for="">Resultados:</label>
                        <textarea class="w3-input" name="mensaje" id="mensajeNotificaciones" cols="30" rows="10" placeholder="Mensaje" required></textarea>
                    </div>
                    
                    <br>
                    <input type="submit" ng-disabled="enviarMailForm.$invalid" class="w3-right w3-btn w3-white w3-border w3-border-green w3-round w3-margin-bottom" value="Enviar" ng-click="enviarMail()">
                    <br>
                    <br>
                </form>
            </div>
		</div>
	</div>

</body>
</html>
