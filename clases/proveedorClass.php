<?php

Class Proveedor{
	private $id;
	private $nombre;
	private $telefono;
	private $direccion;
	private $codPostal;
	private $email;
	private $localidad;

	function __construct($id,
                        $nombre,
                        $telefono,
                        $direccion,
                        $codPostal,
                        $email,
                        $localidad
                        ){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->telefono = $telefono;
		$this->direccion = $direccion;
		$this->codPostal = $codPostal;
		$this->email = $email;
		$this->localidad = $localidad;
	}

	public function persistirse($conexion){
	    $query = "INSERT INTO proveedor 
                  (nombre,
                  telefono,
                  direccion,
                  codigo_postal,
                  email,
                  id_localidad) VALUES 
                  (?,?,?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt,'sssisi',
                                $this->nombre,
                                $this->telefono,
                                $this->direccion,
                                $this->codPostal,
                                $this->email,
                                $this->localidad);
		mysqli_stmt_execute($stmt);
		
		//====================== Postgres ===============
        // pg_query_params($conexion, $query, array($this->nombre, $this->telefono, $this->direccion, $this->codPostal,
        //     $this->email, $this->localidad));
    }

    public function buscarNombre($conexion){
	    $consulta = "SELECT * FROM proveedor
                    WHERE nombre = ?";

	    $stmt = mysqli_prepare($conexion, $consulta);
	    mysqli_stmt_bind_param($stmt, 's', $this->nombre);
	    mysqli_stmt_execute($stmt);
		$resultado = mysqli_stmt_fetch($stmt);
		
		//==================== Postgres ====================
		// $result = pg_query_params($conexion, $consulta, array($this->nombre));
		// $resultado = false;
		// while(pg_fetch_assoc($result))
		// 	$resultado = true;

	    return $resultado;

    }

    public static function listarProveedores($conexion){
        $consulta = "SELECT P.id, 
                        P.nombre,
                        P.telefono,
                        P.direccion,
                        P.codigo_postal codigoPostal,
                        P.email,
                        L.localidad 
                    FROM proveedor P 
					LEFT JOIN localidad L ON P.id_localidad=L.id";

        $resultado = mysqli_query($conexion, $consulta);
        $output = array();
        while ($fila = mysqli_fetch_assoc($resultado)){
            $fila['localidad'] = utf8_encode($fila['localidad']);
            $output[] = $fila;
		}
		
		//===================== Postgres ==================
		// $result = pg_query($conexion, $consulta);
		// $output = array();
		// while($fila = pg_fetch_assoc($result))
		// 	$output[] = $fila;

        return $output;
    }

    public static function obtenerProveedorPorId($conexion, $id){
        $consulta = "SELECT P.id,
                    P.nombre,
                    P.telefono,
                    P.direccion,
                    P.codigo_postal codigoPostal,
                    P.email,
                    L.id idLocalidad,
                    L.localidad,
                    PR.id idProvincia
                    FROM proveedor P 
					LEFT JOIN localidad L ON P.id_localidad = L.id 
                    JOIN provincia PR ON PR.id = L.id_provincia
                    WHERE P.id = ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        //probando la conexion
        if ( !$stmt ) {
            die('mysqli error: '.mysqli_error($conexion));
        }
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);
        $respuesta = mysqli_fetch_assoc($resultado);
		$respuesta['localidad'] = utf8_encode($respuesta['localidad']);
		
		//===================== Postgres ===================
		// $result = pg_query_params($conexion, $consulta, array($id));
		// $respuesta = pg_fetch_assoc($result);
        return $respuesta;
    }

    public function editarse($conexion){
        $consulta = "UPDATE proveedor 
                      SET nombre = ?,
                          telefono = ?,
                          direccion = ?,
                          codigo_postal = ?,
                          email = ?,
                          id_localidad = ?
                      WHERE id = ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt,"sssisii",
            $this->nombre,
            $this->telefono,
            $this->direccion,
            $this->codPostal,
            $this->email,
            $this->localidad,
            $this->id);
		mysqli_stmt_execute($stmt);
        
		//================= Postgres ==================
		// $result = pg_query_params($conexion, $consulta, array(
		// 	$this->nombre, $this->telefono, $this->direccion, $this->codPostal, $this->email, $this->localidad, $this->id
		// ));
    }
}
?>