<?php  

include_once ("../incluciones/verificacionAdmin.php");

?>

<!DOCTYPE html>
<html>
<head>
    <?php include_once ('../incluciones/headAdmin.php'); ?>

	<title>Control administrador</title>
</head>
<body class="w3-light-gray">
    <!-- Navegador Admin -->

    <?php include_once ("../incluciones/navegadorAdmin.php");?> 
    <!-- <?php include_once ("../incluciones/navbarAdmin.php");?>-->

    <!-- seccion de busqueda de producto -->
    <div class="w3-container w3-padding-32 w3-blue-gray">
        <h1 class="w3-jumbo">Administración de ModPC</h1>
    </div>
    <br>
	<div class="w3-row w3-content w3-white">
		<div class="w3-card-4">
			<div class="w3-row ">
				<h1 class="w3-margin-left">Buscar productos segun los criterios de busqueda:</h1>
			</div>
			<div class="w3-row">
			    <a href="javascript:void(0)" onclick="openTab(event, 'producto');">
			      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding w3-center">Producto</div>
			    </a>
			    <a href="javascript:void(0)" onclick="openTab(event, 'categoria');">
			      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding w3-center">Categoria</div>
			    </a>
			    <a href="javascript:void(0)" onclick="openTab(event, 'proveedor');">
			      <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding w3-center">Proveedor</div>
			    </a>
		    </div>

			<div id="producto" class="w3-container productos" style="display:none">
				<h3>Por nombre de producto</h3>
				<form action="" class="w3-content">
					<input 	type="text" class="w3-input" name="buscarPorProducto" placeholder="Introduce un producto">
					<br>
					<input type="submit" class="w3-btn w3-green w3-right" name="">
                    <br>
                    <br>
				</form>
			</div>

			<div id="categoria" class="w3-container productos" style="display:none">
				<h3>Por nombre de categoria</h3>
				<form action="" class="w3-content">
					<input 	type="text" class="w3-input" name="buscarPorProducto" placeholder="Introduce un producto">
					<br>
					<input type="submit" class="w3-btn w3-green w3-right" name="">
                    <br><br>
				</form>
			</div>

			<div id="proveedor" class="w3-container productos" style="display:none">
				<h3>Por nombre de proveedor</h3>
				<form action="" class="w3-content">
					<input 	type="text" class="w3-input" name="buscarPorProducto" placeholder="Introduce un producto">
					<br>
					<input type="submit" class="w3-btn w3-green w3-right" name="">
                    <br><br>
				</form>
			</div>
			
	    </div>
	</div>
	<br>

    <!-- tabla resultado de busqueda -->
	<div class="w3-content w3-white">
		<table class="w3-table w3-striped w3-hoverable w3-card-4">
			<tr>
				<th>id</th>
                <th>descripción</th>
                <th>estado</th>
                <th>precio</th>
				<th>categoria</th>
			</tr>
		</table>
	</div>
</body>
</html>