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
        $consulta = "INSERT INTO categoria(nombre, id_Ficha_tecnica) 
                        VALUES (? , ?)";
        //=============== MySQL ======================
        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'si', $this->descripcion, $this->fichaTecnica);
        mysqli_stmt_execute($stmt);

        //=============== POSTGRES ======================
        // pg_query_params($conexion, $consulta, array($this->descripcion, $this->fichaTecnica));
    }

    public function traerNombreCategoria($conexion){
        $consulta = "SELECT nombre
                    FROM categoria
                    WHERE categoria.id = ?";

        //=================== MySQL =====================
        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'i', $this->id);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

        //=================== POSTGRES =====================
        // $result = pg_query_params($conexion, $consulta, array($this->id));
        // $resultado = pg_fetch_assoc($result);

        return $resultado;
    }
    
    public function editarCategoria($conexion, $nombre){
        $consulta = "UPDATE categoria
                        SET nombre = ?
                        WHERE id = ?";
        //============== MySQL ===========================
        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'si', $nombre, $this->id);
        mysqli_stmt_execute($stmt);
        $output = mysqli_stmt_affected_rows($stmt);

        //============== POSTGRES ===========================
        // $result = pg_query_params($conexion, $consulta, array($nombre, $this->id));
        // $output = pg_affected_rows($result);
        return $output;

    }

    public static function listarCategorias($conexion){
        $consulta = "SELECT  c.id,
                        c.nombre,
                        ft.nombre ficha_tecnica  
                        FROM categoria c
                        LEFT JOIN ficha_tecnica ft ON ft.id = c.id_Ficha_tecnica
                        ORDER BY c.id";
        
        //================= MySQL ========================
        $respuesta = mysqli_query($conexion, $consulta);
        $output = array();
        while($fila = mysqli_fetch_assoc($respuesta)){
            $fila['nombre'] = utf8_encode($fila['nombre']);
            $output[] = $fila;
        }

        //================= POSTGRES ========================
        // $result = pg_query($conexion, $consulta);
        // $output = array();
        // while($fila = pg_fetch_assoc($result)){
        //     $output[] = $fila;
        // }
        return $output;
    }

}