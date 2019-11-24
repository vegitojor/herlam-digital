<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../home.php"><span style="font-family:'arial';font-style: italic;font-weight: bold">herlam DIGITAL</span></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            <?php if($_SESSION['usuario']['supervisor']==0){ ?>
                <li >
                    <a href="nosotros.php">T&eacute;rminos y condiciones</a>
                </li>
                <!-- <li >
                    <a href="institucional.php">Institucional</a>
                </li> -->
                <li >
                    <a href="#" data-toggle="modal" data-target="#contactModal">Contacto</a>
                </li>
            <?php } ?>
            </ul>
            <ul class="nav navbar-nav pull-right " ng-hide="<?= $id ?>">

                <!-- <li >
                    <a href="registro-usuario.php">registrarse</a>
                </li>
                <li>
                    <a href="login.php">Ingresar</a>
                </li> -->
            </ul>
            <ul class="nav navbar-nav pull-right " ng-show="<?= $id ?>">
                <?php if($_SESSION['usuario']['supervisor']==0){ ?>
                    <li>
                        <a href="carrito.php" data-toggle="tooltip" data-placement="bottom" title="Carrito"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                    </li>
                <?php } ?>
                <li class="dropdown">
                    <a href="javascript:void();" id="usuario" data-toggle="dropdown"><?= $nombre ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="usuario">
                        <?php if($_SESSION['usuario']['supervisor']==0){ ?>
                            <li role="presentation"><a href="./pedido.php">Mis pedidos</a></li>
                        <?php } ?>
                        <li role="presentation"><a href="#" data-toggle="modal" data-target="#passModal">Cambiar contrase&ntilde;a</a></li>
                        <li role="presentation"><a href="../controladores/cerrarSesionController.php">Salir</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    
    <!-- /.container -->
</nav>

<?php 
    include_once('../incluciones/cambioPassModal.php');
    ?>