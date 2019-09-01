<?php
/**
 * Created by PhpStorm.
 * User: vegitojor
 * Date: 14/10/17
 * Time: 23:12
 */

class Pedido
{
    private $id;
    private $cliente;
    private $fecha;
    private $estadoPedido;
    private $localidad;
    private $calle;
    private $numero;
    private $codigoPostal;
    private $piso;
    private $depto;
    private $envioDomicilio;

    function __construct($id, $cliente, $fecha, $estadoPedido, $localidad, $calle, $codigoPostal, $piso, $depto, $tipoEnvio)
    {
        $this->id = $id;
        $this->cliente = $cliente;
        $this->fecha = $fecha;
        $this->estadoPedido = $estadoPedido;
        $this->localidad = $localidad;
        $this->calle = $calle;
        $this->codigoPostal = $codigoPostal;
        $this->piso = $piso;
        $this->depto = $depto;
        $this->numero = null;
        $this->envioDomicilio = $tipoEnvio;
    }

    public function persistirse($conexcion){
        $consulta  = "INSERT INTO pedido (id_cliente, fecha, id_estado_pedido, id_localidad, calle, numero, codigo_postal, piso, depto, envio_domicilio) 
                        VALUEs (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexcion, $consulta);
        mysqli_stmt_bind_param($stmt, 'isiisssssi', $this->cliente, $this->fecha, $this->estadoPedido, $this->localidad, $this->calle, 
        $this->numero, $this->codigoPostal, $this->piso, $this->depto, $this->envioDomicilio);
        mysqli_stmt_execute($stmt);

        //se obtiene el id autogenerado yse retorna el valor
        $id = mysqli_insert_id($conexcion);
        return $id;

        //================== Postgres =======================
        // pg_query_params($conexcion, $consulta, array($this->descripcion));
    }

    public static function listarPedidos($conexion, $estado, $cliente, $pedido, $desde, $limite){
        $whereCliente = "AND c.id > ? ";
        if($cliente > 0){
            $whereCliente = "AND c.id = ? ";
        }

        $wherePedido = "AND p.id > ? ";
        if($pedido > 0){
            $wherePedido = "AND p.id = ? ";
        }

        $limit = "LIMIT ?, ?";

        $consulta = "SELECT p.id,
                            p.id_cliente,
                            c.nombre nombre_cliente,
                            c.apellido apellido_cliente,
                            c.usuario razon_social,
                            c.email,
                            c.telefono,
                            c.cuit_cuil,
                            c.id_condicion_iva,
                            p.fecha,
                            p.id_estado_pedido,
                            ep.descripcion estado_descripcion,
                            p.id_localidad,
                            l.localidad,
                            pr.provincia,
                            p.calle,
                            p.numero,
                            p.codigo_postal,
                            p.piso,
                            p.depto,
                            p.envio_domicilio tipo_pedido
                    FROM pedido p
                    LEFT JOIN cliente c ON c.id=p.id_cliente
                    LEFT JOin estado_pedido ep ON ep.id=p.id_estado_pedido
                    LEFT JOIN localidad l ON l.id=p.id_localidad
                    LEFT JOin provincia pr ON pr.id=l.id_provincia
                    WHERE c.existe = 1 AND c.activo = 1
                    And ep.id = ? ";

        $order = "ORDER BY p.id DESC ";

        $consulta .= $whereCliente . $wherePedido . $order . $limit;

        //================== MySQL =======================
        $resultado = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($resultado, 'iiiii', $estado, $cliente, $pedido, $desde, $limite );
        mysqli_stmt_execute($resultado);
        $result = mysqli_stmt_get_result($resultado);
        $output = array();
        while ($fila = mysqli_fetch_assoc($result)){
            $fila['nombre_cliente'] = utf8_encode($fila['nombre_cliente']);
            $fila['apellido_cliente'] = utf8_encode($fila['apellido_cliente']);
            $fila['razon_social'] = utf8_encode($fila['razon_social']);
            // $fila['localidad'] = utf8_encode($fila['localidad']);
            $fila['localidad'] = utf8_encode($fila['localidad']);
            $fila['provincia'] = utf8_encode($fila['provincia']);
            $fila['calle'] = utf8_encode($fila['calle']);
            $output[] = $fila;
        }

        //================== Postgres =======================
        // $result = pg_query($conexion, $consulta);
        // $output = array();
        // while($fila = pg_fetch_assoc($result))
        //     $output[] = $fila;

        return $output;
    }

