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
        $consulta  = "INSERT INTO marca (descripcion) VALUE (?)";

        $stmt = mysqli_prepare($conexcion, $consulta);
        mysqli_stmt_bind_param($stmt, 's', $this->descripcion);
        mysqli_stmt_execute($stmt);
    }

    public static function listarMarcas($conexion){
        $consulta = "SELECT id_marca id,
                    descripcion
                    FROM marca";

        $resultado = mysqli_query($conexion, $consulta);

        $output = array();
        while ($fila = mysqli_fetch_assoc($resultado)){
            $fila['descripcion'] = utf8_encode($fila['descripcion']);
            $output[] = $fila;
        }

        return $output;
    }

    public static function buscarMarcaPorId($conexxion, $id){
        $consulta = "SELECT id_marca id, descripcion
                     FROM marca
                     WHERE id_marca = ?";

        $stmt = mysqli_prepare($conexxion, $consulta);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $respuesta = mysqli_stmt_get_result($stmt);
        $resultado = mysqli_fetch_assoc($respuesta);

        return $resultado;


    }

    public static function editarMarca($conexion, $id, $descripcion){
        $consulta = "UPDATE marca
                    SET descripcion = ?
                    WHERE id_marca = ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "si", $descripcion, $id);
        mysqli_stmt_execute($stmt);
    }
}