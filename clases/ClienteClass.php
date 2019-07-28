<?php


Class Cliente{
	private $id;
	private $nombre;
	private $usuario;//obsoleto
	private $apellido;
	private $telefono;
	private $email;
	private $fechaNacimiento;
	private $pass;
	private $codPostal;
	private $domicilio;
	private $admin;
	private $localidad;

	function __construct($id, 
						$nombre, 
						$usuario, 
						$apellido, 
						$telefono, 
						$email, 
						$fechaNacimiento, 
						$pass, 
						$codPostal,
						$domicilio,
						$admin,
						$localidad){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->usuario = $usuario;
		$this->apellido = $apellido;
		$this->telefono = $telefono;
		$this->email = $email;
		$this->fechaNacimiento = $fechaNacimiento;
		$this->pass = $pass;
		$this->codPostal = $codPostal;
		$this->domicilio = $domicilio;
		$this->admin = $admin;
		$this->localidad = $localidad;

	}

	public static function obtenerClientePorId($id){

	}
	
	public static function cargarLocalidades($conexion, $idProvincia){
		//se prepara consulta para la base de datos
		$consulta = "SELECT id,
						localidad
						FROM localidad
						WHERE id_provincia = $1";
		
		//================= MySQL =============================
		// //SE REALIZA EL PREPARE DE LA CONSULTA CON LA CONEXION
		// //$stmt = $con->prepare($consulta);
		// $stmt = mysqli_prepare($conexion, $consulta);
		// //BINDEO DE DATOS
		// mysqli_stmt_bind_param($stmt, "i", $idProvincia);
		// //EJECUCION DE LA CONSULTA
		// mysqli_stmt_execute($stmt);
		// //CAPTURA DEL RESULTADO
		// $resultado = mysqli_stmt_get_result($stmt);

		// $output = array();
		// //ARMADO DEL ARRAY PARA RETORNO DE LA FUNCION
		// while ($fila = mysqli_fetch_assoc($resultado)) {
		// 	$fila['id_localidad'] = (int)$fila['id_localidad'];
		// 	$fila['localidad'] = utf8_encode($fila['localidad']);
		// 	$output[] = $fila;
		// }

		//================= Postgres =============================
		$result = pg_query_params($conexion, $consulta, array($idProvincia));
		$output = array();
		while($fila = pg_fetch_assoc($result))
			$output[] = $fila;
		return $output;
	}

    public static function cargarProvincias($conexion){
        //se prepara consulta para la base de datos
        $consulta = "SELECT id,
					provincia 
				 	FROM provincia";
		//============ MySQL =========================
        // //SE REALIZA LA CONSULTA CON LA CONEXION
        // $resultado = mysqli_query($conexion, $consulta);

        // $output = array();
        // //ARMADO DEL ARRAY PARA RETORNO DE LA FUNCION
        // while ($fila = mysqli_fetch_assoc($resultado)) {
        //     $fila['id_provincia'] = (int)$fila['id_provincia'];
        //     $fila['provincia'] = utf8_encode($fila['provincia']);
        //     $output[] = $fila;
		// }
		
		//============ Postgres =========================
		$result = pg_query($conexion, $consulta);
		$output = array();
		while($fila = pg_fetch_assoc($result))
			$output[] = $fila;
        return $output;
    }

	public static function listarEmail($conexion){
		$consulta = "SELECT email
					FROM cliente";

		//================ MySQL ================
		// $resultado = mysqli_query($conexion, $consulta);
		// $output = array();
		// while($fila = mysqli_fetch_assoc($resultado)){
		// 	$output[] = $fila;
		// }

		//=============== POSTGRES ================
		$resultado = pg_query($conexion, $consulta);
		$output = array();
		while($fila = pg_fetch_assoc($resultado)){
			$output[] = $fila['email'];
		}

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
					id_localidad) VALUES 
					($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11)
					RETURNING id";

		//============== MySQL =======================
		// $stmt = mysqli_prepare($conexion, $consulta);
		// //ssssssisidi
		// mysqli_stmt_bind_param($stmt, "ssssssisisi", 
		// 						$this->usuario,
		// 						$this->email,
		// 						$this->pass,
		// 						$this->telefono,
		// 						$this->nombre,
		// 						$this->apellido,
		// 						$this->codPostal,
		// 						$this->domicilio,
		// 						$this->admin,
		// 						$this->fechaNacimiento, 
		// 						$this->localidad);
		// mysqli_stmt_execute($stmt);
		// //para obtener el ultimo id autogenerado
		// $id = mysqli_insert_id($conexion);

		//=============== POSTGRES ===================
		$params = array($this->usuario, $this->email, $this->pass, $this->telefono, $this->nombre, $this->apellido, $this->codPostal, $this->domicilio,
		$this->admin, $this->fechaNacimiento, $this->localidad);
		$retorno = pg_query_params($conexion, $consulta, $params);
		$respuesta = pg_fetch_array($retorno);
		$id = $respuesta[0];
		return $id;
	}

	function getArraySession($conexion, $id){
		$sql = "SELECT id,
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
				WHERE id = $1;";

		//=================== MySQL =====================
		// $resultado = mysqli_query($conexion, $sql);
		// $fila = mysqli_fetch_assoc($resultado);

		//=================== POSTGRES ==================
		$resultado = pg_query_params($sql, array($id));
		$fila = pg_fetch_assoc($resultado);
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
					WHERE email = $1 and pass = $2";

		//==================== MySQL ==================
		// $stmt = mysqli_prepare($conexion, $consulta);
		// mysqli_stmt_bind_param($stmt, "ss", $email,
		// 									$pass);
		// mysqli_stmt_execute($stmt);

		// $respuesta = mysqli_stmt_fetch($stmt);

		//==================== POSTGRES ================
		$result = pg_query_params($conexion, $consulta, array($email, $pass));
		$respuesta = false;
		while(pg_fetch_assoc($result))
			$respuesta = true;

		return $respuesta;
	}

	public static function obtenerCliente($conexion, $email, $pass){
		$consulta = "SELECT id,
							usuario,
							email,
							nombre,
							apellido,
							admin
					FROM cliente
					WHERE email = $1 and pass = $2";
		//================ MySQL =======================
		// $stmt = mysqli_prepare($conexion, $consulta);
		// mysqli_stmt_bind_param($stmt, "ss", $email,
		// 									$pass);
		// mysqli_stmt_execute($stmt);
		// $resultado = mysqli_stmt_get_result($stmt);
		// $respuesta = mysqli_fetch_assoc($resultado);

		//================ POSTGRES =======================
		$respuesta = pg_query_params($conexion, $consulta, array($email, $pass));
		$fila = pg_fetch_assoc($respuesta);
		return $fila;
	}

	public static function listarClientes($conexion, $admin, $desde, $limite){
		$consulta = "SELECT C.id,
							C.usuario,
							C.email,
							C.nombre,
							C.apellido,
							C.domicilio,
							C.admin,
							C.fecha_nacimiento fechanacimiento,
							L.localidad
					FROM cliente C
					LEFT JOIN localidad L ON C.id_localidad = L.id
					WHERE C.admin = $1
					LIMIT $2 OFFSET $3";


		//================= MySQL ==========================
		// $stmt = mysqli_prepare($conexion, $consulta);
		// mysqli_stmt_bind_param($stmt, 'iii', $admin, $desde, $limite);
		// mysqli_stmt_execute($stmt);
		// $resultado = mysqli_stmt_get_result($stmt);
		// $output = array();
		// while ($fila=mysqli_fetch_assoc($resultado)) {
		// 	$fila['localidad'] = utf8_encode($fila['localidad']);
		// 	$output[] = $fila;	
		// }

		//================= Postgres ==========================
		$result = pg_query_params($conexion, $consulta, array($admin, $limite, $desde));
		$output = array();
		while($fila = pg_fetch_assoc($result))
			$output[] = $fila;
		return $output;
	}

	public static function darPermisoDeAdministrador($conexion, $idUsuario, $permiso){
		$consulta = "UPDATE cliente
					SET admin = $1
					WHERE id = $2";

		//================== MySQL =====================
		// $stmt = mysqli_prepare($conexion, $consulta);
		// mysqli_stmt_bind_param($stmt, 'ii', $permiso, $idUsuario);
		// mysqli_stmt_execute($stmt);
		// $output = mysqli_stmt_affected_rows($stmt);
		
		//================== Postgres =====================
		$result = pg_query_params($conexion, $consulta, array($permiso, $idUsuario));
		$output = pg_affected_rows($result);
        return $output;
	}
}


?>