    public static function buscarPedidoPorId($conexion, $id){
        $consulta = "SELECT p.id,
                            p.id_cliente,
                            c.nombre nombre_cliente,
                            c.apellido apellido_cliente,
                            p.fecha,
                            p.id_estado_pedido,
                            ep.descripcion estado_descripcion,
                            p.id_localidad,
                            l.localidad,
                            pr.provincia,
                            p.calle,
                            p.numero,
                            p.codigo_postal,
                            p.piso,
                            p.depto
                     FROM pedido p
                     LEFT JOIN cliente c ON c.id=p.id_cliente
                     LEFT JOin estado_pedido ep ON ep.id=p.id_estado_pedido
                    LEFT JOIN localidad l ON l.id=p.id_localidad
                    LEFT JOin provincia pr ON pr.id=l.id_provincia
                     WHERE c.existe = 1 AND c.activo = 1
                     AND  p.id = ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $respuesta = mysqli_stmt_get_result($stmt);
        $resultado = mysqli_fetch_assoc($respuesta);

        //================ Postgres ===================
        // $result = pg_query_params($conexion, $consulta, array($id));
        // $resultado = pg_fetch_assoc($result);

        return $resultado;


    }

    public function updateCarrito($conexion, $idPedido){
        $consulta = "UPDATE carrito_compra cc 
                    LEFT JOIN producto p ON p.id=cc.id_producto 
                    SET cc.precio = p.precio, 
                        id_pedido = ? 
                    WHERE cc.id_pedido IS null 
                    AND cc.id_cliente = ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'ii', $idPedido, $this->cliente);
        mysqli_stmt_execute($stmt);
        $output = mysqli_stmt_affected_rows($stmt);
        return $output;
    }

    public static function cargarPedidos($conexion, $idUsuario){
        $consulta = "SELECT p.id,
                            p.id_cliente,
                            c.nombre nombre_cliente,
                            c.apellido apellido_cliente,
                            p.fecha,
                            p.id_estado_pedido,
                            ep.descripcion estado_descripcion,
                            p.id_localidad,
                            l.localidad,
                            pr.provincia,
                            p.calle,
                            p.numero,
                            p.codigo_postal,
                            p.piso,
                            p.depto,
                            p.envio_domicilio
                     FROM pedido p
                     LEFT JOIN cliente c ON c.id=p.id_cliente
                     LEFT JOin estado_pedido ep ON ep.id=p.id_estado_pedido
                    LEFT JOIN localidad l ON l.id=p.id_localidad
                    LEFT JOin provincia pr ON pr.id=l.id_provincia
                     WHERE c.existe = 1 AND c.activo = 1
                     AND  c.id = ?
                    ORDER BY p.id DESC";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'i', $idUsuario);
        mysqli_stmt_execute($stmt);
        $respuesta = mysqli_stmt_get_result($stmt);
        $output = array();
        // $resultado = mysqli_fetch_assoc($respuesta);
        while($fila = mysqli_fetch_assoc($respuesta)){
            $fila['localidad'] = utf8_encode($fila['localidad']);
            $fila['provincia'] = utf8_encode($fila['provincia']);
            $output[] = $fila;
        }

        //================ Postgres ===================
        // $result = pg_query_params($conexion, $consulta, array($id));
        // $resultado = pg_fetch_assoc($result);

        return $output;
    }

    public static function listarProductosCarritoPorIdPedido($conexion, $idPedido){
        $consulta = "SELECT cc.id,
                            p.descripcion,
                            p.id id_producto,
                            p.modelo,
                            p.cod_fabricante,
                            p.disponible,
                            p.id_categoria,
                            c.nombre categoria_nombre,
                            p.id_marca,
                            m.descripcion marca_descripcion,
                            p.codigo_sku,
                            cc.cantidad,
                            cc.precio
                    FROM carrito_compra cc
                    LEFT JOIN producto p ON p.id=cc.id_producto
                    LEFT JOIN categoria c ON c.id=p.id_categoria
                    LEFT JOIN marca m ON m.id=p.id_marca
                    WHERE cc.id_pedido = ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'i', $idPedido);
        mysqli_stmt_execute($stmt);
        $respuesta = mysqli_stmt_get_result($stmt);
        $output = array();
        // $resultado = mysqli_fetch_assoc($respuesta);
        while($fila = mysqli_fetch_assoc($respuesta)){
            $fila['descripcion'] = utf8_encode($fila['descripcion']);
            $fila['modelo'] = utf8_encode($fila['modelo']);
            $fila['categoria_nombre'] = utf8_encode($fila['categoria_nombre']);
            $fila['marca_descripcion'] = utf8_encode($fila['marca_descripcion']);
            $output[] = $fila;
        }

        //================ Postgres ===================
        // $result = pg_query_params($conexion, $consulta, array($id));
        // $resultado = pg_fetch_assoc($result);

        return $output;
    }

    public static function cambiarEstado($conexion, $idPedido, $estado){
        $consulta = "UPDATE pedido 
                    SET id_estado_pedido = ?
                    WHERE id = ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'ii', $estado, $idPedido);
        mysqli_stmt_execute($stmt);
        $output = mysqli_stmt_affected_rows($stmt);
        return $output;
    }

    public static function quitarProductoPedido($conexion, $idCarrito){
        $consulta = "UPDATE carrito_compra 
                    SET id_pedido = NULL,
                    precio = NULL
                    WHERE id = ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'i', $idCarrito);
        mysqli_stmt_execute($stmt);
        $output = mysqli_stmt_affected_rows($stmt);
        return $output;
    }

    public static function cargarEstadosPedido($conexion){
        $consulta = "SELECT id,
                            descripcion
                    FROM estado_pedido";

        $resultado = mysqli_query($conexion, $consulta);
        $output = array();
        while($fila = mysqli_fetch_assoc($resultado)){
            $output[] = $fila;
        }

        //=============== POSTGRES ================
        // $resultado = pg_query($conexion, $consulta);
        // $output = array();
        // while($fila = pg_fetch_assoc($resultado)){
        // 	$output[] = $fila['email'];
        // }

        return $output;
    }

    public static function contarCantidadPedidosAdmin($conexion, $estado, $cliente, $pedido){
        $whereCliente = "AND c.id > ? ";
        if($cliente > 0){
            $whereCliente = "AND c.id = ? ";
        }

        $wherePedido = "AND p.id > ? ";
        if($pedido > 0){
            $wherePedido = "AND p.id = ? ";
        }

        $consulta = "SELECT count(*) AS cantidad
                    FROM pedido p
                    LEFT JOIN cliente c ON c.id=p.id_cliente
                    LEFT JOin estado_pedido ep ON ep.id=p.id_estado_pedido
                    
                    WHERE c.existe = 1 AND c.activo = 1
                    And ep.id = ? ";

        // $order = "ORDER BY p.id DESC ";

        $consulta .= $whereCliente . $wherePedido ;

        //================== MySQL =======================
        $resultado = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($resultado, 'iii', $estado, $cliente, $pedido);
        mysqli_stmt_execute($resultado);
        $result = mysqli_stmt_get_result($resultado);
        // $output = array();
        // while ($fila = mysqli_fetch_assoc($result)){
        //     $output[] = $fila;
        // }
        $output = mysqli_fetch_assoc($result);
        // var_dump($estado);
        // die('query');
        //================== Postgres =======================
        // $result = pg_query($conexion, $consulta);
        // $output = array();
        // while($fila = pg_fetch_assoc($result))
        //     $output[] = $fila;

        return $output;
    }
}