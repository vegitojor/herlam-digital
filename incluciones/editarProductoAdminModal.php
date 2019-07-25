<!-- EDITAR PRODUCTO MODAL -->
<div class="w3-content  w3-gray" >
    <div class="w3-card-4 w3-blue" >
        <header>
            <a href="" class="w3-button w3-right w3-margin" ng-click="cerrarEditarProductoModal()"><span class="fa fa-remove"></span> </a>
            <h1 class="w3-margin-left">Editar el producto</h1>
        </header>

        <div class="w3-container w3-center w3-white" >
            <form name="formularioEditarProducto" >
                <!-- Primer columna del formulario -->
                
                <div class="w3-col l6 w3-padding">
                    <div class="w3-content">
                        <input type="text" class="w3-input w3-hover-orange" name="modeloEditar" ng-model="modeloEditar" value="" >
                        <label for="">Modelo</label>
                    </div>
                    <div class="w3-content">
                        <input type="text" class="w3-input w3-hover-orange" name="descripcionEditar" ng-model="descripcionEditar" value="">
                        <label for="descripcionEditar">Descripcion</label>
                    </div>
                    <div class="w3-content  ">
                        <div class="w3-col l4 w3-padding">
                            <input type="number" step="0.01" min=0 class="w3-input w3-hover-orange" name="precioEditar" string-to-number ng-model="precioEditar" value="" >
                            <label for="">Precio (en dolar)</label>
                        </div>
                        <div class="w3-col l4 w3-padding">
                            <input type="number" class="w3-input w3-hover-orange" min="1" max="24" name="mesesGarantiaEditar" ng-model="mesesGarantiaEditar">
                            <label for="">Meses de garantia</label>
                        </div>
                        <div class="w3-col l4 w3-padding">
                            <input type="text" class="w3-input w3-hover-orange" name="codigoFabricanteEditar" ng-model="codigoFabricanteEditar" >
                            <label for="">Código del fabricante</label>
                        </div>
                    </div>
                    
                    <div class="w3-content">
                        <div class="w3-col l4 w3-padding">
                            <input type="number" class="w3-input w3-hover-orange" min=0 name="codigoProveedorEditar" ng-model="codigoProveedorEditar">
                            <label for="">Código del proveedor</label>
                        </div>
                        <div class="w3-col l8 w3-padding">
                            <input type="text" class="w3-input w3-hover-orange" name="skuEditar" ng-model="skuEditar">
                            <label for="">Código SKU</label>
                        </div>
                    </div>
                    <div class="w3-content w3-center" >

                        <select class="w3-select" name="proveedorEditar" id="proveedorEditar" ng-model="proveedorEditar" ng-options="proveedor.id as proveedor.nombre for proveedor in proveedores">
                            <option value="" disabled>Seleccione un proveedor</option>
                            <!--<option ng-repeat="proveedor in proveedores" value="{{proveedor.id}}">{{proveedor.nombre}}</option>-->
                        </select>
                        <label for="proveedor">Proveedor <span style="font-size: 10px;">(Si no se modifica el proveedor, no es necesario modificar este campo)</span></label>

                    </div>


                </div>
                <!-- Segunda columna del formulario -->
                <div class="w3-col l6 w3-padding ">
                    <div class="w3-content">
                        <input type="text" class="w3-input w3-hover-orange" name="videoEditar" ng-model="videoEditar">
                        <label for="">URL del Video</label>
                    </div>
                    <br>
                    <div class="w3-content">
                        <div class="w3-col l3 w3-padding">
                            <input type="number" step="0.01" class="w3-input w3-hover-orange" min=0 name="altoEditar" ng-model="altoEditar" value="">
                            <label for="">Alto de caja</label>
                        </div>
                        <div class="w3-col l3 w3-padding">
                            <input type="number" step="0.01" class="w3-input w3-hover-orange" min=0 name="anchoEditar" ng-model="anchoEditar" value="">
                            <label for="">Ancho de caja</label>
                        </div>
                        <div class="w3-col l3 w3-padding">
                            <input type="number" step="0.01" class="w3-input w3-hover-orange" min=0 name="profundidadEditar" ng-model="profundidadEditar" value="">
                            <label for="">Profundidad de caja</label>
                        </div>
                        <div class="w3-col l3 w3-padding">
                            <input type="number" step="0.01" class="w3-input w3-hover-orange" min=0 name="pesoEditar" ng-model="pesoEditar" value="">
                            <label for="">Peso de caja</label>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    
                    <div class="w3-content">
                        <div class="w3-content w3-center" >
                            <select class="w3-select" name="marcaEditar" id="marcaEditar" ng-model="marcaEditar" ng-options="marca.id as marca.descripcion for marca in marcas">
                                <option value="" disabled>Seleccione una Marca</option>
                                <!--<option ng-repeat="marcaPro in marcas" value="{{marcaPro.id}}">{{marcaPro.descripcion}}</option>-->
                            </select>
                            <label for="">Marca <span style="font-size: 10px;">(Si no se modifica la marca, no es necesario modificar este campo)</span></label>

                        </div>
                        
                        <p>Categoria: {{categoriaEditar}}</p>
                        <div ng-show="fichaParaElProducto">
                            <div ng-hide="fichaParaElProducto.campo01 == 0 ">
                                <label class="w3-col l4">{{fichaParaElProducto.campo01}}:</label>
                                <input type="text" class="w3-input w3-hover-border-red w3-col l8" name="campo01" ng-model="campoProducto01Editar">
                            </div>
                            <div ng-hide="fichaParaElProducto.campo02 == '0'">
                                <span class="w3-col l4 ">{{fichaParaElProducto.campo02}}:</span>
                                <input type="text" class="w3-input w3-hover-border-red w3-col l8" name="campo02" ng-model="campoProducto02Editar">
                            </div>
                            <div ng-hide="fichaParaElProducto.campo03 == 0">
                                <span class="w3-col l4 ">{{fichaParaElProducto.campo03}}:</span>
                                <input type="text" class="w3-input w3-hover-border-red w3-col l8" name="campo03" ng-model="campoProducto03Editar">
                            </div>
                            <div ng-hide="fichaParaElProducto.campo04 == 0">
                                <span class="w3-col l4 ">{{fichaParaElProducto.campo04}}:</span>
                                <input type="text" class="w3-input w3-hover-border-red w3-col l8" name="campo04" ng-model="campoProducto04Editar">
                            </div>
                            <div ng-hide="fichaParaElProducto.campo05 == 0">
                                <span class="w3-col l4 ">{{fichaParaElProducto.campo05}}:</span>
                                <input type="text" class="w3-input w3-hover-border-red w3-col l8" name="campo05" ng-model="campoProducto05Editar">
                            </div>
                            <div ng-hide="fichaParaElProducto.campo06 == 0">
                                <span class="w3-col l4 ">{{fichaParaElProducto.campo06}}:</span>
                                <input type="text" class="w3-input w3-hover-border-red w3-col l8" name="campo06" ng-model="campoProducto06Editar">
                            </div>
                            <div ng-hide="fichaParaElProducto.campo07 == 0">
                                <span class="w3-col l4 ">{{fichaParaElProducto.campo07}}:</span>
                                <input type="text" class="w3-input w3-hover-border-red w3-col l8" name="campo07" ng-model="campoProducto07Editar">
                            </div>
                            <div ng-hide="fichaParaElProducto.campo08 == 0">
                                <span class="w3-col l4 ">{{fichaParaElProducto.campo08}}:</span>
                                <input type="text" class="w3-input w3-hover-border-red w3-col l8" name="campo08" ng-model="campoProducto08Editar">
                            </div>
                            <div ng-hide="fichaParaElProducto.campo09 == 0">
                                <span class="w3-col l4 ">{{fichaParaElProducto.campo09}}:</span>
                                <input type="text" class="w3-input w3-hover-border-red w3-col l8" name="campo09" ng-model="campoProducto09Editar">
                            </div>
                            <div ng-hide="fichaParaElProducto.campo10 == 0">
                                <span class="w3-col l4 ">{{fichaParaElProducto.campo10}}:</span>
                                <input type="text" class="w3-input w3-hover-border-red w3-col l8" name="campo10" ng-model="campoProducto10Editar">
                            </div>
                            <div ng-hide="fichaParaElProducto.campo11 == 0">
                                <span class="w3-col l4 ">{{fichaParaElProducto.campo11}}:</span>
                                <input type="text" class="w3-input w3-hover-border-red w3-col l8" name="campo11" ng-model="campoProducto11Editar">
                            </div>
                            <div ng-hide="fichaParaElProducto.campo12 == 0">
                                <span class="w3-col l4 ">{{fichaParaElProducto.campo12}}:</span>
                                <input type="text" class="w3-input w3-hover-border-red w3-col l8" name="campo12" ng-model="campoProducto12Editar">
                            </div>
                            <div ng-hide="fichaParaElProducto.campo13 == 0">
                                <span class="w3-col l4 ">{{fichaParaElProducto.campo13}}:</span>
                                <input type="text" class="w3-input w3-hover-border-red w3-col l8" name="campo13" ng-model="campoProducto13Editar">
                            </div>
                            <div ng-hide="fichaParaElProducto.campo14 == 0">
                                <span class="w3-col l4 ">{{fichaParaElProducto.campo14}}:</span>
                                <input type="text" class="w3-input w3-hover-border-red w3-col l8" name="campo14" ng-model="campoProducto14Editar">
                            </div>
                            <div ng-hide="fichaParaElProducto.campo15 == 0">
                                <span class="w3-col l4 ">{{fichaParaElProducto.campo15}}:</span>
                                <input type="text" class="w3-input w3-hover-border-red w3-col l8" name="campo15" ng-model="campoProducto15Editar">
                            </div>
                            <div ng-hide="fichaParaElProducto.campo16 == 0">
                                <span class="w3-col l4 ">{{fichaParaElProducto.campo16}}:</span>
                                <input type="text" class="w3-input w3-hover-border-red w3-col l8" name="campo16" ng-model="campoProducto16Editar">
                            </div>
                            <div ng-hide="fichaParaElProducto.campo17 == 0">
                                <span class="w3-col l4 ">{{fichaParaElProducto.campo17}}:</span>
                                <input type="text" class="w3-input w3-hover-border-red w3-col l8" name="campo17" ng-model="campoProducto17Editar">
                            </div>
                            <div ng-hide="fichaParaElProducto.campo18 == 0">
                                <span class="w3-col l4 ">{{fichaParaElProducto.campo18}}:</span>
                                <input type="text" class="w3-input w3-hover-border-red w3-col l8" name="campo18" ng-model="campoProducto18Editar">
                            </div>
                            <div ng-hide="fichaParaElProducto.campo19 == 0">
                                <span class="w3-col l4 ">{{fichaParaElProducto.campo19}}:</span>
                                <input type="text" class="w3-input w3-hover-border-red w3-col l8" name="campo19" ng-model="campoProducto19Editar">
                            </div>
                            <div ng-hide="fichaParaElProducto.campo20 == 0">
                                <span class="w3-col l4 ">{{fichaParaElProducto.campo20}}:</span>
                                <input type="text" class="w3-input w3-hover-border-red w3-col l8" name="campo20" ng-model="campoProducto20Editar">
                            </div>

                        </div>

                    </div>

                </div>
                <div class="w3-content w3-padding">
                    <input type="submit" class="w3-margin-bottom w3-button w3-green w3-col l12 w3-center" ng-click="guardarEditarProducto()" >
                    <br>
                    <br>
                </div>
                <br>
            </form>
        </div>
    </div>

</div><!-- fin de carga de producto -->