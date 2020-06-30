<div id="passModal" class="modal fade" role="dialog" ng-controller="indexCambioPass">
    <div class="modal-dialog" ng-init='obtenerUsuarioParaPass(<?= json_encode($usuarioArray); ?>)'>

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cambio de contrase&ntilde;a</h4>
            </div>
            <div class="modal-body">
                <p>Si continua con el siguiente formulario podra cambiar su contrase&ntilde;a a cualquiera de su elecci&oacute;n. Se recomienda que contenga al menos 8 car&aacute;cteres.</p>
                <form action="" name="passChange">
                    <div class="form-group">
                        <label for="domicilio">Ingrese su contrase&ntilde;a actual</label>
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Introduzca su contraseña" ng-model="pass" ng-model-option="{updateOn: 'blur'} " required >
                        <div  ng-show="passChange.$submitted || passChange.pass.$touched">
                            <span class="text-danger" ng-show="passChange.pass.$error.required">El campo es obligatorio.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="domicilio">Ingrese su <strong>nueva</strong> contrase&ntilde;a </label>
                        <input type="password" class="form-control" id="newPass" name="newPass" placeholder="Introduzca su nueva constraseña" ng-model="newPass" ng-model-option="{updateOn: 'blur'} " required >
                        <div  ng-show="passChange.$submitted || passChange.newPass.$touched">
                            <span class="text-danger" ng-show="passChange.newPass.$error.required">El campo es obligatorio.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pass">Reingrese su nueva contrase&ntilde;a</label>
                        <input type="password" class="form-control" id="passValid" name="passValid" placeholder="Reingrese su contraseña" ng-model="passValid" ng-model-option="{updateOn: 'blur'} " required pass-change-check="newPass">
                        <div  ng-show="passChange.$submitted || passChange.pass.$touched">
                            <span class="text-danger" ng-show="passChange.passValid.$error.required">El campo es obligatorio.</span>
                            <span class="text-danger" ng-show="passChange.passValid.$error.pwchangematch">La contraseña no coincide.</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" ng-click="cambiarPass(passChange.$valid)">Confirmar</button>
            </div>
        </div>

    </div>
</div>