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
    <script type="text/javascript" src="../js/adminMarcaController.js"></script>
    <title>Marcas</title>
</head>
<body ng-app="admin" class="w3-light-gray" ng-controller="adminMarca">
    <div class="w3-row">
        <?php include_once('../incluciones/navegadorAdmin.php');  ?>
    </div>
    <div class="w3-row">
        <div class=" w3-padding-32 w3-blue-gray">
            <h1 class="w3-jumbo w3-margin-left">Cargar Marca</h1>
            <a href="" class="w3-btn w3-orange w3-hover-blue-gray w3-margin-left" ng-click="abrirCargaMarca()"><span class="fa fa-plus"></span> Agregar Marca</a>
        </div>
    </div>
    <div class="w3-row" ng-show="divCargaMarca">
        <div class="w3-content w3-white">
            <div class="w3-card-4 w3-blue-gray">
                <header>
                    <a href="" class="w3-button w3-right w3-margin" ng-click="cerrarCargaMarca()"><span class="fa fa-remove"></span> </a>
                    <h2 class="w3-margin-left">Nueva Marca</h2>
                </header>
                <div class="w3-white">
                    <!-- FORMULARIO PARA AGREGAR MARCAS -->
                    <form name="formularioMarca">
                        <div class="w3-padding">
                            <input type="text" class="w3-input w3-hover-orange" name="descripcion" placeholder="Introduce el nombre de la nueva marca" ng-model="descripcion" ng-model-option="{updateOn: 'blur'} " required >
                            <label for="">Descripción</label>
                            <div  ng-show="formularioMarca.$submitted || formularioMarca.descripcion.$touched">
                                <span class="w3-red" ng-show="formularioMarca.descripcion.$error.required">El campo es obligatorio.</span>
                            </div>
                        </div>

                        <div class="w3-panel">
                            <input type="submit" class="w3-btn w3-green w3-right w3-padding w3-margin-bottom" value="Guardar Marca" ng-click="guardarMarca()" ng-disabled="formularioMarca.$invalid">
                        </div>
                    </form>
                    <!-- FIN DE FORMULARIO -->
                </div>
            </div>
        </div>
    </div>
    <div class="w3-row">
        <div class="w3-container w3-white w3-margin" >
            <div class="w3-card-4 " ng-init="listarMarcas()">
                
                <div class="w3-margin">
                    <!-- TABLA QUE LISTA LAS MARCAS ALMACENADAS -->
                    <table class="w3-table w3-striped w3-bordered w3-hoverable">
                        <thead>
                            <tr class="w3-green">
                                <th>Nombre</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="marca in marcas">
                                <td>{{marca.descripcion}}</td>
                                <td><a href="editar-marca.php?var={{marca.id}}" class="w3-btn w3-blue">Editar</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
