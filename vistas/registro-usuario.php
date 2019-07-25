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
    <!-- modulo angular -->
    <script type="text/javascript" src="../js/registroUsuarioValidacion.js"></script>
    <!-- controlador angular -->
    <script type="text/javascript" src="../js/registroUsuarioValidacionController.js"></script>
    <!-- directiva angular -->
    <script type="text/javascript" src="../js/registroUsuarioValidacionDirective.js"></script>

    <!-- AngularVideo directive -->
    <!-- <script type="text/javascript" src="../librerias/angular-video/anguvideo.js"></script>
    <script type="text/javascript" src="../librerias/angular-video/controller.js"></script> -->

    <title>Registro de usuario - MODPC</title>

</head>

<body ng-app="registroUsuario" ng-controller="formularioRegistro">
<!-- Navigation -->
<?php include_once('../incluciones/navbarVistas.php'); ?>
<!-- FIN DEL NAV   -->

<!-- Page Content -->
<div class="container">

    <div class="row">
        <!-- ASIDE - COLUMNA LATERAL -->
        <div class="col-md-3"  >
            <div class="col-md-12" >
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
                <div class="jumbotron" >
                    <h1>Registro de usuario</h1>
                </div>
                
                <div class="col-lg-10 col-lg-offset-1">
                    <form name="registroUsuario" role="form" class="col-md-12" novalidate>
                        <!-- <div>
                            <label for=""></label>
                            <input type="text">
                        </div> -->
                        <!-- <div>
                            <label for="usuario">Ingrese su nombre de usuario</label>
                            <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" placeholder="Introduzca su usuario" ng-model="usuario" ng-model-options="{ updateOn: 'blur' }" required>
                            <div  ng-show="registroUsuario.nombreUsuario.$touched || registroUsuario.$submitted">
                                <span class="text-danger" ng-show="registroUsuario.nombreUsuario.$error.required">El campo es obligatorio.</span>
                            </div>
                        </div> -->             
                        <h3>Datos obligatorios</h3>     
                        <!-- preloader -->
                        <div id="preloader" ng-show="preloader">
                            <div class="sk-cube-grid">
                              <div class="sk-cube sk-cube1"></div>
                              <div class="sk-cube sk-cube2"></div>
                              <div class="sk-cube sk-cube3"></div>
                              <div class="sk-cube sk-cube4"></div>
                              <div class="sk-cube sk-cube5"></div>
                              <div class="sk-cube sk-cube6"></div>
                              <div class="sk-cube sk-cube7"></div>
                              <div class="sk-cube sk-cube8"></div>
                              <div class="sk-cube sk-cube9"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Ingrese su nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduzca su nombre" ng-model="nombre" ng-model-options="{ updateOn: 'blur' }" required>
                            <span ng-show="registroUsuario.$submitted || registroUsuario.nombre.$touched">
                                <span class="text-danger" ng-show="registroUsuario.nombre.$error.required">El campo es obligatorio.</span>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Ingrese su apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Introduzca su apellido" ng-model="apellido" ng-model-option="{updateOn: 'blur'}" required>
                            <div  ng-show="registroUsuario.$submitted || registroUsuario.apellido.$touched">
                                <span class="text-danger" ng-show="registroUsuario.apellido.$error.required">El campo es obligatorio.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Ingrese su e-mail</label>
                            <input type="email" class="form-control" id="emailForm" name="email" placeholder="Introduzca su e-mail" ng-model="email" ng-model-option="{updateOn: 'blur'} " required>
                            <div  ng-show="registroUsuario.$submitted || registroUsuario.email.$touched">
                                <span class="text-danger" ng-show="registroUsuario.email.$error.required || registroUsuario.email.$error.email">El campo es obligatorio o no se ingreso un mail válido.</span>                      
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pass">Ingrese su contraseña</label>
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Introduzca su contraseña" ng-model="pass" ng-model-option="{updateOn: 'blur'} " required>
                            <div  ng-show="registroUsuario.$submitted || registroUsuario.pass.$touched">
                                <span class="text-danger" ng-show="registroUsuario.pass.$error.required">El campo es obligatorio.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pass">Reingrese su contraseña</label>
                            <input type="password" class="form-control" id="passValid" name="passValid" placeholder="Reingrese su contraseña" ng-model="passValid" ng-model-option="{updateOn: 'blur'} " required pw-check="pass">
                            <div  ng-show="registroUsuario.$submitted || registroUsuario.pass.$touched">
                                <span class="text-danger" ng-show="registroUsuario.pass.$error.required">El campo es obligatorio.</span>
                                <span class="text-danger" ng-show="registroUsuario.passValid.$error.pwmatch">La contraseña no coincide.</span>
                            </div>
                        </div>
                        <hr>
                        <h3>Datos opcionales</h3>
                        <div class="form-group">
                            <label for="telefono">Ingrese su número telefónico</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Introduzca su teléfono" ng-model="telefono" ng-model-option="{updateOn: 'blur'}" >
                            <!-- <div  ng-show="registroUsuario.$submitted || registroUsuario.telefono.$touched">
                                <span class="text-danger" ng-show="registroUsuario.telefono.$error.required">El campo es obligatorio.</span>
                            </div> -->
                        </div>
                        <div class="form-group">
                            <label for="fechaNacimiento">Ingrese su fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" placeholder="Introduzca su fecha de nacimiento" ng-model="fechaNacimiento" ng-model-option="{updateOn: 'blur'}" >
                            <!-- <div  ng-show="registroUsuario.$submitted || registroUsuario.fechaNacimiento.$touched">
                                <span class="text-danger" ng-show="registroUsuario.fechaNacimiento.$error.required">El campo es obligatorio.</span>
                            </div> -->
                        </div>
                        <div class="form-group">
                            <label for="domicilio">Ingrese su domicilio</label>
                            <input type="text" class="form-control" id="domicilio" name="domicilio" placeholder="Introduzca su domicilio (calle y altura)" ng-model="direccion" ng-model-option="{updateOn: 'blur'} ">
                            <!-- <div  ng-show="registroUsuario.$submitted || registroUsuario.domicilio.$touched">
                                <span class="text-danger" ng-show="registroUsuario.domicilio.$error.required">El campo es obligatorio.</span>
                            </div> -->
                        </div>
                        <div class="form-group">
                            <label for="codPostal">Ingrese su código postal</label>
                            <input type="number" class="form-control" id="codPostal" name="codPostal" placeholder="Introduzca su código postal" ng-model="codPostal" ng-model-option="{updateOn: 'blur'} " >
                            <!-- <div  ng-show="registroUsuario.$submitted || registroUsuario.codPostal.$touched">
                                <span class="text-danger" ng-show="registroUsuario.codPostal.$error.required">El campo es obligatorio.</span>
                            </div> -->
                        </div>
                        <div class="form-group" ng-init="cargarProvincias()">
                            <label for="provincia">Seleccione su provincia</label>
                            <select class="form-control" name="provincia" ng-model="provincia" ng-change="cargarLocalidades()" >
                                <option value="">Seleccione una provincia</option>
                                <option ng-repeat="provincia in provincias" value={{provincia.id}}>{{provincia.nombre}}</option>
                            </select>
                        </div>
                        <div class="form-group" >
                            <label for="localidad">Seleccione su localidad</label>
                            <select class="form-control" name="localidad" ng-model="localidad" >
                                <option value="">Seleccione una localidad</option>
                                <option ng-repeat="localidad in localidades" value="{{localidad.id}}">{{localidad.nombre}}</option>
                            </select>
                            <!-- <div  ng-show="registroUsuario.$submitted || registroUsuario.localidad.$touched">
                                <span class="text-danger" ng-show="registroUsuario.localidad.$error.required">El campo es obligatorio.</span>
                            </div> -->
                        </div>
                        <div class="form-group">                
                            <input type="submit" class="btn btn-success pull-right btn-block bnt-large" id="submit"  ng-click="submitFormulario(registroUsuario.$valid)">
                        </div>
                    </form>
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