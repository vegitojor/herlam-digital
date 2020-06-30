<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 28/09/17
 * Time: 20:55
 */

include_once ('../incluciones/verificacionAdmin.php');

$id = $_GET['var'];

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
            <h1 class="w3-jumbo w3-margin-left">Editar Marca</h1>
        </div>
    </div>
    <div class="w3-row">
        <div class="w3-content w3-white">
            <div class="w3-card-4 w3-blue-gray">
                <header>
                    <a href="cargar-marca.php" class="w3-btn w3-red w3-right w3-margin">Volver</a>
                    <h2 class="w3-margin-left">Editar Marca</h2>

                </header>
                <div class="w3-white">
                    <!-- FORMULARIO PARA Editar MARCAS -->
                    <form name="formularioMarca" ng-init="traerMarca(<?= $id ?>)">
                        <div class="w3-padding">
                            <input type="hidden" ng-model="idEditar">
                            <input type="text" class="w3-input w3-hover-orange" name="descripcionEditar" placeholder="Introduce el nombre de la nueva marca" ng-model="descripcionEditar" ng-model-option="{updateOn: 'blur'} " required >
                            <label for="">Descripción</label>
                            <div  ng-show="formularioMarca.$submitted || formularioMarca.descripcion.$touched">
                                <span class="w3-red" ng-show="formularioMarca.descripcion.$error.required">El campo es obligatorio.</span>
                            </div>
                        </div>

                        <div class="w3-panel">
                            <input type="submit" class="w3-btn w3-green w3-right w3-padding w3-margin-bottom" value="Editar Marca" ng-click="editarMarca()" ng-disabled="formularioMarca.$invalid">
                        </div>
                    </form>
                    <!-- FIN DE FORMULARIO -->
                </div>
            </div>
        </div>
    </div>

</body>
</html>
