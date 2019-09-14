<?php  

include_once ("../incluciones/verificacionAdmin.php");

?>

<!DOCTYPE html>
<html>
<head>
	<?php include_once ('../incluciones/headAdmin.php'); ?>
	<script type="text/javascript" src="../js/adminModule.js?<?= $versionJs ?>"></script>
	<script type="text/javascript" src="../js/adminIndexController.js?<?= $versionJs ?>"></script>
	<title>Control administrador</title>
</head>
<body class="w3-light-gray" ng-app="admin" ng-controller="adminIndexController">
    <!-- Navegador Admin -->

    <?php include_once ("../incluciones/navegadorAdmin.php");?> 
    <!-- <?php //include_once ("../incluciones/navbarAdmin.php");?>-->

    <!-- seccion de busqueda de producto -->
    <div class="w3-container w3-padding-32 w3-blue-gray">
        <h1 class="w3-jumbo">Administración de herlam-Digital</h1>
    </div>
	<br>
	<div class="w3-row w3-content w3-white">
	<!-- <div class="w3-row w3-container w3-white"> -->
		<div class="w3-card-4">
			<div class="w3-row ">
				<h1 class="w3-margin-left">Buscar pedidos:</h1>
			</div>
			<div class="w3-row">
			    <a href="javascript:void(0)" onclick="openTab(event, 'producto');">
			      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding w3-center">N&deg; de pedido</div>
			    </a>
			    <a href="javascript:void(0)" onclick="openTab(event, 'categoria');">
			      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding w3-center">N&deg; de cliente</div>
			    </a>
			    <a href="javascript:void(0)" onclick="openTab(event, 'proveedor');">
			      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding w3-center" ng-init="cargarEstadosPedido()">Estado</div>
			    </a>
		    </div>

			<div id="producto" class="w3-container productos" style="display:none">
				<!-- <h3>Por nombre de producto</h3> -->
				<form class="w3-content">
					<br>
					<input 	type="text" class="w3-input" name="buscarPorPedido" ng-model="buscarPorPedido"  placeholder="Introduce un número de pedido">
					<br>
					<input type="submit" ng-click="buscarPedidosFiltro()" class="w3-right w3-btn w3-white w3-border w3-border-green w3-round" name="">
					<input type="button" ng-click="limpiarFiltros()" class=" w3-right w3-btn w3-white w3-border w3-border-red w3-round" name="" value="Limpiar">
                    <br>
                    <br>
				</form>
			</div>

			<div id="categoria" class="w3-container productos" style="display:none">
				<!-- <h3>Por nombre de categoria</h3> -->
				<form  class="w3-content">
					<br>
					<input 	type="text" class="w3-input" name="buscarPorProducto" ng-model="buscarPorCliente" placeholder="Introduce un producto">
					<br>
					<input type="submit" ng-click="buscarPedidosFiltro()" class="w3-btn w3-green w3-right w3-btn w3-white w3-border w3-border-green w3-round" name="">
					<input type="button" ng-click="limpiarFiltros()" class=" w3-right w3-btn w3-white w3-border w3-border-red w3-round" name="" value="Limpiar">
                    <br><br>
				</form>
			</div>

			<div id="proveedor" class="w3-container productos" style="display:none">
				<!-- <h3>Por nombre de proveedor</h3> -->
				<form class="w3-content" ng-init="cargarEstadosPedido()">
					<br>
					<!-- <input 	type="text" class="w3-input" name="buscarPorProducto" placeholder="Introduce un producto"> -->
					<select class="w3-select" name="estadoFiltro" ng-model="estadoFiltro" id="estadoFiltro"
					ng-options="item.id as item.descripcion for item in estados"></select>
					<br><br>
					<input type="submit" ng-click="buscarPedidosFiltro()" class="w3-btn w3-green w3-right w3-btn w3-white w3-border w3-border-green w3-round" name="">
					<input type="button" ng-click="limpiarFiltros()" class=" w3-right w3-btn w3-white w3-border w3-border-red w3-round" name="" value="Limpiar">
                    <br><br>
				</form>
			</div>
			<!-- <div class="w3-container">
				<a href="javascript:void(0);" ng-click="buscarPedidosFiltro()" class=" w3-btn w3-white w3-border w3-border-green w3-round">Filtrar</a>
			</div> -->
			
	    </div>
	</div>
	<br>

    <!-- tabla resultado de busqueda -->
	<div class="w3-container w3-white" ng-init="listarPedidos()">
		<table class="w3-table w3-striped w3-hoverable w3-card-2">
			<thead>
				<tr>
					<th>N&deg;</th>
					<th>Cliente</th>
					<th>N&deg; cliente</th>
					<th>fecha</th>
					<th>Estado</th>
					<th>Tipo de env&iacute;o</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="pedido in pedidos">
					<td>{{pedido.id}}</td>
					<td>{{pedido.apellido_cliente}}</td>
					<td>{{pedido.id_cliente}}</td>
					<td>{{pedido.fecha}}</td>
					<td ng-class="{'w3-text-green': (pedido.id_estado_pedido == 1), 'w3-text-orange': (pedido.id_estado_pedido == 2)}">{{pedido.estado_descripcion}}</td>
					<td>
						<span ng-if="!pedido.tipo_pedido">Retiro acordado c/ vendedor</span>
						<span ng-if="pedido.tipo_pedido">Env&iacute;o a domicilio</span>
					</td>
					<td>
						<a href="javascript:void(0);"
						class="w3-btn w3-white w3-border w3-border-green w3-round" 
						ng-if="pedido.id_estado_pedido != 5 && pedido.id_estado_pedido != 6"
						ng-click="mostrarProductos(pedido)">{{
							((pedido.id_estado_pedido == 1) 
							? 'Validar' 
							: ((pedido.id_estado_pedido ==  2 )
								 ? 'Cambiar a pagado' 
								 : ((pedido.id_estado_pedido == 3 )
									 ? 'Cambiar a despachado' 
									 : ((pedido.id_estado_pedido == 4)
										 ?'Cambiar a entregado'
										 : '') ) ))
						}}</a>
					</td>
					<td>
						<a href="javascript:void(0);" 
						class="w3-btn w3-white w3-border w3-border-blue w3-round" 
						ng-click="generarExel(pedido)"
						ng-if="pedido.id_estado_pedido > 1">Exel</a>
						<a href="javascript:void(0);" 
						class="w3-btn w3-white w3-border w3-border-red w3-round" 
						ng-click="cancelarPedido(pedido)"
						ng-if="pedido.id_estado_pedido == 1 || pedido.id_estado_pedido == 2">Cancelar</a>
					</td>
				</tr>
			</tbody>
		</table>
		<!-- PAGINACION -->
		<br>
		<div class="w3-bar w3-border w3-round w3-center " ng-init="cantidadDePaginacion()">
			<a href="" class="w3-button" ng-click="cambiarPagina(0)">&#10094; Previous</a>
			
			<a href="" class="w3-button " ng-repeat="paginacion in paginaciones" ng-class="{'w3-green': (desde==(paginacion * limite - limite))}" ng-click="buscarSegunPagina(paginacion)">{{paginacion}}</a>

			<a href="" class="w3-button" ng-click="cambiarPagina(1)">Next &#10095;</a>
		</div>
		<!-- FIN PAGINACION -->
	</div>


	<!-- The Modal -->
	<div id="validarModal" class="w3-modal"> 
		<div class="w3-modal-content w3-animate-bottom" style="width: 90vw;">
			<div class="w3-container">
				<h2>Pedido N. {{pedidoModal.id}}</h2>
				<p>Tipo de env&iacute;o: {{pedidoModal.tipo_pedido == 1 ? 'Envío a domicilio' : 'Retiro acordado con vendedor'}}</p>
				<p>Direccion: {{pedidoModal.calle}} {{pedidoModal.numero}} {{pedidoModal.piso}} {{pedidoModal.depto}}, {{pedidoModal.localidad}}, {{pedidoModal.provincia}}</p>
				<p>Dia de entrega: {{pedido.dia_envio == 0 ? 'Lunes' :
					(pedido.dia_envio == 1 ? 'Martes' :
						(pedido.dia_envio == 2 ? 'Miercoles' :
							(pedido.dia_envio == 3 ? 'Jueves' : 'Viernes')))}}</p>
				<p>Horario: {{pedido.horario_envio == 0 ? 'Mañana' : 'Tarde'}}</p>
				</p>
				<span ng-click="cerrarModal()" 
				class="w3-button w3-display-topright">&times;</span>
				<div>
					<table class="w3-table w3-striped w3-hoverable w3-card-2">
						<thead>
							<tr>
								<th>Id</th>
								<th>Descripcion</th>
								<th>Modelo</th>
								<th>Marca</th>
								<th>Codigo fabricante</th>
								<th>Categoria</th>
								<th>SKU</th>
								<th>Cantidad</th>
								<th>Precio</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="producto in productos" ng-class="{'w3-red': producto.disponible == 0}">
								<td>{{producto.id}}</td>
								<td>{{producto.descripcion}}</td>
								<td>{{producto.modelo}}</td>
								<td>{{producto.marca_descripcion}}</td>
								<td>{{producto.cod_fabricante}}</td>
								<td>{{producto.categoria_nombre}}</td>
								<td>{{producto.codigo_sku}}</td>
								<td>{{producto.cantidad}}</td>
								<td>{{producto.precio}}</td>
								<td>
									<button href="javascript:void(0)" 
									class="w3-btn w3-white w3-border w3-border-red w3-round"
									ng-click="quitarProductoPedido(producto.id)">Quitar</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="w3-content">
					<footer class="w3-container  w3-display-container w3-padding" style="height: 8vh">
						<button class="w3-btn w3-white w3-border w3-border-green w3-round w3-margins w3-display-right" 
						ng-class="{'w3-disabled': (!permitirValidar || productos.length == 0)}"
						ng-click ="validarPedido(pedidoModal)">Confirmar</button>
					</footer>
				</div>
			</div>
		</div>
	</div>
</body>
</html>