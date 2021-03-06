<?php


Class Cliente{
	private $id;
	private $nombre;
	private $usuario;//Mostrado como RAZON SOCIAL	
	private $apellido;
	private $telefono;
	private $celular;
	private $email;
	private $fechaNacimiento;
	private $pass;
	private $codPostal;
	private $domicilio;
	private $admin;
	private $localidad;
	private $existe;
	private $depto;
	private $piso;
	private $cuitCuil;
	private $condicionIva;
	private $supervisor;

	function __construct($id, 
						$nombre, 
						$usuario, 
						$apellido, 
						$telefono, 
						$celular,
						$email, 
						$fechaNacimiento, 
						$pass, 
						$codPostal,
						$domicilio,
						$admin,
						$localidad,
						$depto,
						$piso,
						$cuitCuil,
						$condicionIva){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->usuario = $usuario;
		$this->apellido = $apellido;
		$this->telefono = $telefono;
		$this->celular = $celular;
		$this->email = $email;
		$this->fechaNacimiento = $fechaNacimiento;
		$this->pass = $pass;
		$this->codPostal = $codPostal;
		$this->domicilio = $domicilio;
		$this->admin = $admin;
		$this->localidad = $localidad;
		$this->existe = 1;
		$this->depto = $depto;
		$this->piso = $piso;
		$this->cuitCuil = $cuitCuil;
		$this->condicionIva = $condicionIva;
		$this->supervisor = 0;

	}

	public static function obtenerClientePorId($id){

	}
	
	public static function cargarLocalidades($conexion, $idProvincia){
		//se prepara consulta para la base de datos
		$consulta = "SELECT id,
						localidad
						FROM localidad
						WHERE id_provincia = ?";
		
		//================= MySQL =============================
		//SE REALIZA EL PREPARE DE LA CONSULTA CON LA CONEXION
		//$stmt = $con->prepare($consulta);
		$stmt = mysqli_prepare($conexion, $consulta);
		//BINDEO DE DATOS
		mysqli_stmt_bind_param($stmt, "i", $idProvincia);
		//EJECUCION DE LA CONSULTA
		mysqli_stmt_execute($stmt);
		//CAPTURA DEL RESULTADO
		$resultado = mysqli_stmt_get_result($stmt);

		$output = array();
		//ARMADO DEL ARRAY PARA RETORNO DE LA FUNCION
		while ($fila = mysqli_fetch_assoc($resultado)) {
			$fila['id'] = (int)$fila['id'];
			$fila['localidad'] = utf8_encode($fila['localidad']);
			$output[] = $fila;
		}

		//================= Postgres =============================
		// $result = pg_query_params($conexion, $consulta, array($idProvincia));
		// $output = array();
		// while($fila = pg_fetch_assoc($result))
		// 	$output[] = $fila;
		return $output;
	}

    public static function cargarProvincias($conexion){
        //se prepara consulta para la base de datos
        $consulta = "SELECT id,
					provincia 
				 	FROM provincia";
		//============ MySQL =========================
        //SE REALIZA LA CONSULTA CON LA CONEXION
        $resultado = mysqli_query($conexion, $consulta);

        $output = array();
        //ARMADO DEL ARRAY PARA RETORNO DE LA FUNCION
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $fila['id'] = (int)$fila['id'];
            $fila['provincia'] = utf8_encode($fila['provincia']);
            $output[] = $fila;
		}
		
		//============ Postgres =========================
		// $result = pg_query($conexion, $consulta);
		// $output = array();
		// while($fila = pg_fetch_assoc($result))
		// 	$output[] = $fila;
        return $output;
    }

	public static function listarEmail($conexion){
		$consulta = "SELECT email
					FROM cliente
					WHERE existe = 1";

		//================ MySQL ================
		$resultado = mysqli_query($conexion, $consulta);
		$output = array();
		while($fila = mysqli_fetch_assoc($resultado)){
			$output[] = $fila;
		}

		//=============== POSTGRES ================
		// $resultado = pg_query($conexion, $consulta);
		// $output = array();
		// while($fila = pg_fetch_assoc($resultado)){
		// 	$output[] = $fila['email'];
		// }

		return $output;
	}

	function getEmail(){
		return $this->email;
	}

	function persistirse($conexion){
		$consulta = "INSERT INTO cliente 
					(usuario,
					email,
					pass,
					telefono,
					nombre,
					apellido,
					codigo_postal,
					domicilio,
					admin,
					fecha_nacimiento,
					id_localidad,
					existe,
					depto,
					piso,
					cuit_cuil,
					id_condicion_iva, 
					supervisor,
					celular) VALUES 
					(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

					//RETURNING id  //<---- solo para postgres

		//============== MySQL =======================
		$stmt = mysqli_prepare($conexion, $consulta);
		//ssssssisidi
		mysqli_stmt_bind_param($stmt, "ssssssisisiisssiis", 
								$this->usuario,
								$this->email,
								$this->pass,
								$this->telefono,
								$this->nombre,
								$this->apellido,
								$this->codPostal,
								$this->domicilio,
								$this->admin,
								$this->fechaNacimiento, 
								$this->localidad,
								$this->existe,
								$this->depto,
								$this->piso,
								$this->cuitCuil,
								$this->condicionIva,
								$this->supervisor,
								$this->celular
							);
		mysqli_stmt_execute($stmt);
		//para obtener el ultimo id autogenerado
		$id = mysqli_insert_id($conexion);

		//=============== POSTGRES ===================
		// $params = array($this->usuario, $this->email, $this->pass, $this->telefono, $this->nombre, $this->apellido, $this->codPostal, $this->domicilio,
		// $this->admin, $this->fechaNacimiento, $this->localidad, $this->existe);
		// $retorno = pg_query_params($conexion, $consulta, $params);
		// $respuesta = pg_fetch_array($retorno);
		// $id = $respuesta[0];
		return $id;
	}

	function getArraySession($conexion, $id){
		$sql = "SELECT id,
						usuario,
						email,
						telefono,
						nombre,
						apellido,
						codigo_postal codigo_postal,
						domicilio,
						admin as admin_,
						fecha_nacimiento fecha_nacimiento,
						piso,
						depto,
						cuit_cuil,
						id_condicion_iva,
						id_localidad id_localidad
				FROM cliente
				WHERE id = ? AND existe = 1";

		//=================== MySQL =====================
		$resultado = mysqli_prepare($conexion, $sql);
		mysqli_stmt_bind_param($resultado, 'i', $id);
		mysqli_stmt_execute($resultado);
		$fila = mysqli_fetch_assoc(mysqli_stmt_get_result($resultado));
		$fila['usuario'] = utf8_encode($fila['usuario']);
		$fila['nombre'] = utf8_encode($fila['nombre']);
		$fila['apellido'] = utf8_encode($fila['apellido']);
		$fila['domicilio'] = utf8_encode($fila['domicilio']);
		$fila['piso'] = utf8_encode($fila['piso']);
		$fila['depto'] = utf8_encode($fila['depto']);

		//=================== POSTGRES ==================
		// $resultado = pg_query_params($sql, array($id));
		// $fila = pg_fetch_assoc($resultado);
		return $fila;
	}

	public static function consultarCliente($conexion, $email, $pass){
		$consulta = "SELECT id,
							usuario,
							email,
							pass,
							telefono,
							nombre,
							apellido,
							codigo_postal codPostal,
							domicilio,
							admin,
							fecha_nacimiento fechaNacimiento,
							id_localidad idLocalidad
					FROM cliente
					WHERE email = ? and pass = ? AND existe = 1";

		//==================== MySQL ==================
		$stmt = mysqli_prepare($conexion, $consulta);
		mysqli_stmt_bind_param($stmt, "ss", $email,
											$pass);
		mysqli_stmt_execute($stmt);

		$respuesta = mysqli_stmt_fetch($stmt);

		//==================== POSTGRES ================
		// $result = pg_query_params($conexion, $consulta, array($email, $pass));
		// $respuesta = false;
		// while(pg_fetch_assoc($result))
		// 	$respuesta = true;

		return $respuesta;
	}

	public static function obtenerCliente($conexion, $email, $pass){
		$consulta = "SELECT id,
							usuario,
							email,
							nombre,
							apellido,
							admin,
							supervisor,
							activo,
							id_localidad,
							domicilio,
							piso,
							depto,
							cuit_cuil,
							id_condicion_iva,
							codigo_postal,
							celular
					FROM cliente
					WHERE email = ? and pass = ?";
		//================ MySQL =======================
		$stmt = mysqli_prepare($conexion, $consulta);
		mysqli_stmt_bind_param($stmt, "ss", $email,
											$pass);
		mysqli_stmt_execute($stmt);
		$resultado = mysqli_stmt_get_result($stmt);
		$respuesta = mysqli_fetch_assoc($resultado);

		$respuesta['usuario'] = utf8_encode($respuesta['usuario']);
		$respuesta['nombre'] = utf8_encode($respuesta['nombre']);
		$respuesta['apellido'] = utf8_encode($respuesta['apellido']);
		$respuesta['domicilio'] = utf8_encode($respuesta['domicilio']);
		$respuesta['piso'] = utf8_encode($respuesta['piso']);
		$respuesta['depto'] = utf8_encode($respuesta['depto']);

		//================ POSTGRES =======================
		// $respuesta = pg_query_params($conexion, $consulta, array($email, $pass));
		// $fila = pg_fetch_assoc($respuesta);
		return $respuesta;
	}

	public static function listarClientes($conexion, $admin, $desde, $limite, $supervisor, $nombre, $apellido, $cuil, $razonSocial){

		if($nombre == null){
			$nombre = '%%';
		}
		if($apellido == null){
			$apellido = '%%';
		}
		if($cuil == null){
			$cuil = '%%';
		}
		if($razonSocial == null){
			$razonSocial = '%%';
		}	
		
		$filtros = 'AND C.nombre like CONCAT("%",?,"%")  
					AND C.apellido like CONCAT("%",?,"%")  
					AND C.cuit_cuil like CONCAT("%",?,"%")  
					AND C.usuario like CONCAT("%",?,"%")  ';
		if($admin == 1 || $supervisor == 1)
			$filtros = '';

		$consulta = "SELECT C.id,
							C.usuario,
							C.email,
							C.telefono,
							C.nombre,
							C.apellido,
							C.codigo_postal,
							C.domicilio,
							C.admin,
							C.fecha_nacimiento fechanacimiento,
							C.activo,
							C.depto,
							C.piso,
							C.cuit_cuil,
							C.id_condicion_iva,
							L.localidad,
							p.provincia,
							C.celular
					FROM cliente C
					LEFT JOIN localidad L ON C.id_localidad = L.id
					LEFT JOIN provincia p ON p.id = L.id_provincia
					WHERE C.admin = ? AND C.existe = 1
					AND C.supervisor = ? ";
					
		$limiteQuery = " LIMIT ?, ?";

		$consulta = $consulta . $filtros . $limiteQuery;
		
		//================= MySQL ==========================
		$stmt = mysqli_prepare($conexion, $consulta);
		if($admin ==1 || $supervisor == 1){
			mysqli_stmt_bind_param($stmt, 'iiii', $admin, $supervisor, $desde, $limite);
		}else{
			mysqli_stmt_bind_param($stmt, 'iissssii', $admin, $supervisor, $nombre, $apellido, $cuil, $razonSocial, $desde, $limite);
		}
		mysqli_stmt_execute($stmt);
		$resultado = mysqli_stmt_get_result($stmt);
		$output = array();
		while ($fila=mysqli_fetch_assoc($resultado)) {
			$fila['localidad'] = utf8_encode($fila['localidad']);
			$fila['provincia'] = utf8_encode($fila['provincia']);
			$fila['usuario'] = utf8_encode($fila['usuario']);
			$fila['nombre'] = utf8_encode($fila['nombre']);
			$fila['apellido'] = utf8_encode($fila['apellido']);
			$fila['domicilio'] = utf8_encode($fila['domicilio']);
			$fila['depto'] = utf8_encode($fila['depto']);
			$fila['piso'] = utf8_encode($fila['piso']);
			$output[] = $fila;	
		}

		//================= Postgres ==========================
		// $result = pg_query_params($conexion, $consulta, array($admin, $limite, $desde));
		// $output = array();
		// while($fila = pg_fetch_assoc($result))
		// 	$output[] = $fila;
		return $output;
	}

	public static function darPermisoDeAdministrador($conexion, $idUsuario, $permiso){
		$consulta = "UPDATE cliente
					SET admin = ?
					WHERE id = ?";

		//================== MySQL =====================
		$stmt = mysqli_prepare($conexion, $consulta);
		mysqli_stmt_bind_param($stmt, 'ii', $permiso, $idUsuario);
		mysqli_stmt_execute($stmt);
		$output = mysqli_stmt_affected_rows($stmt);
		
		//================== Postgres =====================
		// $result = pg_query_params($conexion, $consulta, array($permiso, $idUsuario));
		// $output = pg_affected_rows($result);
        return $output;
	}

	public static function darPermisoDeSupervisor($conexion, $idUsuario, $permiso){
		$consulta = "UPDATE cliente
					SET supervisor = ?
					WHERE id = ?";

		//================== MySQL =====================
		$stmt = mysqli_prepare($conexion, $consulta);
		mysqli_stmt_bind_param($stmt, 'ii', $permiso, $idUsuario);
		mysqli_stmt_execute($stmt);
		$output = mysqli_stmt_affected_rows($stmt);
		
		//================== Postgres =====================
		// $result = pg_query_params($conexion, $consulta, array($permiso, $idUsuario));
		// $output = pg_affected_rows($result);
        return $output;
	}

	public static function eliminarcliente($conexion, $idUsuario){
		$consulta = "UPDATE cliente
					SET existe = 0
					WHERE id = ?";

		//================== MySQL =====================
		$stmt = mysqli_prepare($conexion, $consulta);
		mysqli_stmt_bind_param($stmt, 'i', $idUsuario);
		mysqli_stmt_execute($stmt);
		$output = mysqli_stmt_affected_rows($stmt);
		
		//================== Postgres =====================
		// $result = pg_query_params($conexion, $consulta, array($permiso, $idUsuario));
		// $output = pg_affected_rows($result);
        return $output;
	}

	public static function activarCliente($conexion, $idUsuario, $activo){
		$consulta = "UPDATE cliente
					SET activo = ?
					WHERE id = ?";

		//================== MySQL =====================
		$stmt = mysqli_prepare($conexion, $consulta);
		mysqli_stmt_bind_param($stmt, 'ii', $activo, $idUsuario);
		mysqli_stmt_execute($stmt);
		$output = mysqli_stmt_affected_rows($stmt);
		
		//================== Postgres =====================
		// $result = pg_query_params($conexion, $consulta, array($permiso, $idUsuario));
		// $output = pg_affected_rows($result);
        return $output;
	}

	public static function contarCantidadClientes($conexion, $nombre, $apellido, $cuil, $razonSocial){
		if($nombre == null){
			$nombre = '%%';
		}
		if($apellido == null){
			$apellido = '%%';
		}
		if($cuil == null){
			$cuil = '%%';
		}
		if($razonSocial == null){
			$razonSocial = '%%';
		}	
		
		$filtros = ' AND c.nombre like CONCAT("%",?,"%")  
					AND c.apellido like CONCAT("%",?,"%")  
					AND c.cuit_cuil like CONCAT("%",?,"%")  
					AND c.usuario like CONCAT("%",?,"%")  ';

        $consulta = "SELECT count(*) AS cantidad
                    FROM cliente c
					WHERE c.existe = 1 AND c.admin = 0 
					AND c.supervisor = 0 ";
		$consulta = $consulta . $filtros;

        //================== MySQL =======================
		$stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'ssss', $nombre, $apellido, $cuil, $razonSocial);
		mysqli_stmt_execute($stmt);
		$resultado = mysqli_stmt_get_result($stmt);
        $output = mysqli_fetch_assoc($resultado);
        // var_dump($estado);
        // die('query');
        //================== Postgres =======================
        // $result = pg_query($conexion, $consulta);
        // $output = array();
        // while($fila = pg_fetch_assoc($result))
        //     $output[] = $fila;

        return $output;
	}
	
	public static function contarCantidadAdministradores($conexion){
        $consulta = "SELECT count(*) AS cantidad
                    FROM cliente c
                    WHERE c.existe = 1 AND c.admin = 1";

        //================== MySQL =======================
        $resultado = mysqli_query($conexion, $consulta);
        // mysqli_stmt_bind_param($resultado, 'iii', $estado, $cliente, $pedido);
        // mysqli_stmt_execute($resultado);
        $output = mysqli_fetch_assoc($resultado);
        // var_dump($estado);
        // die('query');
        //================== Postgres =======================
        // $result = pg_query($conexion, $consulta);
        // $output = array();
        // while($fila = pg_fetch_assoc($result))
        //     $output[] = $fila;

        return $output;
	}
	
	public static function obtenerMailUsuarioById($conexion, $idUsuario){
		$consulta = "SELECT email
					FROM cliente
					WHERE id = ?";
		//================ MySQL =======================
		$stmt = mysqli_prepare($conexion, $consulta);
		mysqli_stmt_bind_param($stmt, "i", $idUsuario);
		mysqli_stmt_execute($stmt);
		$resultado = mysqli_stmt_get_result($stmt);
		$respuesta = mysqli_fetch_assoc($resultado);
		//================ POSTGRES =======================
		// $respuesta = pg_query_params($conexion, $consulta, array($email, $pass));
		// $fila = pg_fetch_assoc($respuesta);
		return $respuesta;
	}

	public static function obtenerPassUsuarioById($conexion, $idUsuario){
		$consulta = "SELECT pass
					FROM cliente
					WHERE id = ?";
		//================ MySQL =======================
		$stmt = mysqli_prepare($conexion, $consulta);
		mysqli_stmt_bind_param($stmt, "i", $idUsuario);
		mysqli_stmt_execute($stmt);
		$resultado = mysqli_stmt_get_result($stmt);
		$respuesta = mysqli_fetch_assoc($resultado);
		//================ POSTGRES =======================
		// $respuesta = pg_query_params($conexion, $consulta, array($email, $pass));
		// $fila = pg_fetch_assoc($respuesta);
		return $respuesta;
	}

	public static function cambiarPass($conexion, $id, $newPass){
		$consulta = "UPDATE cliente
					SET pass = ?
					WHERE id = ?";

		//================== MySQL =====================
		$stmt = mysqli_prepare($conexion, $consulta);
		mysqli_stmt_bind_param($stmt, 'si', $newPass, $id);
		mysqli_stmt_execute($stmt);
		$output = mysqli_stmt_affected_rows($stmt);
		
		//================== Postgres =====================
		// $result = pg_query_params($conexion, $consulta, array($permiso, $idUsuario));
		// $output = pg_affected_rows($result);
        return $output;
	}

	public static function cambiarCelular($conexion, $id, $celular){
		$consulta = "UPDATE cliente
					SET celular = ?
					WHERE id = ?";

		//================== MySQL =====================
		$stmt = mysqli_prepare($conexion, $consulta);
		mysqli_stmt_bind_param($stmt, 'si', $celular, $id);
		mysqli_stmt_execute($stmt);
		$output = mysqli_stmt_affected_rows($stmt);
		
		//================== Postgres =====================
		// $result = pg_query_params($conexion, $consulta, array($permiso, $idUsuario));
		// $output = pg_affected_rows($result);
        return $output;
	}
}


?>