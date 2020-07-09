<div id="cargarCelularModal" class="modal fade" role="dialog" >
<!-- ng-controller="indexCambioPass" -->
    <div class="modal-dialog" >
    <!-- ng-init='obtenerUsuarioParaPass()' -->
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar celular:</h4>
            </div>
            <div class="modal-body">
                <!-- <p>Si continua con el siguiente formulario podra cambiar su contrase&ntilde;a a cualquiera de su elecci&oacute;n. Se recomienda que contenga al menos 8 car&aacute;cteres.</p> -->
                <form action="" name="cargarCelular">
                    <div class="form-group">
                        <label for="domicilio">Ingrese su n&uacute;mero de celular (cod. de &aacute;rea + numero):</label>
                        <input type="number" class="form-control" id="celular" name="celular" placeholder="Ej.: 1155555555. **Donde 11 sería el cod de area" ng-model="celular" ng-model-option="{updateOn: 'blur'} " required >
                        <div  ng-show="cargarCelular.$submitted || cargarCelular.pass.$touched">
                            <span class="text-danger" ng-show="cargarCelular.celular.$error.required">El campo es obligatorio.</span>
                        </div>
                    </div>
                   
                </form>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                <button type="submit" class="btn btn-success" ng-disabled="cargarCelular.$invalid" ng-click="guardarCelular(cargarCelular.$valid)">Confirmar</button>
            </div>
        </div>

    </div>
</div>