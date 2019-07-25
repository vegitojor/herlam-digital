<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="stylesheet" type="text/css" href="../librerias/bootstrap/css/bt.css">

	<link rel="stylesheet" type="tegit xt/css" href="../librerias/bootstrap/css/bt.css">

	<script type="text/javascript" src="../librerias/jquery/jquery-3.2.1.js"></script>
	<script type="text/javascript" src="../librerias/bootstrap/js/bootstrap.js"></script>

	<!-- ANGULAR -->
	<script type="text/javascript" src="../librerias/angularjs/angular.min.js"></script>
	<!-- modulo angular -->
	<script type="text/javascript" src="../js/registroUsuarioValidacion.js"></script>
	<!-- controlador angular -->
	<script type="text/javascript" src="../js/registroUsuarioValidacionController.js"></script>
	<!-- directiva angular -->
	<script type="text/javascript" src="../js/registroUsuarioValidacionDirective.js"></script>

	<title>Registro de Usuario</title>
</head>
<body ng-app="registroUsuario">

<div class="content">
	<div class="jumbotron col-md-12 col-sm-12 text-center ">
		<h1>REGISTRO DE USUARIOS</h1>
	</div>
	<div ng-controller="formularioRegistro" class="container">
		<form name="registroUsuario" role="form" class="col-md-12" novalidate>
			<div class="row divide">
				<div class="col-md-6">
					<input type="hidden" id="admin" name="admin" value=0 ng-model="admin">
					<div class="form-group ">						
					    <label for="usuario">Ingrese su nombre de usuario</label>
					    <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" placeholder="Introduzca su usuario" ng-model="usuario" ng-model-options="{ updateOn: 'blur' }" required>
					    <div  ng-show="registroUsuario.nombreUsuario.$touched || registroUsuario.$submitted">
							<span class="text-danger" ng-show="registroUsuario.nombreUsuario.$error.required">El campo es obligatorio.</span>
		      			</div>
					</div> 					
					<div class="form-group">
					    <label for="nombre">Ingrese su nombre</label>
					    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduzca su nombre" ng-model="nombre" ng-model-options="{ updateOn: 'blur' }" required>
					    <span ng-show="registroUsuario.$submitted || registroUsuario.nombre.$touched">
							<span class="text-danger" ng-show="registroUsuario.nombre.$error.required">El campo es obligatorio.</span>
		      			</span>
					</div>
					<div class="form-group">
					    <label for="apellido">Ingrese su apellido</label>
					    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Introduzca su apellido" ng-model="apellido" ng-model-option="{updateOn: 'blur'}" required>
					    <div  ng-show="registroUsuario.$submitted || registroUsuario.apellido.$touched">
							<span class="text-danger" ng-show="registroUsuario.apellido.$error.required">El campo es obligatorio.</span>
		      			</div>
					</div>
					<div class="form-group">
					    <label for="telefono">Ingrese su número telefónico</label>
					    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Introduzca su teléfono" ng-model="telefono" ng-model-option="{updateOn: 'blur'}" required>
					    <div  ng-show="registroUsuario.$submitted || registroUsuario.telefono.$touched">
							<span class="text-danger" ng-show="registroUsuario.telefono.$error.required">El campo es obligatorio.</span>
		      			</div>
					</div>
					<div class="form-group">
					    <label for="fechaNacimiento">Ingrese su fecha de Nacimiento</label>
					    <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" placeholder="Introduzca su fecha de nacimiento" ng-model="fechaNacimiento" ng-model-option="{updateOn: 'blur'}" required>
                        <div  ng-show="registroUsuario.$submitted || registroUsuario.fechaNacimiento.$touched">
                            <span class="text-danger" ng-show="registroUsuario.fechaNacimiento.$error.required">El campo es obligatorio.</span>
                        </div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					    <label for="email">Ingrese su e-mail</label>
					    <input type="email" class="form-control" id="email" name="email" placeholder="Introduzca su e-mail" ng-model="email" ng-model-option="{updateOn: 'blur'} " required>
					    <div  ng-show="registroUsuario.$submitted || registroUsuario.email.$touched">
							<span class="text-danger" ng-show="registroUsuario.email.$error.required || registroUsuario.email.$error.email">El campo es obligatorio o no se ingreso un mail válido.</span>						
		      			</div>
					</div>
					<div class="form-group">
					    <label for="domicilio">Ingrese su domicilio</label>
					    <input type="text" class="form-control" id="domicilio" name="domicilio" placeholder="Introduzca su domicilio (calle y altura)" ng-model="direccion" ng-model-option="{updateOn: 'blur'} " required>
					    <div  ng-show="registroUsuario.$submitted || registroUsuario.domicilio.$touched">
							<span class="text-danger" ng-show="registroUsuario.domicilio.$error.required">El campo es obligatorio.</span>
		      			</div>
					</div>
					<div class="form-group">
					    <label for="codPostal">Ingrese su código postal</label>
					    <input type="number" class="form-control" id="codPostal" name="codPostal" placeholder="Introduzca su código postal" ng-model="codPostal" ng-model-option="{updateOn: 'blur'} " required>
					    <div  ng-show="registroUsuario.$submitted || registroUsuario.codPostal.$touched">
							<span class="text-danger" ng-show="registroUsuario.codPostal.$error.required">El campo es obligatorio.</span>
		      			</div>
					</div>
					<div class="form-group" ng-init="cargarProvincias()">
					    <label for="provincia">Seleccione su provincia</label>
					    <select class="form-control" name="provincia" ng-model="provincia" ng-change="cargarLocalidades()" >
					    	<option value="">Seleccione una provincia</option>
					    	<option ng-repeat="provincia in provincias" value={{provincia.id_provincia}}>{{provincia.provincia}}</option>
					    </select>
					</div>
					<div class="form-group" >
					    <label for="localidad">Seleccione su localidad</label>
					    <select class="form-control" name="localidad" ng-model="localidad" required>
					    	<option value="">Seleccione una localidad</option>
					    	<option ng-repeat="localidad in localidades" value="{{localidad.id_localidad}}">{{localidad.localidad}}</option>
					    </select>
					    <div  ng-show="registroUsuario.$submitted || registroUsuario.localidad.$touched">
							<span class="text-danger" ng-show="registroUsuario.localidad.$error.required">El campo es obligatorio.</span>
		      			</div>
					</div>
					<div class="form-group">
					    <label for="pass">Ingrese su contraseña</label>
					    <input type="password" class="form-control" id="pass" name="pass" placeholder="Introduzca su contraseña" ng-model="pass" ng-model-option="{updateOn: 'blur'} " required>
					    <div  ng-show="registroUsuario.$submitted || registroUsuario.pass.$touched">
							<span class="text-danger" ng-show="registroUsuario.pass.$error.required">El campo es obligatorio.</span>
		      			</div>
					</div>
					<div class="form-group">
					    <label for="pass">Reingrese su contraseña</label>
					    <input type="password" class="form-control" id="passValid" name="passValid" placeholder="Reingrese su contraseña" ng-model="passValid" ng-model-option="{updateOn: 'blur'} " required pw-check="pass">
					    <div  ng-show="registroUsuario.$submitted || registroUsuario.pass.$touched">
							<span class="text-danger" ng-show="registroUsuario.pass.$error.required">El campo es obligatorio.</span>
							<span class="text-danger" ng-show="registroUsuario.passValid.$error.pwmatch">La contraseña no coincide.</span>
		      			</div>
					</div>
					<div class="form-group">			    
					    <input type="submit" class="btn btn-success pull-right" id="submit"  ng-click="submitFormulario(registroUsuario.$valid)">
					</div>
				</div>
			</div>
		</form>
	</div>
</div>



</body>
</html>