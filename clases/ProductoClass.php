<?php

Class Producto{
	private $id;
    private $descripcion;
    private $precio;
    private $mesesGarantia;
    private $nuevo;
    private $codFabricante;
    private $modelo;
    private $disponible;
    private $codProveedor;
    private $fotoProducto;
    private $videoProducto;
    private $categoria;
    private $proveedor;
    private $marca;
    private $sku;
    private $peso;
    private $alto;
    private $ancho;
    private $profundidad;
    private $idProductoFichaTecnica;
    private $destacado;

    /**
     * Producto constructor.
     * @param $id
     * @param $descripcion
     * @param $precio
     * @param $mesesGarantia
     * @param $nuevo
     * @param $codFabricante
     * @param $modelo
     * @param $disponible
     * @param $codProveedor
     * @param $fotoProducto
     * @param $videoProducto
     * @param $categoria
     * @param $proveedor
     * @param $marca
     * @param $sku
     * @param $peso
     * @param $alto
     * @param $ancho
     * @param $profundidad
     * @param $idProductoFichaTecnica
     */
   

    function __construct(){
      $i = func_num_args();

      if($i == 1){
        $id = func_get_arg(0);
        $this->id = $id;
      }elseif ($i == 21) {
		    $this->id = func_get_arg(0);
        $this->descripcion = func_get_arg(1);
        $this->precio = func_get_arg(2);
        $this->mesesGarantia = func_get_arg(3);
        $this->nuevo = func_get_arg(4);
        $this->codFabricante = func_get_arg(5);
        $this->modelo = func_get_arg(6);
        $this->disponible = func_get_arg(7);
        $this->codProveedor = func_get_arg(8);
        $this->fotoProducto = func_get_arg(9);
        $this->videoProducto = func_get_arg(10);
        $this->categoria = func_get_arg(11);
        $this->proveedor = func_get_arg(12);
        $this->marca = func_get_arg(13);
        $this->sku = func_get_arg(14);
        $this->peso = func_get_arg(15);
        $this->alto = func_get_arg(16);
        $this->ancho = func_get_arg(17);
        $this->profundidad = func_get_arg(18);
        $this->idProductoFichaTecnica = func_get_arg(19);
        $this->destacado = func_get_arg(20);
      }
    }

    public function persistirse($conexion){
	    $consulta = "INSERT INTO producto (descripcion, 
                      precio, 
                      meses_garantia, 
                      nuevo, 
                      cod_fabricante, 
                      
                      modelo, 
                      disponible,
                    cod_proveedor, 
                    path_imagen, 
                    path_video,
                     
                    id_categoria, 
                    id_proveedor, 
                    id_marca, 
                    codigo_sku, 
                    peso_caja,
                    
                    alto_caja, 
                    ancho_caja, 
                    profundidad_caja, 
                    id_producto_ficha_tecnica,
                    destacado)
                    VALUES (?,?,?,?,?, ?,?,?,?,?, ?,?,?,?,?, ?,?,?,?,?)";
	    $stmt = mysqli_prepare($conexion, $consulta);
	    mysqli_stmt_bind_param($stmt, "sdiissiissiiisddddii",
            $this->descripcion,
            $this->precio,
            $this->mesesGarantia,
            $this->nuevo,
            $this->codFabricante,

            $this->modelo,
            $this->disponible,
            $this->codProveedor,
            $this->fotoProducto,
            $this->videoProducto,

            $this->categoria,
            $this->proveedor,
            $this->marca,
            $this->sku,
            $this->peso,

            $this->alto,
            $this->ancho,
            $this->profundidad,
            $this->idProductoFichaTecnica,
            $this->destacado);
	    mysqli_stmt_execute($stmt);


    }

   public function obtenerFichaTecnica($conexion){
      $consulta = "SELECT id_producto_ficha_tecnica AS fichaTecnica
                  FROM producto
                  WHERE id_producto = ?";
      $stmt = mysqli_prepare($conexion, $consulta);
      mysqli_stmt_bind_param($stmt, 'i', $this->id);
      mysqli_stmt_execute($stmt);

      $resultado = mysqli_stmt_get_result($stmt);
      $output = mysqli_fetch_assoc($resultado);
      return $output['fichaTecnica'];
   }

   public function editarFichaTecnica($conexion,
                        $campo01,
                        $campo02,
                        $campo03,
                        $campo04,
                        $campo05,
                        $campo06,
                        $campo07,
                        $campo08,
                        $campo09,
                        $campo10,
                        $campo11,
                        $campo12,
                        $campo13,
                        $campo14,
                        $campo15,
                        $campo16,
                        $campo17,
                        $campo18,
                        $campo19,
                        $campo20,
                        $idFichaTecnica){
      $consulta = "UPDATE producto_ficha_tecnica
                  SET campo01 = ?,
                     campo02 = ?,
                     campo03 = ?,
                     campo04 = ?,
                     campo05 = ?,
                     campo06 = ?,
                     campo07 = ?,
                     campo08 = ?,
                     campo09 = ?,
                     campo10 = ?,
                     campo11 = ?,
                     campo12 = ?,
                     campo13 = ?,
                     campo14 = ?,
                     campo15 = ?,
                     campo16 = ?,
                     campo17 = ?,
                     campo18 = ?,
                     campo19 = ?,
                     campo20 = ?
                  WHERE id_producto_ficha_tecnica = ?";
      $stmt = mysqli_prepare($conexion, $consulta);
      mysqli_stmt_bind_param($stmt,'ssssssssssssssssssssi', 
                           $campo01,
                           $campo02,
                           $campo03,
                           $campo04,
                           $campo05,
                           $campo06,
                           $campo07,
                           $campo08,
                           $campo09,
                           $campo10,
                           $campo11,
                           $campo12,
                           $campo13,
                           $campo14,
                           $campo15,
                           $campo16,
                           $campo17,
                           $campo18,
                           $campo19,
                           $campo20,
                           $idFichaTecnica
                           );
      mysqli_stmt_execute($stmt);

      $output = mysqli_stmt_affected_rows($stmt);
      return $output;
   }

   public function editarse($conexion,
                           $modelo,
                           $descripcion,
                           $precio,
                           $mesesGarantia,
                           $codigoFabricante,
                           $codigoProveedor,
                           $sku,
                           $video,
                           $proveedor,
                           $alto,
                           $ancho,
                           $profundidad,
                           $peso,
                           $marca,
                           $categoria,
                           $id){
      $consulta = "UPDATE producto
                  SET descripcion = ?,
                     precio = ?,
                     meses_garantia = ?,
                     cod_fabricante = ?,
                     modelo = ?,
                     cod_proveedor = ?,
                     path_video = ?,
                     id_categoria = ?,
                     id_proveedor = ?,
                     id_marca = ?,
                     codigo_sku = ?,
                     peso_caja = ?,
                     alto_caja = ?,
                     ancho_caja = ?,
                     profundidad_caja = ?
                  WHERE id_producto = ?";
      $stmt = mysqli_prepare($conexion, $consulta);
      mysqli_stmt_bind_param($stmt, 'sdissssiiisddddi', $descripcion,
                           $precio,
                           $mesesGarantia,
                           $codigoFabricante,
                           $modelo,
                           $codigoProveedor,
                           $video,
                           $categoria,
                           $proveedor,
                           $marca,
                           $sku,
                           $peso,
                           $alto,
                           $ancho,
                           $profundidad,
                           $id);
      mysqli_stmt_execute($stmt);
      $output = mysqli_stmt_affected_rows($stmt);
      return $output;

   }

   public function getSku($conexion){
      $consulta = "SELECT codigo_sku sku FROM producto WHERE id_producto = ?";

      $stmt = mysqli_prepare($conexion, $consulta);

      mysqli_stmt_bind_param($stmt, 'i', $this->id);
      mysqli_stmt_execute($stmt);

      $resultado = mysqli_stmt_get_result($stmt);
      return mysqli_fetch_assoc($resultado);
   }

   public function cambiarFoto($conexion, $foto){
      $consulta = "UPDATE producto  
                     SET path_imagen = ?
                     WHERE id_producto = ?";
      $stmt = mysqli_prepare($conexion, $consulta);

      mysqli_stmt_bind_param($stmt, 'si', $foto, $this->id);
      mysqli_stmt_execute($stmt);

      $output = mysqli_stmt_affected_rows($stmt);
      return $output;
   }

   public function cambiarDisponible($conexion, $estado){
      $consulta = "UPDATE producto  
                     SET disponible = ?
                     WHERE id_producto = ?";
      $stmt = mysqli_prepare($conexion, $consulta);

      mysqli_stmt_bind_param($stmt, 'ii', $estado, $this->id);
      mysqli_stmt_execute($stmt);

      $output = mysqli_stmt_affected_rows($stmt);
      return $output;
   }

   public function cambiarDestacado($conexion, $estado){
      $consulta = "UPDATE producto  
                     SET destacado = ?
                     WHERE id_producto = ?";
      $stmt = mysqli_prepare($conexion, $consulta);

      mysqli_stmt_bind_param($stmt, 'ii', $estado, $this->id);
      mysqli_stmt_execute($stmt);

      $output = mysqli_stmt_affected_rows($stmt);
      return $output;
   }

	public static function guardarFichaTecnica($conexion, $nombre,
                                               $campo01,
                                               $campo02,
                                               $campo03 ,
                                               $campo04 ,
                                               $campo05 ,
                                               $campo06 ,
                                               $campo07 ,
                                               $campo08 ,
                                               $campo09 ,
                                               $campo10,
                                               $campo11,
                                               $campo12 ,
                                               $campo13,
                                               $campo14,
                                               $campo15,
                                               $campo16,
                                               $campo17,
                                               $campo18,
                                               $campo19,
                                               $campo20){
	    $consulta = "INSERT INTO ficha_tecnica (nombre_ficha,
                                    campo01,
                                    campo02,
                                    campo03 ,
                                    campo04 ,
                                    campo05 ,
                                    campo06 ,
                                    campo07 ,
                                    campo08 ,
                                    campo09 ,
                                    campo10,
                                    campo11,
                                    campo12 ,
                                    campo13,
                                    campo14,
                                    campo15,
                                    campo16,
                                    campo17,
                                    campo18,
                                    campo19,
                                    campo20)
                      VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

	    $stmt = mysqli_prepare($conexion, $consulta);
	    mysqli_stmt_bind_param($stmt, 'sssssssssssssssssssss', $nombre,
                                                        $campo01,
                                                        $campo02,
                                                        $campo03,
                                                        $campo04,
                                                        $campo05,
                                                        $campo06,
                                                        $campo07,
                                                        $campo08,
                                                        $campo09,
                                                        $campo10,
                                                        $campo11,
                                                        $campo12,
                                                        $campo13,
                                                        $campo14,
                                                        $campo15,
                                                        $campo16,
                                                        $campo17,
                                                        $campo18,
                                                        $campo19,
                                                        $campo20);
	    mysqli_stmt_execute($stmt);
    }

    public static function listarNombresFichas($conexion){
        $consulta = "SELECT nombre_ficha
					FROM ficha_tecnica";

        $resultado = mysqli_query($conexion, $consulta);
        $output = array();
        while($fila = mysqli_fetch_assoc($resultado)){
            $output[] = $fila;
        }
        return $output;
    }

    public static function cargarFichasTecnicas($conexion){
        $consulta = "SELECT id_ficha_tecnica id,
                            nombre_ficha nombreFicha
                    FROM ficha_tecnica";

        $resultado = mysqli_query($conexion, $consulta);
        $output = array();
        while($fila = mysqli_fetch_assoc($resultado)){
            $fila['id'] = (int)$fila['id'];
            $fila['nombreFicha'] = utf8_encode($fila['nombreFicha']);
            $output[] = $fila;
        }
        return $output;
    }

    public static function cargarFichaTecnicaPorIdCategoria($conexion, $idCategoria){
        $consulta = "SELECT F.nombre_ficha ficha,
                      campo01,
                      campo02,
                      campo03,
                      campo04,
                      campo05,
                      campo06,
                      campo07,
                      campo08,
                      campo09,
                      campo10,
                      campo11,
                      campo12,
                      campo13,
                      campo14,
                      campo15,
                      campo16,
                      campo17,
                      campo18,
                      campo19,
                      campo20                      
                    FROM categoria C JOIN ficha_tecnica F ON C.id_ficha_tecnica = F.id_ficha_tecnica
                    WHERE C.id_categoria = ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "i", $idCategoria);
        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);
        $output = mysqli_fetch_assoc($resultado);

        return $output;
    }

    public static function guardarFichaTecnicaDelProducto($campo01,
                      $campo02,
                      $campo03,
                      $campo04,
                      $campo05,
                      $campo06,
                      $campo07,
                      $campo08,
                      $campo09,
                      $campo10,
                      $campo11,
                      $campo12,
                      $campo13,
                      $campo14,
                      $campo15,
                      $campo16,
                      $campo17,
                      $campo18,
                      $campo19,
                      $campo20, $conexion){
        $consulta = "INSERT INTO producto_ficha_tecnica (campo01, campo02,campo03,campo04,campo05,campo06,
                                  campo07,campo08,campo09,campo10,campo11,campo12,campo13,campo14,campo15,
                                  campo16,campo17,campo18,campo19,campo20)
                                  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "ssssssssssssssssssss",
            $campo01,
            $campo02,
            $campo03,
            $campo04,
            $campo05,
            $campo06,
            $campo07,
            $campo08,
            $campo09,
            $campo10,
            $campo11,
            $campo12,
            $campo13,
            $campo14,
            $campo15,
            $campo16,
            $campo17,
            $campo18,
            $campo19,
            $campo20);
        mysqli_stmt_execute($stmt);
        //se obtiene el id autogenerado yse retorna el valor
        $id = mysqli_insert_id($conexion);
        return $id;
    }

    public static function cargarProductos($conexion, $desde, $limite){
        $consulta = "SELECT p.id_producto AS id,
                            p.descripcion,
                            p.precio,
                            p.meses_garantia AS mesesGarantia,
                            p.nuevo,
                            p.cod_fabricante AS codFabricante,
                            p.modelo,
                            p.disponible,
                            p.cod_proveedor AS codProveedor,
                            p.path_imagen AS imagen,
                            p.path_video AS video,
                            c.descripcion AS categoria,
                            p.id_categoria AS categoriaId,
                            p.codigo_sku AS sku,
                            pr.nombre AS proveedor,
                            p.id_proveedor AS proveedorId,
                            m.descripcion AS  marca,
                            p.id_marca AS marcaId,
                            p.peso_caja AS peso,
                            p.alto_caja AS alto,
                            p.ancho_caja AS ancho,
                            p.profundidad_caja AS profundidad,
                            p.id_producto_ficha_tecnica AS idProductoFichaTecnica,
                            p.destacado,
                            pft.campo01,
                            pft.campo02,
                            pft.campo03,
                            pft.campo04,
                            pft.campo05,
                            pft.campo06,
                            pft.campo07,
                            pft.campo08,
                            pft.campo09,
                            pft.campo10,
                            pft.campo11,
                            pft.campo12,
                            pft.campo13,
                            pft.campo14,
                            pft.campo15,
                            pft.campo16,
                            pft.campo17,
                            pft.campo18,
                            pft.campo19,
                            pft.campo20
                    FROM producto p 
                    JOIN categoria c ON c.id_categoria = p.id_categoria
                    JOIN proveedor pr ON pr.id_proveedor = p.id_proveedor
                    JOIN marca m ON m.id_marca = p.id_marca
                    LEFT JOIN producto_ficha_tecnica pft ON pft.id_producto_ficha_tecnica = p.id_producto_ficha_tecnica
                    LIMIT  ?, ?";

        //$resultado = mysqli_query($conexion,$consulta);
         $stmt = mysqli_prepare($conexion, $consulta);
         mysqli_stmt_bind_param($stmt, 'ii', $desde, $limite);
         mysqli_stmt_execute($stmt);

         $resultado = mysqli_stmt_get_result($stmt);

        $output = array();
        while ($fila = mysqli_fetch_assoc($resultado)){
            $output[] = $fila;
        }

        return $output;
    }

    public static function listarProductosDisponiblesPorIdCategoria($conexion, $idCategoria, $desde, $limite, 
                                        $destacados,
                                        $marcaFiltro,
                                       $campo01,
                                       $campo02,
                                       $campo03,
                                       $campo04,
                                       $campo05,
                                       $campo06,
                                       $campo07,
                                       $campo08,
                                       $campo09,
                                       $campo10,
                                       $campo11,
                                       $campo12,
                                       $campo13,
                                       $campo14,
                                       $campo15,
                                       $campo16,
                                       $campo17,
                                       $campo18,
                                       $campo19,
                                       $campo20,
                                       $orden){

        $selectMarca = " AND p.id_marca = ?";
        if( $marcaFiltro == 0 ){
          $selectMarca = " AND p.id_marca > ?";
        }

        $selectDestacados = " AND p.destacado = ?";
        if( $destacados == 0 ){
          $selectDestacados = " AND p.destacado >= ?";
        }

        $selectOrder = " ORDER BY ";
        switch ($orden) {
          case 0:
            # code...
            $selectOrder .= " p.descripcion ASC ";
            break;
          case 1:
            # code...
            $selectOrder .= " p.descripcion DESC ";
            break;
          case 2:
            # code...
            $selectOrder .= " p.precio ASC ";
            break;
          case 3:
            # code...
            $selectOrder .= " p.precio DESC ";
            break;
          
          default:
            # code...
            $selectOrder .= " p.descripcion ";
            break;
        }

        $consulta = "SELECT p.id_producto AS id,
                            p.descripcion,
                            p.precio,
                            p.meses_garantia AS mesesGarantia,
                            p.nuevo,
                            p.cod_fabricante AS codFabricante,
                            p.modelo,
                            p.codigo_sku AS sku,
                            p.disponible,
                            p.cod_proveedor AS codProveedor,
                            p.path_imagen AS imagen,
                            p.path_video AS video,
                            c.descripcion AS categoria,
                            pr.nombre AS proveedor,
                            m.descripcion AS  marca,
                            p.peso_caja AS peso,
                            p.alto_caja AS alto,
                            p.ancho_caja AS ancho,
                            p.profundidad_caja AS profundidad,
                            p.id_producto_ficha_tecnica AS idProductoFichaTecnica,
                            COUNT(vp.producto_id_producto) AS valoracion,
                            pft.campo01,
                            pft.campo02,
                            pft.campo03,
                            pft.campo04,
                            pft.campo05,
                            pft.campo06,
                            pft.campo07,
                            pft.campo08,
                            pft.campo09,
                            pft.campo10,
                            pft.campo11,
                            pft.campo12,
                            pft.campo13,
                            pft.campo14,
                            pft.campo15,
                            pft.campo16,
                            pft.campo17,
                            pft.campo18,
                            pft.campo19,
                            pft.campo20
                    FROM producto p 
                    LEFT JOIN categoria c ON c.id_categoria = p.id_categoria
                    LEFT JOIN proveedor pr ON pr.id_proveedor = p.id_proveedor
                    LEFT JOIN marca m ON m.id_marca = p.id_marca
                    LEFT JOIN valoracion_producto vp ON vp.producto_id_producto = p.id_producto
                    LEFT JOIN producto_ficha_tecnica pft ON pft.id_producto_ficha_tecnica = p.id_producto_ficha_tecnica
                    WHERE p.disponible = 1
                    AND p.id_categoria = ?
                    AND  pft.campo01 LIKE ?
                     AND  pft.campo02 LIKE ?
                     AND  pft.campo03 LIKE ?
                     AND  pft.campo04 LIKE ?
                     AND  pft.campo05 LIKE ?
                     AND  pft.campo06 LIKE ?
                     AND  pft.campo07 LIKE ?
                     AND  pft.campo08 LIKE ?
                     AND  pft.campo09 LIKE ?
                     AND  pft.campo10 LIKE ?
                     AND  pft.campo11 LIKE ?
                     AND  pft.campo12 LIKE ?
                     AND  pft.campo13 LIKE ?
                     AND  pft.campo14 LIKE ?
                     AND  pft.campo15 LIKE ?
                     AND  pft.campo16 LIKE ?
                     AND  pft.campo17 LIKE ?
                     AND  pft.campo18 LIKE ?
                     AND  pft.campo19 LIKE ?
                     AND  pft.campo20 LIKE ?";

        $grupos = " GROUP BY vp.producto_id_producto, p.id_producto ";
                    // ORDER BY p.descripcion
        $limit =  " LIMIT ?, ?";
        $consulta .= $selectMarca . $selectDestacados . $grupos . $selectOrder . $limit;

        
        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt,'issssssssssssssssssssiiii', $idCategoria, 
                                                $campo01,
                                       $campo02,
                                       $campo03,
                                       $campo04,
                                       $campo05,
                                       $campo06,
                                       $campo07,
                                       $campo08,
                                       $campo09,
                                       $campo10,
                                       $campo11,
                                       $campo12,
                                       $campo13,
                                       $campo14,
                                       $campo15,
                                       $campo16,
                                       $campo17,
                                       $campo18,
                                       $campo19,
                                       $campo20,
                                       $marcaFiltro,
                                       $destacados,
                                       $desde, $limite);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $output = array();
        while ($fila = mysqli_fetch_assoc($resultado)){
            $fila['descripcion'] = utf8_encode($fila['descripcion']);
            $output[] = $fila;
        }
        return $output;
    }

    public static function listarProductosDisponiblesDestacados($conexion, $limite){
        $consulta = "SELECT p.id_producto AS id,
                            p.descripcion,
                            p.precio,
                            p.meses_garantia AS mesesGarantia,
                            p.nuevo,
                            p.cod_fabricante AS codFabricante,
                            p.modelo,
                            p.codigo_sku AS sku,
                            p.disponible,
                            p.cod_proveedor AS codProveedor,
                            p.path_imagen AS imagen,
                            p.path_video AS video,
                            c.descripcion AS categoria,
                            c.id_categoria AS idCategoria,
                            pr.nombre AS proveedor,
                            m.descripcion AS  marca,
                            p.peso_caja AS peso,
                            p.alto_caja AS alto,
                            p.ancho_caja AS ancho,
                            p.profundidad_caja AS profundidad,
                            p.id_producto_ficha_tecnica AS idProductoFichaTecnica,
                            COUNT(vp.producto_id_producto) AS valoracion,
                            pft.campo01,
                            pft.campo02,
                            pft.campo03,
                            pft.campo04,
                            pft.campo05,
                            pft.campo06,
                            pft.campo07,
                            pft.campo08,
                            pft.campo09,
                            pft.campo10,
                            pft.campo11,
                            pft.campo12,
                            pft.campo13,
                            pft.campo14,
                            pft.campo15,
                            pft.campo16,
                            pft.campo17,
                            pft.campo18,
                            pft.campo19,
                            pft.campo20
                    FROM producto p 
                    LEFT JOIN categoria c ON c.id_categoria = p.id_categoria
                    LEFT JOIN proveedor pr ON pr.id_proveedor = p.id_proveedor
                    LEFT JOIN marca m ON m.id_marca = p.id_marca
                    LEFT JOIN valoracion_producto vp ON vp.producto_id_producto = p.id_producto
                    LEFT JOIN producto_ficha_tecnica pft ON pft.id_producto_ficha_tecnica = p.id_producto_ficha_tecnica
                    WHERE p.disponible = 1
                    AND p.destacado = 1
                    GROUP BY vp.producto_id_producto, p.id_producto
                    ORDER BY p.precio DESC
                    LIMIT ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt,'i', $limite);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $output = array();
        while ($fila = mysqli_fetch_assoc($resultado)){
            $fila['descripcion'] = utf8_encode($fila['descripcion']);
            $output[] = $fila;
        }
        return $output;
    }

    public static function valorarProducto($conexion, $idUsuario, $idProducto){
        $consulta = "INSERT INTO valoracion_producto (producto_id_producto, id_cliente)
                      VALUES (?, ?)";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'ii', $idProducto, $idUsuario);
        mysqli_stmt_execute($stmt);

        $output = mysqli_stmt_affected_rows($stmt);
        return $output;
    }

    public static function guardarPregunta($conexion, $pregunta, $respondida, $idUsuario, $idProducto, $fecha){
      $consulta = "INSERT INTO pregunta (pregunta, respondida, id_cliente, id_producto, fecha)
                     VALUES (?,?,?,?,?)";

      $stmt = mysqli_prepare($conexion, $consulta);
      mysqli_stmt_bind_param($stmt, 'siiis', $pregunta, $respondida, $idUsuario, $idProducto, $fecha);
      mysqli_stmt_execute($stmt);

      $output = mysqli_stmt_affected_rows($stmt);
      return $output;
    }

    public static function listarPreguntasYRespuestas($conexion, $idProducto, $todas){
		$limite = "";
		if ($todas == 0) {
			$limite = " LIMIT 10";
		}
		$consulta = "SELECT p.pregunta,
							p.fecha,
							r.respuesta,
							r.fecha_respuesta AS fechaRespuesta
					FROM pregunta p LEFT JOIN respuesta r ON p.id_pregunta = r.pregunta_id_pregunta
					WHERE p.id_producto = ?
					ORDER BY p.fecha DESC";
		$consulta = $consulta . $limite;

		$stmt = mysqli_prepare($conexion, $consulta);
		mysqli_stmt_bind_param($stmt, 'i', $idProducto);
		mysqli_stmt_execute($stmt);
		$resultado = mysqli_stmt_get_result($stmt);
		$output = array();
		while ($fila = mysqli_fetch_assoc($resultado)){
			$fila['pregunta'] = utf8_encode($fila['pregunta']);
			$fila['respuesta'] = utf8_encode($fila['respuesta']);
			$output[] = $fila;
		}
		return $output;

    } 

   public static function listarPreguntasSinRespuestas($conexion, $sinRespuesta, $desde, $limite){
      
      $consulta = "SELECT P.id_pregunta idPregunta,
                           P.pregunta,
                           C.username usuario,
                           P.id_producto idProducto,
                           P.fecha fechaPregunta,
                           R.fecha_respuesta fechaRespuesta,
                           R.respuesta
                  FROM pregunta P LEFT JOIN respuesta R ON P.id_pregunta = R.pregunta_id_pregunta
                     LEFT JOIN cliente C ON P.id_cliente = C.id
                  WHERE P.respondida = ?
                  ORDER BY P.fecha
                  LIMIT ?,?";

      $stmt = mysqli_prepare($conexion, $consulta);
      mysqli_stmt_bind_param($stmt, 'iii', $sinRespuesta, $desde, $limite);
      mysqli_stmt_execute($stmt);
      $resultado = mysqli_stmt_get_result($stmt);
      $output = array();
      while ($fila = mysqli_fetch_assoc($resultado)){
         $fila['pregunta'] = utf8_encode($fila['pregunta']);
         $fila['respuesta'] = utf8_encode($fila['respuesta']);
         $output[] = $fila;
      }
      return $output;
   }

   public static function guardarRespuesta($conexion, $idPregunta, $respuesta, $fecha){
      $consulta = "INSERT INTO respuesta (respuesta, pregunta_id_pregunta, fecha_respuesta)
            VALUES(?,?,?)";

      $stmt = mysqli_prepare($conexion, $consulta);
      mysqli_stmt_bind_param($stmt, 'sis', $respuesta, $idPregunta, $fecha);
      mysqli_stmt_execute($stmt);

      $output = mysqli_stmt_affected_rows($stmt);
      return $output;
   }

   public static function cambiarEstadoPreguntaARespondida($conexion, $idPregunta){
      $consulta = "UPDATE pregunta  
                  SET respondida = 1
                  WHERE id_pregunta = ?";
      $stmt = mysqli_prepare($conexion, $consulta);
      mysqli_stmt_bind_param($stmt, 'i', $idPregunta);
      mysqli_stmt_execute($stmt);
   }

   public static function verificarExistenciaDeProductoEnCarrito($conexion, $idProducto, $idUsuario){
        $consulta = "SELECT COUNT(*) AS existe FROM carrito_compra
                    WHERE id_producto = ?
                    AND id_cliente = ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'ii', $idProducto, $idUsuario);
        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($resultado);
   }

   public static function agregarAlCarrito($conexion, $idProducto, $idUsuario, $fecha, $cantidad){
        $consulta = "INSERT INTO carrito_compra (id_cliente, id_producto, fecha, cantidad)
                    VALUES (?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'iisi', $idUsuario, $idProducto, $fecha, $cantidad);
        mysqli_stmt_execute($stmt);

        $output = mysqli_stmt_affected_rows($stmt);
        return $output;
   }

   public static function cargarProductosCarrito($conexion, $idUsuario){
        $consulta = "SELECT CC.id_producto idProducto,
                            CC.cantidad,
                            P.descripcion,
                            P.precio,
                            P.path_imagen imagen,
                            P.alto_caja alto,
                            P.ancho_caja ancho,
                            P.profundidad_caja largo,
                            P.peso_caja peso
                    FROM carrito_compra CC
                    JOIN producto P ON CC.id_producto = P.id_producto
                    WHERE id_cliente = ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'i', $idUsuario);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $output = array();
        while ($fila = mysqli_fetch_assoc($resultado)){
            
            $output[] = $fila;
        }
        return $output;
   }

   public static function obtenerProductoCarritoSinUsuario($conexion, $idProducto){
        $consulta = "SELECT 
                            P.descripcion,
                            P.precio,
                            P.path_imagen imagen,
                            P.alto_caja alto,
                            P.ancho_caja ancho,
                            P.profundidad_caja largo,
                            P.peso_caja peso
                    FROM producto P 
                    WHERE id_producto = ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'i', $idProducto);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $output = mysqli_fetch_assoc($resultado);
        // while ($fila = mysqli_fetch_assoc($resultado)){
            
        //     $output[] = $fila;
        // }
        return $output;
   }

   public static function quitarDelCarrito($conexion, $idProducto, $idUsuario){
        $consulta = "DELETE FROM carrito_compra 
                    WHERE id_cliente = ?
                    AND id_producto = ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'ii', $idUsuario, $idProducto);
        mysqli_stmt_execute($stmt);

        $output = mysqli_stmt_affected_rows($stmt);
        return $output;
   }

   public static function contarProductosDisponiblesPorIdCategoria($conexion, $idCategoria,
                                      $marcaFiltro,
                                       $campo01,
                                       $campo02,
                                       $campo03,
                                       $campo04,
                                       $campo05,
                                       $campo06,
                                       $campo07,
                                       $campo08,
                                       $campo09,
                                       $campo10,
                                       $campo11,
                                       $campo12,
                                       $campo13,
                                       $campo14,
                                       $campo15,
                                       $campo16,
                                       $campo17,
                                       $campo18,
                                       $campo19,
                                       $campo20
                                          ){
      $selectMarca = " AND p.id_marca = ?";
      if( $marcaFiltro == 0 ){
        $selectMarca = " AND p.id_marca > ?";
      }
      $consulta = "SELECT count(*) as cantidad
                  FROM producto p
                  JOIN producto_ficha_tecnica pft ON pft.id_producto_ficha_tecnica = p.id_producto_ficha_tecnica
                  WHERE p.id_categoria = ?
                  AND  pft.campo01 LIKE ?
                  AND  pft.campo02 LIKE ?
                  AND  pft.campo03 LIKE ?
                  AND  pft.campo04 LIKE ?
                  AND  pft.campo05 LIKE ?
                  AND  pft.campo06 LIKE ?
                  AND  pft.campo07 LIKE ?
                  AND  pft.campo08 LIKE ?
                  AND  pft.campo09 LIKE ?
                  AND  pft.campo10 LIKE ?
                  AND  pft.campo11 LIKE ?
                  AND  pft.campo12 LIKE ?
                  AND  pft.campo13 LIKE ?
                  AND  pft.campo14 LIKE ?
                  AND  pft.campo15 LIKE ?
                  AND  pft.campo16 LIKE ?
                  AND  pft.campo17 LIKE ?
                  AND  pft.campo18 LIKE ?
                  AND  pft.campo19 LIKE ?
                  AND  pft.campo20 LIKE ?";
      $consulta .= $selectMarca; 

      $stmt = mysqli_prepare($conexion, $consulta);
      mysqli_stmt_bind_param($stmt, 'issssssssssssssssssssi', $idCategoria, 
                                       $campo01,
                                       $campo02,
                                       $campo03,
                                       $campo04,
                                       $campo05,
                                       $campo06,
                                       $campo07,
                                       $campo08,
                                       $campo09,
                                       $campo10,
                                       $campo11,
                                       $campo12,
                                       $campo13,
                                       $campo14,
                                       $campo15,
                                       $campo16,
                                       $campo17,
                                       $campo18,
                                       $campo19,
                                       $campo20,
                                        $marcaFiltro);
      mysqli_stmt_execute($stmt);

      $resultado = mysqli_stmt_get_result($stmt);
      return mysqli_fetch_assoc($resultado); 
   }

   public static function contarCantidadProductosAdmin($conexion){
      $consulta = "SELECT count(*) as cantidad
                  FROM producto";
      $resultado = mysqli_query($conexion,$consulta);
      $output = mysqli_fetch_assoc($resultado);
      return $output;
   }

   public static function obtenerOpcionesFiltrosPorCampo($conexion, $idCategoria, $campo){
      $select = '';
      $grupo = '';
      switch ($campo) {
         case 1:
            $select = 'SELECT ftp.campo01';
            $grupo = 'GROUP BY ftp.campo01';
            break;
         case 2:
            $select = 'SELECT ftp.campo02';
            $grupo = 'GROUP BY ftp.campo02';
            break;
         case 3:
            $select = 'SELECT ftp.campo03';
            $grupo = 'GROUP BY ftp.campo03';
            break;
         case 4:
            $select = 'SELECT ftp.campo04';
            $grupo = 'GROUP BY ftp.campo04';
            break;
         case 5:
            $select = 'SELECT ftp.campo05';
            $grupo = 'GROUP BY ftp.campo05';
            break;
         case 6:
            $select = 'SELECT ftp.campo06';
            $grupo = 'GROUP BY ftp.campo06';
            break;
         case 7:
            $select = 'SELECT ftp.campo07';
            $grupo = 'GROUP BY ftp.campo07';
            break;
         case 8:
            $select = 'SELECT ftp.campo08';
            $grupo = 'GROUP BY ftp.campo08';
            break;
         case 9:
            $select = 'SELECT ftp.campo09';
            $grupo = 'GROUP BY ftp.campo09';
            break;
         case 10:
            $select = 'SELECT ftp.campo10';
            $grupo = 'GROUP BY ftp.campo10';
            break;
         case 11:
            $select = 'SELECT ftp.campo11';
            $grupo = 'GROUP BY ftp.campo11';
            break;
         case 12:
            $select = 'SELECT ftp.campo12';
            $grupo = 'GROUP BY ftp.campo12';
            break;
         case 13:
            $select = 'SELECT ftp.campo13';
            $grupo = 'GROUP BY ftp.campo13';
            break;
         case 14:
            $select = 'SELECT ftp.campo14';
            $grupo = 'GROUP BY ftp.campo14';
            break;
         case 15:
            $select = 'SELECT ftp.campo15';
            $grupo = 'GROUP BY ftp.campo15';
            break;
         case 16:
            $select = 'SELECT ftp.campo16';
            $grupo = 'GROUP BY ftp.campo16';
            break;
         case 17:
            $select = 'SELECT ftp.campo17';
            $grupo = 'GROUP BY ftp.campo17';
            break;
         case 18:
            $select = 'SELECT ftp.campo18';
            $grupo = 'GROUP BY ftp.campo18';
            break;
         case 19:
            $select = 'SELECT ftp.campo19';
            $grupo = 'GROUP BY ftp.campo19';
            break;
         case 20:
            $select = 'SELECT ftp.campo20';
            $grupo = 'GROUP BY ftp.campo20';
            break;
      }

    $consulta = $select . " FROM producto_ficha_tecnica ftp JOIN producto p ON ftp.id_producto_ficha_tecnica = p.id_producto
                  WHERE p.id_categoria = ? " . $grupo;

      $stmt = mysqli_prepare($conexion, $consulta);
      mysqli_stmt_bind_param($stmt, 'i', $idCategoria);
      mysqli_stmt_execute($stmt);
      $resultado = mysqli_stmt_get_result($stmt);
      $output = array();
      while ($fila = mysqli_fetch_assoc($resultado)){
         
         $output[] = $fila;
      }
      return $output;
   }

   public static function buscarProductoPorSku($sku, $conexion){
    $consulta = "SELECT id_producto id
                FROM producto
                WHERE codigo_sku = ?";

    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "s", $sku);
    mysqli_stmt_execute($stmt);
    
    $resultado = mysqli_stmt_get_result($stmt);
    $output = array();
    while ($fila = mysqli_fetch_assoc($resultado)){
       
       $output[] = $fila;
    }
    return $output;
   }

   public static function cambiarCantidadCarrito($conexion, $producto, $usuario, $cantidad){
    $consulta = 'UPDATE carrito_compra
                  SET cantidad = ?,
                  fecha = now()
                  WHERE id_cliente = ?
                  and id_producto = ?';

    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "iii", $cantidad, $usuario, $producto);
    mysqli_stmt_execute($stmt);

    $output = mysqli_stmt_affected_rows($stmt);
    return $output;
   }
}
?>