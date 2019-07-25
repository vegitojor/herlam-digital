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
    <script type="text/javascript" src="../js/adminMonedaController.js"></script>
    <title>Monedas</title>
</head>

<body ng-app="admin" class="w3-light-gray" ng-controller="adminMoneda">
    <div class="w3-row">
        <?php include_once('../incluciones/navegadorAdmin.php');  ?>
    </div>
    <div class="w3-row">
        <div class=" w3-padding-32 w3-blue-gray">

            <h1 class="w3-jumbo w3-margin-left">Cargar Moneda</h1>
            <a href="" class="w3-btn w3-orange w3-hover-blue-gray w3-margin-left" ng-click="abrirCargaMoneda()"><span class="fa fa-plus"></span> Agregar Moneda</a>
        </div>
    </div>
    <div class="w3-row">
        <!-- FORMULARIO DE CARGA -->
        <div class="w3-content w3-white" ng-show="divCargarMoneda">
            <div class="w3-card-4 w3-blue-gray">
                <header>
                    <a href="" class="w3-button w3-right w3-margin" ng-click="cerrarCargaMoneda()"><span class="fa fa-remove"></span> </a>
                    <h2 class="w3-margin-left">Nueva Moneda</h2>
                </header>
                <div class="w3-white">
                    <!-- FORMULARIO PARA AGREGAR MONEDAS-->
                    <form name="formularioMoneda">
                        <div class="w3-padding">
                            <input type="text" class="w3-input w3-hover-orange" min=0 name="descripcion" placeholder="Introduce el nombre de la nueva moneda" ng-model="descripcion" ng-model-option="{updateOn: 'blur'} " required >
                            <label for="">Descripción</label>
                            <div  ng-show="formularioMoneda.$submitted || formularioMoneda.descripcion.$touched">
                                <span class="w3-red" ng-show="formularioMoneda.descripcion.$error.required">El campo es obligatorio.</span>
                            </div>

                            <input type="number" class="w3-input w3-hover-orange" name="valor" step="any" placeholder="Introduce el valor de la nueva moneda" ng-model="valor" ng-model-option="{updateOn: 'blur'} " required >
                            <label for="">Valor (en pesos argentinos)</label>
                            <div  ng-show="formularioMoneda.$submitted || formularioMoneda.valor.$touched">
                                <span class="w3-red" ng-show="formularioMoneda.valor.$error.required">El campo es obligatorio.</span>
                            </div>
                            <br>
                            <input type="checkbox" class="w3-check w3-hover-orange" name="activo"  ng-model="activo" ng-model-option="{updateOn: 'blur'} " value="1">
                            <label for="">Activar moneda como predeterminada</label>
                            
                        </div>

                        <div class="w3-panel">
                            <input type="submit" class="w3-btn w3-green w3-right w3-padding w3-margin-bottom" value="Guardar Moneda" ng-click="guardarMoneda()" ng-disabled="formularioMoneda.$invalid">
                        </div>
                    </form>
                    <!-- FIN DE FORMULARIO -->
                </div>
            </div>
        </div>
        <!-- FIN FORMULARIO CARGA -->
    </div>
    <br>
    <div class="w3-row">
        <div class="w3-content w3-white">
            <div class="w3-card-4 " ng-init="listarMonedas()">
                
                <div ng-show="monedas">
                    <!-- TABLA QUE LISTA LAS MONEDAS ALMACENADAS -->
                    <table class="w3-table w3-striped w3-bordered w3-hoverable">
                        <thead>
                            <tr class="w3-green">
                                <th>Nombre</th>
                                <th>valor</th>
                                <th>Activo?</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="moneda in monedas">
                                <td>{{moneda.descripcion}}</td>
                                <td>${{moneda.valor}}</td>
                                <td ng-show="moneda.activo == 1">S&iacute;</td>
                                <td ng-hide="moneda.activo == 1">No</td>
                                <td>
                                    <a href="editar-moneda.php?var={{moneda.id}}" class="w3-btn w3-blue">Editar</a>
                                    <a href="" class="w3-btn w3-orange" ng-click="activarMoneda(moneda.id, 1)" ng-hide="moneda.activo == 1">Activar</a>
                                    <a href="" class="w3-btn w3-orange" ng-click="activarMoneda(moneda.id, 0)" ng-show="moneda.activo == 1">Desactivar</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
