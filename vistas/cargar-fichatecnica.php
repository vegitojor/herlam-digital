<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 28/09/17
 * Time: 23:58
 */
include_once ('../incluciones/verificacionAdmin.php');
?>

<!DOCTYPE html>
<html>
<head>
    <?php include_once ('../incluciones/headAdmin.php'); ?>
    <!-- Modulo Angular -->
    <script type="text/javascript" src="../js/adminModule.js"></script>
    <!-- Controller Angular -->
    <script type="text/javascript" src="../js/adminFichaTecnicaController.js"></script>

    <title>Ficha Técnica</title>
</head>
<body ng-app="admin" ng-controller="formularioFichaTecnica" class="w3-light-gray">
    <div class="w3-row">
        <?php include_once('../incluciones/navegadorAdmin.php'); ?>
    </div>
    <div class="w3-row">
        <div class="w3-padding-32 w3-blue-gray">
            <h1 class="w3-jumbo w3-margin-left">Ficha técnica</h1>

        </div>
    </div>
    <div class="w3-row">
        <div class="w3-content w3-blue-gray w3-card-4 " >
            <header>
                <a href="cargar-categoria.php" class="w3-btn w3-red w3-right  w3-margin">Volver</a>
                <h2 class="w3-margin-left">Introducir los items de la ficha técnica </h2>

            </header>
            <div class="w3-container w3-white w3-center">
                <form name="formularioFichaTecnica" >
                    <label for="">Nombre de la ficha</label>
                    <input type="text" class="w3-input w3-hover-orange w3-margin-bottom" name="nombre" placeholder="Introduzca el nombre de la ficha técnica" ng-model="nombreFicha"  required>
                    <label for="">Campo 1:</label>
                    <input type="text" class="w3-input" placeholder="Introduzca el item para la ficha técnica." name="campo01" ng-model="campo01" required>
                    <label for="">Campo 2:</label>
                    <input type="text" class="w3-input w3-border" name="campo02" ng-model="campo02" value="-">
                    <label for="">Campo 3:</label>
                    <input type="text" class="w3-input w3-border" name="campo03" ng-model="campo03" value="-">
                    <label for="">Campo 4:</label>
                    <input type="text" class="w3-input w3-border" name="campo04" ng-model="campo04" value="-">
                    <label for="">Campo 5:</label>
                    <input type="text" class="w3-input w3-border" name="campo05" ng-model="campo05" value="-">
                    <label for="">Campo 6:</label>
                    <input type="text" class="w3-input w3-border" name="campo06" ng-model="campo06" value="-">
                    <label for="">Campo 7:</label>
                    <input type="text" class="w3-input w3-border" name="campo07" ng-model="campo07" value="-">
                    <label for="">Campo 8:</label>
                    <input type="text" class="w3-input w3-border" name="campo08" ng-model="campo08" value="-">
                    <label for="">Campo 9:</label>
                    <input type="text" class="w3-input w3-border" name="campo09" ng-model="campo09" value="-">
                    <label for="">Campo 10:</label>
                    <input type="text" class="w3-input w3-border" name="campo10" ng-model="campo10" value="-">
                    <label for="">Campo 11:</label>
                    <input type="text" class="w3-input w3-border" name="campo11" ng-model="campo11" value="-">
                    <label for="">Campo 12:</label>
                    <input type="text" class="w3-input w3-border" name="campo12"ng-model="campo12" value="-">
                    <label for="">Campo 13:</label>
                    <input type="text" class="w3-input w3-border" name="campo13" ng-model="campo13" value="-">
                    <label for="">Campo 14:</label>
                    <input type="text" class="w3-input w3-border" name="campo14" ng-model="campo14" value="-">
                    <label for="">Campo 15:</label>
                    <input type="text" class="w3-input w3-border" name="campo15" ng-model="campo15" value="-">
                    <label for="">Campo 16:</label>
                    <input type="text" class="w3-input w3-border" name="campo16" ng-model="campo16" value="-">
                    <label for="">Campo 17:</label>
                    <input type="text" class="w3-input w3-border" name="campo17" ng-model="campo17" value="-">
                    <label for="">Campo 18:</label>
                    <input type="text" class="w3-input w3-border" name="campo18" ng-model="campo18" value="-">
                    <label for="">Campo 19:</label>
                    <input type="text" class="w3-input w3-border" name="campo19" ng-model="campo19" value="-">
                    <label for="">Campo 20:</label>
                    <input type="text" class="w3-input w3-border" name="campo20" ng-model="campo20" value="-">
                    <br>
                    <input type="submit" class="w3-button w3-green w3-block w3-ripple" value="Guardar ficha" ng-disabled="formularioFichaTecnica.$invalid" ng-click="guardarFichaTecnica()"/>
                    <br>
                </form>
            </div>

        </div>
    </div>
    <br>
    <br>
</body>
</html>
