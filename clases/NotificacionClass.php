<?php

class Notificacion
{
    private $id;
    private $destinatarios;
    private $cantidadDestinatarios;
    private $asunto;
    private $fecha;
    private $usuarioId;
    private $mensaje;

    /* ** Persiste una nueva notificacion ** */
    public static function guardarNotificacion($conexcion, $destinatarios,$asunto, $mensaje, $fecha, $usuarioId, $cantidadDestinatarios){
        $consulta  = "INSERT INTO notificaciones_enviadas (destinatarios, cantidad_destinatarios, asunto, fecha, usuario_id, mensaje) 
                        VALUEs (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexcion, $consulta);
        mysqli_stmt_bind_param($stmt, 'sissis', $destinatarios, $cantidadDestinatarios, $asunto, $fecha, $usuarioId, $mensaje);
        mysqli_stmt_execute($stmt);

        //se obtiene el id autogenerado yse retorna el valor
        $id = mysqli_insert_id($conexcion);
        return $id;

    }

    /* ** Obtiene los destinatarios segun una condicion. Actualmente devuelve todos los mails de usuarios activos. ** */
    public static function obtenerDestinatarios($conexion){
        $activo = 1;
        $consulta = "SELECT C.email
                    FROM cliente C
                    WHERE C.admin = 0 
                    AND C.existe = 1
                    AND C.activo = ?
                    AND C.supervisor = 0 ";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "i", $activo);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        
		$output = array();
		while ($fila=mysqli_fetch_assoc($resultado)) {
			$output[] = implode(";", $fila);	
		}

        return $output;
    }

}