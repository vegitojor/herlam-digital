<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 9/09/17
 * Time: 2:44
 */

include_once ("../incluciones/verificacionAdmin.php");

?>

<!DOCTYPE html>
<html >
<head>

    <?php include_once ('../incluciones/headAdmin.php');?>

    <!-- Module -->
    <script type="text/javascript" src="../js/adminModule.js"></script>
    <!-- Controller -->
    <script type="text/javascript" src="../js/adminProveedoresController.js"></script>

    <title>Proveedor</title>
</head>
<body ng-app="admin" ng-controller="formularioProveedor" class="w3-light-gray">
    <!-- barra de navegacion -->
    <?php include_once ("../incluciones/navegadorAdmin.php"); ?>
    <!-- jumbotron -->
    <div class="w3-container w3-padding-32  w3-blue-gray">
        <h1 class="w3-jumbo w3-margin-left">Cargar Proveedor</h1>
        <a href="" class="w3-btn w3-orange w3-hover-blue-gray w3-margin-left" ng-click="abrirCargaProveedor()"><span class="fa fa-plus"></span> Agregar Proveedor</a>
    </div>
    <!-- Formulario de carga -->
    <div class="w3-content" ng-show="divCargarProveedor">
        <div class="w3-card-4 w3-blue-gray">
            <header>
                <a href="" class="w3-button w3-right w3-margin" ng-click="cerrarCargaProveedor()"><span class="fa fa-remove"></span> </a>
                <h2 class="w3-margin-left">Introduzca los datos del proveedor</h2>
                
            </header>
            <div class="w3-container w3-center w3-white w3-padding" >
                <form action="" name="formProveedor" >
                    <div class="w3-row">
                        <div class="w3-content w3-padding">
                            <input type="text" class="w3-input w3-hover-orange" name="nombre"  ng-model="nombre" required>
                            <label for="">Nombre del proveedor</label>
                            <div  ng-show="formProveedor.nombre.$touched || formProveedor.$submitted">
                                <span class="w3-text-red" ng-show="formProveedor.nombre.$error.required">El campo es obligatorio.</span>
                            </div>
                        </div>
                    </div>
                    <div class="w3-row">
                        <div class="w3-content">
                            <div class="w3-content w3-col l4 w3-padding">
                                <input type="text" class="w3-input w3-hover-orange"  name="telefono" ng-model="telefono" required>
                                <label for="">Teléfono</label>
                                <div  ng-show="formProveedor.telefono.$touched || formProveedor.$submitted">
                                    <span class="w3-text-red" ng-show="formProveedor.telefono.$error.required">El campo es obligatorio.</span>
                                </div>
                            </div>
                            <div class="w3-content w3-col l8 w3-padding">
                                <input type="email" class="w3-input w3-hover-orange" name="email" id="email" ng-model="email" required="">
                                 <label for="">E-mail</label>
                                <div  ng-show="formProveedor.email.$touched || formProveedor.$submitted">
                                    <span class="w3-text-red" ng-show="formProveedor.email.$error.required || formProveedor.email.$error.email">El campo es obligatorio o se ingreso un email incorrecto.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w3-row">
                        <div class="w3-content">
                            <div class="w3-col l4 w3-padding">
                                <input type="text" class="w3-input w3-hover-orange" ng-model="direccion" name="direccion" required="">
                                <label for="">Dirección</label>
                                <div  ng-show="formProveedor.direccion.$touched || formProveedor.$submitted">
                                    <span class="w3-text-red" ng-show="formProveedor.direccion.$error.required">El campo es obligatorio.</span>
                                </div>
                            </div>
                            <div class="w3-col l3 w3-padding">
                                <input type="number" class="w3-input w3-hover-orange" min=0 ng-model="codigoPostal" name="codigoPostal" required>
                                <label for="">Código Postal</label>
                                <div  ng-show="formProveedor.codigoPostal.$touched || formProveedor.$submitted">
                                    <span class="w3-text-red" ng-show="formProveedor.codigoPostal.$error.required">El campo es obligatorio.</span>
                                </div>
                            </div>
                            <div class="w3-col l5 w3-padding">
                                <div ng-init="provinciasProveedores()">
                                    <label for="provincia">Provincia del proveedor:</label>
                                    <select class="w3-select w3-hover-orange" name="provinciaProveedor" id="provinciaProveedor" ng-model="provincia" ng-change="localidadesProveedores()" required="">
                                        <option value="">Seleccione una provincia</option>
                                        <option ng-repeat="provincia in provincias" value="{{provincia.id_provincia}}">{{provincia.provincia}}</option>
                                    </select>
                                    <div  ng-show="formProveedor.provincia.$touched || formProveedor.$submitted">
                                        <span class="w3-text-red" ng-show="formProveedor.provincia.$error.required">El campo es obligatorio.</span>
                                    </div>
                                </div>
                                <div>
                                    <label for="localidad">Localidad del proveedor:</label>
                                    <select class="w3-select w3-hover-orange" name="localidadProveedor" id="localidadProveedor" ng-model="localidad" required>
                                        <option value="">Seleccione una Localidad</option>
                                        <option ng-repeat="localidad in localidades" value="{{localidad.id_localidad}}">{{localidad.localidad}}</option>
                                    </select>
                                    <div  ng-show="formProveedor.localidad.$touched || formProveedor.$submitted">
                                        <span class="w3-text-red" ng-show="formProveedor.localidad.$error.required">El campo es obligatorio.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="w3-button w3-green" ng-click="persistirProveedor()" ng-disabled="formProveedor.$invalid" value="Guardar">
                </form>
            </div>
        </div>
    </div>
    <!-- FIN DE CARGA DE PROVEEDOR -->
    <br>
    <!-- VISUALIZACION DE LOS PROVEEDORES -->
    <div class="w3-container w3-card-4 w3-padding w3-margin w3-white">
        
        <br>
        <div class="w3-row" ng-init="listarProveedores()">
            <!-- TABLA DE PROVEEDORES -->
            <div ng-show="proveedores">
                <table class="w3-table-all w3-hoverable">
                    <thead >
                        <tr class="w3-green">
                            <th>id</th>
                            <th>Nombre del proveedor</th>
                            <th>Email</th>
                            <th>tel.</th>
                            <th>Dirección</th>
                            <th>Localidad</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="proveedor in proveedores">
                            <td> {{proveedor.id}} </td>
                            <td>{{proveedor.nombre}}</td>
                            <td>{{proveedor.email}}</td>
                            <td>{{proveedor.telefono}}</td>
                            <td>{{proveedor.direccion}}</td>
                            <td>{{proveedor.localidad}}</td>
                            <td><a href="../vistas/editar-proveedor.php?var={{proveedor.id}}" class="w3-button w3-teal w3-hover-orange " >Editar</a> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div ng-hide="proveedores">
                <span class="w3-hover-red">No se cargaron los proveedores o no hay ninguno registrado</span>
            </div>

        </div>
    </div>
</body>
