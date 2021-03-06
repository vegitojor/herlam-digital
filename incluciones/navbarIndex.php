<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><span style="font-family:'arial';font-style: italic;font-weight: bold">herlam DIGITAL</span></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li >
                        <a href="vistas/nosotros.php">T&eacute;rminos y condiciones</a>
                    </li>
                    <!-- <li >
                        <a href="vistas/institucional.php">Institucional</a>
                    </li> -->
                    <li >
                        <a href="#" data-toggle="modal" data-target="#contactModal">Contacto</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav pull-right " ng-hide="<?= $id ?>">

                    <li >
                        <a href="vistas/registro-usuario.php">registrarse</a>
                    </li>
                    <li>
                        <a href="vistas/login.php">Ingresar</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav pull-right " ng-show="<?= $id ?>">
                    <li>
                        <a href="vistas/carrito.php" data-toggle="tooltip" data-placement="bottom" title="Carrito"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                    </li>
                    <li class="dropdown">
                        <a href="" id="usuario" data-toggle="dropdown"><?= $nombre ?><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="usuario">
                            <li role="presentation"><a href="vistas/pedido.php">Mis pedidos</a></li>
                            <li role="presentation"><a href="#" data-toggle="modal" data-target="#passModal">Cambiar contrase&ntilde;a</a></li>
                            <li role="presentation"><a href="controladores/cerrarSesionController.php">Salir</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.container -->
    </nav>

    <?php 
    include_once('./incluciones/cambioPassModal.php');
    include_once('./incluciones/cargarCelularModal.php');
    ?>