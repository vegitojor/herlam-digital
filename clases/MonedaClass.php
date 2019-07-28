<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 21/10/17
 * Time: 11:03
 */

class Moneda
{
    private $id;
    private $descripcion;
    private $valor;
    private $activo;

    function __construct($id, $descripcion, $valor, $activo)
    {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->valor = $valor;
        $this->activo = $activo;
    }

    public static function listarMonedas($conexion){
        $consulta = "SELECT id,
                    descripcion,
                    valor_en_pesos valor,
                    activo
                    FROM moneda
                    ORDER BY descripcion ASC";

        // $respuesta = mysqli_query($conexion, $consulta);
        // $output = array();
        // while ($fila = mysqli_fetch_assoc($respuesta)){
        //     $fila['descripcion'] = utf8_encode($fila['descripcion']);
        //     $output[] = $fila;
        // }

        //================= Postgres =========================
        $result = pg_query($conexion, $consulta);
        $output = array();
        while($fila = pg_fetch_assoc($result))
            $output[] = $fila;

        return $output;
    }

    public function persistirMoneda($conexion){
        $consulta = "INSERT INTO moneda (descripcion, valor_en_pesos, activo)
                      VALUES ($1, $2, $3)";

        // $stmt = mysqli_prepare($conexion, $consulta);
        // mysqli_stmt_bind_param($stmt, "sdi", $this->descripcion, $this->valor, $this->activo);
        // mysqli_stmt_execute($stmt);

        //==================== Postgres =================
        pg_query_params($conexion, $consulta, array($this->descripcion, $this->valor, $this->activo));
    }

    public static function obtenerUnaMonedaPorId($conexion, $id){
        $consulta = "SELECT id,
                    descripcion,
                    valor_en_pesos valor,
                    activo
                    FROM  moneda
                    WHERE id = $1";

        // $stmt = mysqli_prepare($conexion, $consulta);
        // mysqli_stmt_bind_param($stmt, "i", $id);
        // mysqli_stmt_execute($stmt);
        // $resultado = mysqli_stmt_get_result($stmt);
        // $fila = mysqli_fetch_assoc($resultado);
        // $fila['valor'] = (float)$fila['valor'];

        //============= Postgres =====================
        $result = pg_query_params($conexion, $consulta, array($id));
        $fila = pg_fetch_assoc($result);
        return $fila;
    }

    public function editarMoneda($conexion){
        $consulta = "UPDATE moneda
                    SET descripcion = $1,
                    valor_en_pesos = $2
                    WHERE id = $3";

        // $stmt = mysqli_prepare($conexion, $consulta);
        // mysqli_stmt_bind_param($stmt, 'sdi', $this->descripcion,
        //                                             $this->valor,
        //                                             $this->id);
        // mysqli_stmt_execute($stmt);

        //===================== Postgres ==================
        pg_query_params($conexion, $consulta, array($this->descripcion, $this->valor,$this->id));
    }

    public static function traerMonedaActiva($conexion){
        $consulta = "SELECT  id,
                        descripcion,
                        valor_en_pesos AS valor
                    FROM moneda 
                    WHERE activo = true";
        // $respuesta = mysqli_query($conexion, $consulta);
        // $output = mysqli_fetch_assoc($respuesta);

        //======================== Postgres ===============
        $result = pg_query($conexion, $consulta);
        $output = pg_fetch_assoc($result);
        return $output;
    }

    public static function cambiarActivoMoneda($conexion, $id, $activo){
        $consulta = "UPDATE moneda
                    SET activo = $1
                    WHERE id = $2";

        // $stmt = mysqli_prepare($conexion, $consulta);
        // mysqli_stmt_bind_param($stmt, 'ii', $activo, $id);
        // mysqli_stmt_execute($stmt);
        // $respuesta = mysqli_stmt_affected_rows($stmt);

        //================ Postgres =======================
        $result = pg_query_params($conexion, $consulta, array($activo, $id));
        $respuesta = pg_affected_rows($result);
        return $respuesta;
    }
}