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
    <script type="text/javascript" src="../js/adminPreguntaController.js"></script>
    <title>Preguntas</title>
</head>
<body ng-app="admin" class="w3-light-gray" ng-controller="adminPregunta">
    <div class="w3-row">
        <?php include_once('../incluciones/navegadorAdmin.php');  ?>
    </div>
    <div class="w3-row">
        <div class=" w3-padding-32 w3-blue-gray">
            <h1 class="w3-jumbo w3-margin-left">Preguntas</h1>
        </div>
    </div>

    <div class="w3-content" ng-model="divRespuesta" ng-show="divRespuesta">
        <div class="w3-container">
            <div class="w3-card-4 w3-col l5 w3-display-middle w3-purple">
                <header class="w3-orange">
                    <button class="w3-button w3-right w3-orange w3-hover-blue-gray" ng-click="cerrarRespuestaForm()"><i class="fa fa-close "></i></button>
                    <h2 class="w3-margin-left">Responder pregunta</h2>
                </header>
                <div>
                    <form class="w3-container" name="respuestaForm">
                        <p>Id de pregunta: {{idPregunta}}</p>
                        <p>
                        <label for="">Respuesta:</label>
                        <input type="text" class="w3-input" name="respuesta" ng-model="respuesta" placeholder="Ingrese su respuesta" required="required" autofocus></p>
                        <input type="hidden" name="idPregunta" ng-model="idPregunta">
                        <button class="w3-btn w3-green w3-right" ng-click="enviarRespuesta()" ng-disabled="respuestaForm.$invalid">
                            <span class="fa fa-send-o"></span>&nbsp;Enviar respuesta
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="w3-row">
        <div class="w3-content w3-white" ng-init="listarPreguntasSinRespuesta()">
            <div class="w3-card-4 ">
                <header class="w3-blue-gray">
                    <h2 class="w3-margin-left">Preguntas sin respuesta <span></span></h2>
                </header>
                <div class="w3-white">
                    <table class="w3-table w3-striped w3-bordered w3-hoverable">
                        <thead class="w3-green">
                            <tr>
                                <th>Producto Id</th>
                                <th>Fecha</th>
                                <th>Pregunta</th>
                                <th>Usuario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="pregunta in preguntasSinRespuestas track by $index">
                                <td>{{pregunta.idProducto}}</td>
                                <td>{{pregunta.fechaPregunta}}</td>
                                <td>{{pregunta.pregunta}}</td>
                                <td>{{pregunta.usuario}}</td>
                                <td><button class="w3-btn w3-deep-purple" ng-click="responderPregunta(pregunta.idPregunta)">Responder</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="" class="w3-btn w3-green w3-round w3-right w3-margin-right" ng-show="preguntasSinRespuestas.length == 15" ng-click="traerMasPreguntasSinRespuesta()">Ver m&aacute;s</a>
                    <br><br>
                </div>
            </div>
        </div>
    
        <div class="w3-content w3-white" ng-init="listarPreguntasConRespuesta()">
            <div class="w3-card-4 w3-margin-top">
                <header class="w3-blue-gray">
                    <h2 class="w3-margin-left">Preguntas Respondidas</h2>
                    <a href="" class="w3-btn w3-round w3-orange w3-hover-blue-gray w3-margin-left w3-margin-bottom"><span class="fa fa-filter"></span>Aplicar Filtros</a>
                </header>
                <div>
                    <table class="w3-table w3-stripped w3-bordered w3-hovarable w3-light-gray">
                        <thaed>
                            <tr>
                                <th>Producto Id</th>
                                <th>Fecha de pregunta</th>
                                <th>Pregunta</th>
                                <th>Fecha de respuesta</th>
                                <th>Respuesta</th>
                                <th>Usuario</th>
                            </tr>
                        </thaed>
                        <tbody>
                            <tr ng-repeat="preguntaConRespuesta in preguntasConRespuestas">
                                <td>{{preguntaConRespuesta.idProducto}}</td>
                                <td>{{preguntaConRespuesta.fechaPregunta}}</td>
                                <td>{{preguntaConRespuesta.pregunta}}</td>
                                <td>{{preguntaConRespuesta.fechaRespuesta}}</td>
                                <td>{{preguntaConRespuesta.respuesta}}</td>
                                <td>{{preguntaConRespuesta.usuario}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <footer>paginacion</footer>
            </div>
        </div>
    </div>

</body>
</html>
