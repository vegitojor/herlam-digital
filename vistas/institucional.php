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

    <title>Institucional - MODPC</title>

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
                    <h1>Misión, Visión y Valores</h1>
                </div>
                
                <div class="col-lg-10 col-lg-offset-1">
                    <h2>Misión</h2>
                    <p>Ofrecer al cliente el mejor servicio y variedad, calidad y valor de productos.</p>
                    <p>Crear valor y marcar la diferencia.</p>
                    <h2>Visión</h2>
                    <dl class="dl-horizontal">
                        <dt>Socios</dt>
                        <dd>Desarrollar una red de trabajo para crear un valor común y duradero.</dd>
                        <dt>Productividad</dt>
                        <dd>Ser una organización eficaz y dinámica.</dd>
                    </dl>
                    <h2>Valores</h2>
                    <dl class="dl-horizontal">
                            <dt>Liderazgo</dt> 
                            <dd>Esforzarse en dar forma a un futuro mejor.</dd>
                            <dt>Colaboración</dt> 
                            <dd>Potenciar el talento colectivo.</dd>
                            <dt>Integridad</dt> 
                            <dd>Ser transparentes.</dd>
                            <dt>Rendir cuentas</dt> 
                            <dd>Ser responsables.</dd>
                            <dt>Pasión</dt>
                            <dd>Estar comprometidos con el corazón y con la mente.</dd>
                            <dt>Calidad</dt>
                            <dd>Búsqueda de la excelencia.</dd>
                    </dl>
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