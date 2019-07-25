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
    <script type="text/javascript" src="../js/adminCategoriaController.js"></script>
    <title>Categorias</title>
</head>
<body ng-app="admin" class="w3-light-gray" ng-controller="adminCategoriaController">
    <div class="w3-row">
        <?php include_once('../incluciones/navegadorAdmin.php');  ?>
    </div>
    <div class="w3-row">
        <div class=" w3-padding-32 w3-blue-gray">
            <h1 class="w3-jumbo w3-margin-left">Cargar categoria</h1>
            <a href="" class="w3-btn w3-orange w3-hover-blue-gray w3-margin-left" ng-click="abrirCargaCategoria()"><span class="fa fa-plus"></span> Agregar Categoria</a>
        </div>
    </div>
    <div class="w3-row">
        <div class="w3-content w3-white" ng-show="divFormularioCategoria">
            <div class="w3-card-4 w3-blue-gray">
                <header>
                    <a href="" class="w3-button w3-right w3-margin" ng-click="cerrarCargaCategoria()"><span class="fa fa-remove"></span> </a>
                    <h2 class="w3-margin-left">Nueva categoria</h2>
                     
                </header>
                <div class="w3-white">

                    <form name="categoriaForm">
                        <div class="w3-padding">
                            <input type="text" class="w3-input w3-hover-orange" id="descripcion" name="descripcion" placeholder="Introduce el nombre de la nueva categoria" ng-model="descripcion" required="" >
                            <div ng-show="categoriaForm.$submitted || categoriaForm.descripcion.$touched">
							    <span class="w3-red" ng-show="categoriaForm.descripcion.$error.required">El campo es obligatorio.</span>
		      			    </div>
                            <label for="">Descripción</label>
                        </div>
                        <div class="w3-panel">
                            <div class="w3-row">
                                <a href="javascript:void(0)" onclick="openTab(event, 'fichasCargadas');">
                                    <div class="w3-half tablink w3-bottombar w3-hover-light-grey w3-padding w3-center">Seleccionar ficha técnica</div>
                                </a>
                                <a href="javascript:void(0)" onclick="openTab(event, 'nuevaFicha');">
                                    <div class="w3-half tablink w3-bottombar w3-hover-light-grey w3-padding w3-center">Agregar ficha técnica</div>
                                </a>
                            </div>
                            <div id="fichasCargadas" class="w3-container w3-padding productos w3-center" style="display: none" ng-init="cargarFichasTecnicas()">
                                <select name="fichaTecnica" id="fichaTecnica" class="w3-select" ng-model="fichaTecnica" required="">
                                    <option value="" disabled selected>Seleccione una ficha técnica</option>
                                    <option ng-repeat="ficha in fichas" value="{{ficha.id}}">{{ficha.nombreFicha}}</option>
                                </select>
                            </div>
                            <div id="nuevaFicha" class="w3-container w3-padding productos w3-center" style="display: none">
                                <a href="cargar-fichatecnica.php" class="w3-btn w3-blue-gray " >Nueva ficha técnica</a>
                            </div>
                        </div>
                        <div class="w3-panel">
                            <input type="submit" class="w3-btn w3-green w3-right w3-padding w3-margin-bottom" value="Guardar categoria" ng-disabled="categoriaForm.$invalid" ng-click="guardarCategoria()">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div ng-show="divEditarCategoria" class="w3-content w3-white">
            <div class="w3-card-4 w3-orange">
                <header>
                    <a href="" class="w3-btn w3-right w3-margin" ng-click="cerrarEditarCategoria()"><span class="fa fa-remove"></span> </a>
                    <h2>Editar nombre de categoria</h2>
                </header>
                <div class="w3-white w3-padding">
                    <form name="categoriaEditarForm">
                        <input type="text" class="w3-input w3-hover-orange" id="nombreAEditar" name="nombreAEditar" ng-model="NombreAEditar">
                        <label for="nombreAEditar">Nuevo Nombre</label>
                        <div class="w3-panel">
                            <input type="submit" class="w3-btn w3-green w3-right w3-padding w3-margin-bottom" value="Editar categoria"  ng-click="guardarEditarCategoria()">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- TABLA DE CATEGORIAS -->
        <br>
        <div class="w3-container" ng-init="listarCategorias()">
            <table class="w3-table w3-striped w3-bordered w3-hoverable">
                <thead>
                    <tr class="w3-green">
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Ficha Tecnica</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="categoria in categorias">
                        <td>{{categoria.id}}</td>
                        <td>{{categoria.descripcion}}</td>
                        <td>{{categoria.fichaTecnica}}</td>
                        <td>
                            <a class="w3-btn w3-blue" ng-click="editarCategoria(categoria)">Editar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- PAGINACION -->
            <div></div>
        </div>
    </div>

</body>
</html>
