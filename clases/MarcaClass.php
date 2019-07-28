<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 14/10/17
 * Time: 23:12
 */

class Marca
{
    private $id;
    private $descripcion;

    function __construct($id, $descripcion)
    {
        $this->id = $id;
        $this->descripcion = $descripcion;
    }

    public function persistirse($conexcion){
        $consulta  = "INSERT INTO marca (descripcion) VALUEs ($1)";

        // $stmt = mysqli_prepare($conexcion, $consulta);
        // mysqli_stmt_bind_param($stmt, 's', $this->descripcion);
        // mysqli_stmt_execute($stmt);

        //================== Postgres =======================
        pg_query_params($conexcion, $consulta, array($this->descripcion));
    }

    public static function listarMarcas($conexion){
        $consulta = "SELECT id,
                    descripcion
                    FROM marca";

        //================== MySQL =======================
        // $resultado = mysqli_query($conexion, $consulta);
        // $output = array();
        // while ($fila = mysqli_fetch_assoc($resultado)){
        //     $fila['descripcion'] = utf8_encode($fila['descripcion']);
        //     $output[] = $fila;
        // }

        //================== Postgres =======================
        $result = pg_query($conexion, $consulta);
        $output = array();
        while($fila = pg_fetch_assoc($result))
            $output[] = $fila;

        return $output;
    }

    public static function buscarMarcaPorId($conexion, $id){
        $consulta = "SELECT id, descripcion
                     FROM marca
                     WHERE id = $1";

        // $stmt = mysqli_prepare($conexxion, $consulta);
        // mysqli_stmt_bind_param($stmt, 'i', $id);
        // mysqli_stmt_execute($stmt);
        // $respuesta = mysqli_stmt_get_result($stmt);
        // $resultado = mysqli_fetch_assoc($respuesta);

        //================ Postgres ===================
        $result = pg_query_params($conexion, $consulta, array($id));
        $resultado = pg_fetch_assoc($result);

        return $resultado;


    }

    public static function editarMarca($conexion, $id, $descripcion){
        $consulta = "UPDATE marca
                    SET descripcion = $1
                    WHERE id = $2";

        // $stmt = mysqli_prepare($conexion, $consulta);
        // mysqli_stmt_bind_param($stmt, "si", $descripcion, $id);
        // mysqli_stmt_execute($stmt);

        //================== Postgres =======================
        pg_query_params($conexion, $consulta, array($descripcion, $id));
    }
}