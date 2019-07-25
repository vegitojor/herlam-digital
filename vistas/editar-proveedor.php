<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 26/09/17
 * Time: 9:12
 */
include_once ('../incluciones/verificacionAdmin.php');

$id = strip_tags($_GET['var']);
$id = (int)$id;

?>
<!DOCTYPE html>
<html>
    <haed>
        <?php include_once ('../incluciones/headAdmin.php');?>
        <script type="text/javascript" src="../js/adminModule.js"></script>
        <script typt="text/javascript" src="../js/editarProveedorController.js"></script>
        <script typt="text/javascript" src="../js/editarRedireccionarController.js"></script>

        <title>Editar proveedor</title>
    </haed>
    <body ng-app="admin" ng-controller="editarProveedor" class="w3-light-gray">
        <?php include_once ('../incluciones/navegadorAdmin.php');?>

        <div class="w3-container w3-padding-32  w3-blue-gray">
            <h1 class="w3-jumbo w3-margin-left">Editar Proveedor</h1>
        </div>
        <!-- Formulario de carga -->
        <div class="w3-content">
            <div class="w3-card-4 w3-blue-gray" ng-controller="editarRedireccionarController">
                <header>
                    <h2 class="w3-margin-left">Introduzca los cambios del proveedor</h2>
                </header>
                <div class="w3-container w3-center w3-white w3-padding" >
                    <form action="../controladores/editarProveedorController.php" name="formProveedor" ng-init="obtenerProveedor(<?= $id ?>)" method="post">
                        <div class="w3-row">
                            <div class="w3-content w3-padding">
                                <input type="hidden" name="id" value="{{proveedorObtenido.id}}">
                                <input type="hidden" name="idLocalidad" value="{{proveedorObtenido.idLocalidad}}">
                                <input type="text" class="w3-input w3-hover-orange" name="nombre" value="{{proveedorObtenido.nombre}}"  required >
                                <label for="">Nombre del proveedor</label>
                                <div  ng-show="formProveedor.nombre.$touched || formProveedor.$submitted">
                                    <span class="w3-text-red" ng-show="formProveedor.nombre.$error.required || formProveedor.nombre.$error.email">El campo es obligatorio o se ingreso un email incorrecto.</span>
                                </div>
                            </div>
                        </div>
                        <div class="w3-row">
                            <div class="w3-content">
                                <div class="w3-content w3-col l4 w3-padding">
                                    <input type="text" class="w3-input w3-hover-orange"  name="telefono" value="{{proveedorObtenido.telefono}}"  required>
                                    <label for="">Teléfono</label>
                                    <div  ng-show="formProveedor.telefono.$touched || formProveedor.$submitted">
                                        <span class="w3-text-red" ng-show="formProveedor.telefono.$error.required || formProveedor.telefono.$error.email">El campo es obligatorio o se ingreso un email incorrecto.</span>
                                    </div>
                                </div>
                                <div class="w3-content w3-col l8 w3-padding">
                                    <input type="email" class="w3-input w3-hover-orange"  name="email" id="email" value="{{proveedorObtenido.email}}" required="">
                                    <label for="">E-mail</label>
                                    <div  ng-show="formProveedor.email.$touched || formProveedor.$submitted">
                                        <span class="w3-text-red" ng-show="formProveedor.email.$error.required || formProveedor.email.$error.email">El campo es obligatorio o se ingreso un email incorrecto.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w3-row">
                            <div class="w3-content">
                                <div class="w3-col l4 w3-padding">
                                    <input type="text" class="w3-input w3-hover-orange" name="direccion" value="{{proveedorObtenido.direccion}}" required="">
                                    <label for="">Dirección</label>
                                    <div  ng-show="formProveedor.direccion.$touched || formProveedor.$submitted">
                                        <span class="w3-text-red" ng-show="formProveedor.direccion.$error.required">El campo es obligatorio.</span>
                                    </div>
                                </div>
                                <div class="w3-col l3 w3-padding">
                                    <input type="number" class="w3-input w3-hover-orange" name="codigoPostal" value="{{proveedorObtenido.codigoPostal}}" required>
                                    <label for="">Código Postal</label>
                                    <div  ng-show="formProveedor.codigoPostal.$touched || formProveedor.$submitted">
                                        <span class="w3-text-red" ng-show="formProveedor.codigoPostal.$error.required">El campo es obligatorio.</span>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <input type="submit" class="w3-button w3-green"  value="Guardar cambios">
                        <a href="cargar-proveedor.php" class="w3-button w3-blue">Volver</a>
                    </form>

                </div>
            </div>
        </div>
    
    </body>
</html>
