<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 9/12/17
 * Time: 11:32
 */

include_once ('../incluciones/verificacionUsuario.php');

?>
<!DOCTYPE html>
<html lang="es" >

<head>
    <?php include_once ('../incluciones/head.php'); ?>
    <script type="text/javascript" src="../js/indexModulo.js"></script>
    <script type="text/javascript" src="../js/nosotrosController.js"></script>
    <!-- AngularVideo directive -->
    <script type="text/javascript" src="../librerias/angular-video/anguvideo.js"></script>
    <script type="text/javascript" src="../librerias/angular-video/controller.js"></script>

    <title>Nosotros - MODPC</title>

</head>

<body ng-app="index" ng-controller="nosotrosController">
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
                    <h1 >Sobre nosotros, ModPc</h1>
                </div>
                
                <div class="col-lg-10 col-lg-offset-1">
                    <h3>Quienes Somos</h3>
                    <br>
                    <p>Somos una empresa que no pertenece a ning&uacute;n grupo ni franquicia.</p>

                    <p>Juventud y experiencia unidas para ofrecer calidad en asesoramiento, servicio y cordialidad.</p>

                    <p>Hemos convertido nuestra pasión por la informática en nuestra profesión.</p>

                    <p>Sabemos que la tecnología avanza a un ritmo imparable y nosotros con ella, por ello nuestro personal está siempre al día con las últimas novedades.</p>

                    <p>Nuestra filosofía empresarial se basa en tres valores:</p>
                    <ul>
                        <li>
                            <h4>El cliente</h4>
                            <p>Nuestro activo más valioso.</p>
                        </li>
                        <li>
                            <h4>Primeras marcas</h4>
                            <p>Trabajando con los mejores fabricantes.</p>
                        </li>
                        <li>
                            <h4>Alta competitividad</h4>
                            <p>Ofreciendo una sinergía perfecta entre precio y calidad.</p>
                        </li>
                    </ul>
                    <p>Gracias a nuestra experiencia y nuestros conocimientos especializados, podemos garantizarle que en nuestra casa siempre dispondrá de lo último en productos informáticos además de un asesoramiento fiable competente.</p>
                    <br>
                    <p>Los esperamos.</p>
                    <h2>MODPC</h2>
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