<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>herlam-digital</title>
		<link rel="shortcut icon" href="http://www.herlam.com.ar/favicon.ico?v=2" type="image/x-icon">

		<!-- Bootstrap Core CSS -->
		<link href="librerias/template/css/bootstrap.min.css" rel="stylesheet">

		<link href="css/landing.css" rel="stylesheet">
		
		<title>Bienvenido</title>
	</head>

	<body class="bg-black">
		
			<div class="row" id="top" class="heigth-10">
				<div id="navbar" class="container top-navbar heigth-100" >
					<img src="img/logo.png" class="logo"  />
				</div>
			</div>
			<div class="row heigth-70" id="login" >
				<div class="container">
					<div class="col-sm-8 col-md-4 container-login">
						<div id="form-div" class="container-form col-sm-12">
							<form>
								<div class="col-sm-12">
									<input type='text' class="form-control" name="mail" id="mail" placeholder="Introduzca su email" />
								</div> 
								<br />
								<br />
								<!-- <br> -->
								<div class="col-sm-12">
									<input type='password' class="form-control" name="pass" id="pass" placeholder="Introduzca su contrase&ntilde;a" />
								</div>
								<br />
								<!-- <br> -->
								<div class="col-sm-12 text-center">
									<h1 class="white"><span class="nombre-logo">herlam DIGITAL<span></h1>
								</div>
								<div class="col-sm-12 text-center">
									<button class="btn btn-primary btn-lg" id="submit">Ingresar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div id="footer" class="row heigth-20">
				<div class="row">
					<div class=" heigth-70 bg-white text-center padding-10" >
						 <p>Si aun no tienes usuario ingresa aqu&iacute;:</p>
						 <a class="btn btn-primary" href="vistas/registro-usuario.php">REGISTRARME</a>
					</div>

				</div>
				<div class="row heigth-30 bg-black">
					<div class="container padding-10">
						<a class="pull-right white anchor" href="#" data-toggle="modal" data-target="#contactModal">CONTACTO</a>
						<p class="white">+ medical vet and scientific</p>

					</div>
				</div> 
			</div>
		
	</body>
	 <!-- jQuery -->
	<script src="librerias/template/js/jquery.js"></script>

	<script src="js/landing.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="librerias/template/js/bootstrap.min.js"></script>

	<!-- Bootbox js -->
	<script type="text/javascript" src="librerias/bootbox/bootbox.min.js"></script>

	<!-- modal de contacto -->
	<?php include_once('incluciones/formularioContacto.php'); ?>
	<script src="librerias/formulario_contacto/jqBootstrapValidation.js"></script>
	<script src="librerias/formulario_contacto/contact_me_index.js"></script>
</html>