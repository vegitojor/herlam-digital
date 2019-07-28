    <!-- ASIDE - COLUMNA LATERAL -->
    <div class="col-md-3" ng-init="cargarMoneda()" >
        <div class="col-md-12" ng-init="generarCheckoutBasicoMP(<?= $id ?>)">
            <p class="lead">Categorias:</p>
            <div class="list-group" ng-init="listarCategorias()" >
                <a ng-repeat="categoria in categorias" href="categoria.php?id={{categoria.id}}" class="list-group-item" >{{categoria.nombre}}</a>

            </div>
        </div>
        
    </div>
    <!-- fin ASIDE -->