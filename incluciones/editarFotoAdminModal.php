<div class="w3-content  w3-gray" >
    <div class="w3-card-4 w3-orange" >
    	<header>
            <a href="" class="w3-button w3-right w3-margin" ng-click="cerrarEditarFotoModal()"><span class="fa fa-remove"></span> </a>
            <h1 class="w3-margin-left">Editar la foto del producto</h1>
        </header>
        <div class="w3-container w3-center w3-white" >
            <form name="formularioEditarProducto" enctype="multipart/form-data">
            	<div class="w3-row">
            		<div class="w3-col m5">
            			<img src="../resourses/imagen_producto/{{imagenAnterior}}" class="foto320x150" alt="imagen-{{producto.modelo}}" ng-hide="imagenAnterior == '<--NoFoto-->'" >
                        <img src="http://placehold.it/320x150" alt="" class="foto320x150" ng-show="imagenAnterior == '<--NoFoto-->'">
            		</div>
            		<div class="w3-col m5 ">
            			<p>Producto: {{productoAEditar}}</p>
            			<label>Seleccionar una nueva imagen:</label>
            			<input type="file" class="w3-input w3-center" name="foto" id="foto" file-model="fotoEditar" required="">
						<button class="w3-button w3-green" ng-click="guardarEditarFoto()">Cambiar Imagen</button>
						<br>
						<br>
            		</div>
            	</div>
            </form>
        </div>
    </div>
</div>