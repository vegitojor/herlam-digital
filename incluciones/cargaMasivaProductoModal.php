<div class="w3-content" ng-show="cargaMasivaProductoDiv">
	<div class="w3-card-4 w3-lime" >
        <header>
            <a href="" class="w3-button w3-right w3-margin" ng-click="cerrarCargaMasiva()"><span class="fa fa-remove"></span> </a>
            
            <h1 class="w3-margin-left">Carga de producto Desde archivo</h1>

        </header>
        <div class="w3-container w3-center w3-white" >
	        <form  name="formularioCargaMasiva" enctype="multipart/form-data">
		        <div class="w3-col m6">
		        	<input type="file" name="archivo" id="archivoCarga" class="w3-input" file-model="archivoCargaMasiva" accept=".csv" required="required">
		        	 <div ng-show="formularioCargaMasiva.$submitted || formularioCargaMasiva.archivo.$touched">
                        <span class="w3-red" ng-show="formularioCargaMasiva.archivo.$error.required">El campo es obligatorio.</span>
                    </div>
		        </div>
		        <div>
		        	<input type="submit" name="enviarArchivoCargaMasiva" class="w3-green w3-btn" ng-click="enviarArchivoCargaMasiva()" value="Cargar Archivo" ng-disabled="formularioCargaMasiva.$invalid">
	        	</div>
	        	<br>
	        </form>
	    </div>
    </div>
</div>