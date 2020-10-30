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
                <div class="w3-container  w3-white w3-round "  ng-init="cargarEditor()">
                    <form>
                        <br>
                        <div class="">
                            <label>Destinatario/s</label>
                            <input 	type="text" class="w3-input" name="destino" ng-model="destino" placeholder="todos@domain.com" disabled>
                        </div>
                        <div class="">
                            <label>Asunto</label>
                            <input 	type="text" class="w3-input" name="asunto" ng-model="asunto" placeholder="detalla el asunto" >
                        </div>
                        <br>
                        <div>
                            <label for="">Mensaje</label>
                            <textarea class="w3-input" name="mensaje" id="mensajeNotificaciones" cols="30" rows="10" placeholder="Mensaje"></textarea>
                        </div>
                        
                        <br>
                        <input type="button" class="w3-right w3-btn w3-white w3-border w3-border-green w3-round w3-margin-bottom" value="Enviar" ng-click="enviarMail()">
                        <br>
                        <br>
                    </form>
                </div>
            </div>
            <div class="w3-container w3-padding-16 w3-col s12 l6">
                <div class="w3-container  w3-white w3-round"  >
                    <h1>Hola Mundo</h1>
                    <h1>Hola Mundo</h1>
                    <h1>Hola Mundo</h1>
                    <div  ng-bind-html="mensajeEnviado"></div>
                    <div>{{mensajeControl}}</div>

                </div>
            </div>
        </div>
        
    </div>

</body>
</html>
