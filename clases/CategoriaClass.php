<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 12/10/17
 * Time: 22:59
 */

class Categoria
{
    private $id;
    private $descripcion;
    private $fichaTecnica;

    /*function __construct($id, $descripcion, $fichaTecnica)
    {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->fichaTecnica = $fichaTecnica;
    }*/

    function __construct(){
      $i = func_num_args();

      if($i == 1){
        $id = func_get_arg(0);
        $this->id = $id;
      }elseif ($i == 3) {
         $this->id = func_get_arg(0);
        $this->descripcion = func_get_arg(1);
        $this->fichaTecnica = func_get_arg(2);
      }
    }

    public function guardarCategoria($conexion){
        $consulta = "INSERT INTO categoria(descripcion, id_Ficha_tecnica) 
                        VALUES (? , ?)";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'si', $this->descripcion, $this->fichaTecnica);
        mysqli_stmt_execute($stmt);
    }

    public function traerNombreCategoria($conexion){
        $consulta = "SELECT descripcion
                    FROM categoria
                    WHERE categoria.id_categoria = ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'i', $this->id);
        mysqli_stmt_execute($stmt);

        $resultado = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

        return $resultado;
    }
    
    public function editarCategoria($conexion, $nombre){
        $consulta = "UPDATE categoria
                        SET descripcion = ?
                        WHERE id_categoria = ?";

         $stmt = mysqli_prepare($conexion, $consulta);
         mysqli_stmt_bind_param($stmt, 'si', $nombre, $this->id);
         mysqli_stmt_execute($stmt);

         $output = mysqli_stmt_affected_rows($stmt);
        return $output;

    }

    public static function listarCategorias($conexion){
        $consulta = "SELECT id_categoria id,
                        descripcion,
                        ft.nombre_ficha fichaTecnica
                        FROM categoria c
                        JOIN ficha_tecnica ft ON ft.id_Ficha_tecnica = c.id_Ficha_tecnica
                        ORDER BY c.id_categoria";
        $respuesta = mysqli_query($conexion, $consulta);
        $output = array();
        while($fila = mysqli_fetch_assoc($respuesta)){
            $fila['descripcion'] = utf8_encode($fila['descripcion']);
            $output[] = $fila;
        }
        return $output;
    }

}