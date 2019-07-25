<?php 

include_once ('incluciones/verificacionUsuario.php');
?>
<!DOCTYPE html>
<html lang="es" >

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage - MODPC</title>

    <!-- Bootstrap Core CSS -->
    <link href="librerias/template/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="librerias/template/css/shop-homepage.css" rel="stylesheet">

    <!-- Angular JS -->
    <script type="text/javascript" src="librerias/angularjs/angular.min.js"></script>
    <script type="text/javascript" src="js/indexModulo.js"></script>
    <script type="text/javascript" src="js/indexController.js"></script>

    <!-- AngularVideo directive -->
    <script type="text/javascript" src="librerias/angular-video/anguvideo.js"></script>
    <script type="text/javascript" src="librerias/angular-video/controller.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body ng-app="index" ng-controller="indexController">
    <!-- Navigation -->
    <?php include_once('incluciones/navbarIndex.php'); ?>
    <!-- FIN NAVBAR -->
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <p class="lead">Categorias:</p>
                <div class="list-group" ng-init="listarCategorias()">
                    <a ng-repeat="categoria in categorias" href="vistas/categoria.php?id={{categoria.id}}" class="list-group-item" >{{categoria.descripcion}}</a>

                </div>
            </div>

            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="row" ng-init="listarproductosDestacados(); cargarMoneda()">
                    <!-- LISTA DE PRODUCTOS DESTACADOS - MAX 6 -->
                    <div class="col-sm-4 col-lg-4 col-md-4" ng-repeat="producto in productos">
                    <div class="thumbnail">
                        <a href="" data-toggle="modal" data-target="#id{{producto.id}}" ng-click="cargarFichaTecnica(producto.idCategoria)">
                            <img src="resourses/imagen_producto/{{producto.imagen}}" class="foto320x150" alt="imagen-{{producto.modelo}}" ng-hide="producto.imagen == '<--NoFoto-->'" >
                            <img src="http://placehold.it/320x150" alt="" class="foto320x150" ng-show="producto.imagen == '<--NoFoto-->'">
                        </a>
                        <div class="caption">
                            <h4 class="pull-right">{{producto.precio * moneda.valor | currency}}</h4>
                            <p ng-show="producto.nuevo">Nuevo</p>
                            <p ng-hide="producto.nuevo">Usado</p>
                            <h4>
                                <a href="" data-toggle="modal" data-target="#id{{producto.id}}" ng-click="cargarFichaTecnica(producto.idCategoria)">{{producto.descripcion}}</a>
                            </h4>

                            <p>{{producto.modelo}}</p>
                            <p>Marca: {{producto.marca}}</p>
                        </div>
                        <div class="ratings">
                            <!-- <p class="pull-right">{{producto.valoracion}} <i class="glyphicon glyphicon-star"></i> </p><--></-->
                            <p>A {{producto.valoracion}} personas les gust&oacute; este producto.</p>
                        </div>
                    </div>



                    <!-- Modal para previzualizar productos -->
                    <div id="id{{producto.id}}" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h2 class="modal-title">{{producto.descripcion}} <small>{{producto.modelo}}</small></h2>
                                    <h1 class="modal-title"></h1>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="thumbnail">
                                                <img src="resourses/imagen_producto/{{producto.imagen}}" alt="{{producto.modelo}}" class="img-responsive foto640x300" ng-hide="producto.imagen == '<--NoFoto-->'">
                                                <img src="http://placehold.it/320x150" alt="{{producto.imagen}}" ng-show="producto.imagen == '<--NoFoto-->'">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h3 class="">Precio: <strong>{{producto.precio * moneda.valor | currency}}</strong></h3>
                                            <p>marca: <strong>{{producto.marca}}</strong></p>
                                            <p ng-show="producto.nuevo"><strong>Nuevo</strong></p>
                                            <p ng-hide="producto.nuevo"><strong>Usado</strong></p>
                                            <p>C&oacute;digo SKU: <strong>{{producto.sku}}</strong></p>
                                            <p>Meses de garant&iacute;a: <strong>{{producto.mesesGarantia}}</strong></p>
                                            <div>
                                                <div>
                                                    <div class="btn" name="bajarCantidad" ng-click="restarCantidad()"><span class="glyphicon glyphicon-minus"></span></div>
                                                    <input value="1" name="cantidad" ng-model="cantidad" />
                                                    <div class="btn" name="subirCantidad" ng-click="sumarCantidad()"><span class="glyphicon glyphicon-plus"></span></div>
                                                </div>
                                                <button class="btn btn-warning btn-lg btn-block" ng-disabled="<?= $id ?> == 0" ng-click="agregarAlCarrito(<?= $id ?>, producto.id, cantidad)">Agregar al carrito</button>
                                                <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Se requiere iniciar sesión para esta función."></span>
                                                <button class="btn btn-primary btn-lg btn-block" ng-click="enviarPregunta(<?= $id ?>, producto.id)"><i class="fa fa-send"></i> Preguntar al vendedor</button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="content">
                                        <ul class="nav nav-tabs dtabs-justified">
                                        <ul class="nav nav-tabs nav-justified">
                                            <li class="active"><a data-toggle="tab" href="#ficha{{producto.id}}" >Ficha T&eacute;cnica</a></li>
                                            <li><a  data-toggle="tab" href="#video{{producto.id}}" >Video</a></li>
                                            <li><a  data-toggle="tab" href="#pregunta{{producto.id}}" ng-click="listarPreguntas(producto.id)">Preguntas</a></li>
                                        </ul>
                                        <div class="tab-content" >
                                            <div class="tab-pane fade in active" id="ficha{{producto.id}}" role="tabpanel">
                                                <div class="col-md-6">
                                                    <table class="table table-striped table-hover">
                                                        <tr ng-show="ficha.campo01 != 0">
                                                            <td>{{ficha.campo01}}</td>
                                                            <td>{{producto.campo01}}</td>
                                                        </tr>
                                                        <tr ng-show="ficha.campo03 != 0">
                                                            <td>{{ficha.campo03}}</td>
                                                            <td>{{producto.campo03}}</td>
                                                        </tr>
                                                        <tr ng-show="ficha.campo05 != 0">
                                                            <td>{{ficha.campo05}}</td>
                                                            <td>{{producto.campo05}}</td>
                                                        </tr>
                                                        <tr ng-show="ficha.campo07 != 0">
                                                            <td>{{ficha.campo07}}</td>
                                                            <td>{{producto.campo07}}</td>
                                                        </tr>
                                                        <tr ng-show="ficha.campo09 != 0">
                                                            <td>{{ficha.campo09}}</td>
                                                            <td>{{producto.campo09}}</td>
                                                        </tr>
                                                        <tr ng-show="ficha.campo11 != 0">
                                                            <td>{{ficha.campo11}}</td>
                                                            <td>{{producto.campo11}}</td>
                                                        </tr>
                                                        <tr ng-show="ficha.campo13 != 0">
                                                            <td>{{ficha.campo13}}</td>
                                                            <td>{{producto.campo13}}</td>
                                                        </tr>
                                                        <tr ng-show="ficha.campo15 != 0">
                                                            <td>{{ficha.campo15}}</td>
                                                            <td>{{producto.campo15}}</td>
                                                        </tr>
                                                        <tr ng-show="ficha.campo17 != 0">
                                                            <td>{{ficha.campo17}}</td>
                                                            <td>{{producto.campo17}}</td>
                                                        </tr>
                                                        <tr ng-show="ficha.campo19 != 0">
                                                            <td>{{ficha.campo19}}</td>
                                                            <td>{{producto.campo19 }}</td>
                                                        </tr>

                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table table-striped table-hover">
                                                        <tr ng-show="ficha.campo02 != 0">
                                                            <td>{{ficha.campo02}}</td>
                                                            <td>{{producto.campo02}}</td>
                                                        </tr>
                                                        <tr ng-show="ficha.campo04 != 0">
                                                            <td>{{ficha.campo04}}</td>
                                                            <td>{{producto.campo04}}</td>
                                                        </tr>
                                                        <tr ng-show="ficha.campo06 != 0">
                                                            <td>{{ficha.campo06}}</td>
                                                            <td>{{producto.campo06}}</td>
                                                        </tr>
                                                        <tr ng-show="ficha.campo08 != 0">
                                                            <td>{{ficha.campo08}}</td>
                                                            <td>{{producto.campo08}}</td>
                                                        </tr>
                                                        <tr ng-show="ficha.campo10 != 0">
                                                            <td>{{ficha.campo10}}</td>
                                                            <td>{{producto.campo10}}</td>
                                                        </tr>
                                                        <tr ng-show="ficha.campo12 != 0">
                                                            <td>{{ficha.campo12}}</td>
                                                            <td>{{producto.campo12}}</td>
                                                        </tr>
                                                        <tr ng-show="ficha.campo14 != 0">
                                                            <td>{{ficha.campo14}}</td>
                                                            <td>{{producto.campo14}}</td>
                                                        </tr>
                                                        <tr ng-show="ficha.campo16 != 0">
                                                            <td>{{ficha.campo16}}</td>
                                                            <td>{{producto.campo16}}</td>
                                                        </tr>
                                                        <tr ng-show="ficha.campo18 != 0">
                                                            <td>{{ficha.campo18}}</td>
                                                            <td>{{producto.campo18}}</td>
                                                        </tr>
                                                        <tr ng-show="ficha.campo20 != 0">
                                                            <td>{{ficha.campo20}}</td>
                                                            <td>{{producto.campo20 }}</td>
                                                        </tr>

                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="video{{producto.id}}" role="tabpanel">
                                                <div class="content embed-responsive embed-responsive-16by9" ng-show="{{producto.video != ''}}">
                                                    <anguvideo  ng-model="producto.video" width="100%" height="100%"></anguvideo>
                                                </div>
                                                <div ng-hide="{{producto.video != ''}}">
                                                    <br>
                                                    <p class="text-center">Este producto no cuenta con un video asignado.</p>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pregunta{{producto.id}}" role="tabpanel">
                                                <br>
                                                <br>
                                                <div>
                                                    <!-- Aca van las iteraciones con las preguntas y respuestas -->
                                                   <div class="panel panel-info" ng-repeat="preg in preguntas">
                                                     <div class="panel-body">{{preg.pregunta}} - ({{preg.fecha}})</div>
                                                     <div class="panel-footer" ng-show="preg.respuesta">
                                                         {{preg.respuesta}} - ({{preg.fechaRespuesta}})
                                                      </div>
                                                   </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- Fin del modal -->
                </div>

                    

                    
                    <!-- FIN LISTA PRODUCTOS DESTACADOS -->
                </div>

            </div>

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
    <script src="librerias/template/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="librerias/template/js/bootstrap.min.js"></script>
    
    <!-- Bootbox js -->
    <script type="text/javascript" src="librerias/bootbox/bootbox.min.js"></script>
    
      <!-- modal de contacto -->
    <?php include_once('incluciones/formularioContacto.php'); ?>
    <script src="librerias/formulario_contacto/jqBootstrapValidation.js"></script>
    <script src="librerias/formulario_contacto/contact_me_index.js"></script>

</body>

</html>
