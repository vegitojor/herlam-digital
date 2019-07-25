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
                  cod_postal,
                  mail,
                  id_localidad) VALUES 
                  (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexion, $query);

        mysqli_stmt_bind_param($stmt,'sssisi',
                                $this->nombre,
                                $this->telefono,
                                $this->direccion,
                                $this->codPostal,
                                $this->email,
                                $this->localidad);

        mysqli_stmt_execute($stmt);
    }

    public function buscarNombre($conexion){
	    $consulta = "SELECT * FROM proveedor
                    WHERE nombre = ?";

	    $stmt = mysqli_prepare($conexion, $consulta);

	    mysqli_stmt_bind_param($stmt, 's', $this->nombre);

	    mysqli_stmt_execute($stmt);

	    $resultado = mysqli_stmt_fetch($stmt);

	    return $resultado;

    }

    public static function listarProveedores($conexion){
        $consulta = "SELECT P.id_proveedor id, 
                        P.nombre,
                        P.telefono,
                        P.direccion,
                        P.cod_postal codigoPostal,
                        P.mail email,
                        L.localidad localidad
                    FROM proveedor P JOIN localidad L ON P.id_localidad=L.id_localidad;";

        $resultado = mysqli_query($conexion, $consulta);
        $output = array();
        while ($fila = mysqli_fetch_assoc($resultado)){
            $fila['localidad'] = utf8_encode($fila['localidad']);
            $output[] = $fila;
        }

        return $output;
    }

    public static function obtenerProveedorPorId($conexion, $id){
        $consulta = "SELECT P.id_proveedor id,
                    P.nombre,
                    P.telefono,
                    P.direccion,
                    P.cod_postal codigoPostal,
                    P.mail email,
                    L.id_localidad idLocalidad,
                    L.localidad localidad,
                    PR.id_provincia idProvincia
                    FROM proveedor P JOIN localidad L ON P.id_localidad = L.id_localidad 
                    JOIN provincia PR ON PR.id_provincia = L.id_provincia
                    WHERE P.id_proveedor = ?";

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
        return $respuesta;
    }

    public function editarse($conexion){
        $consulta = "UPDATE proveedor 
                      SET nombre = ?,
                          telefono = ?,
                          direccion = ?,
                          cod_postal = ?,
                          mail = ?,
                          id_localidad = ?
                      WHERE id_proveedor = ?";

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
    }
}
?>