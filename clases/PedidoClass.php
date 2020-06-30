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
    private $diaEnvio;
    private $horarioEnvio;

    function __construct($id, $cliente, $fecha, $estadoPedido, $localidad,
                         $calle, $codigoPostal, $piso, $depto, $tipoEnvio, $diaEnvio, $horarioEnvio)
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
        $this->diaEnvio = $diaEnvio;
        $this->horarioEnvio = $horarioEnvio;
    }

    public function persistirse($conexcion){
        $consulta  = "INSERT INTO pedido (id_cliente, fecha, id_estado_pedido, id_localidad, calle, numero, 
                        codigo_postal, piso, depto, envio_domicilio, dia_envio, horario_envio) 
                        VALUEs (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexcion, $consulta);
        mysqli_stmt_bind_param($stmt, 'isiisssssiii', $this->cliente, $this->fecha, $this->estadoPedido, $this->localidad, $this->calle, 
        $this->numero, $this->codigoPostal, $this->piso, $this->depto, $this->envioDomicilio, $this->diaEnvio, $this->horarioEnvio);
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
                            c.celular,
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
                            p.envio_domicilio tipo_pedido,
                            p.dia_envio,
                            p.horario_envio,
                            ps.id id_pedido_supervisor,
                            eps.nombre nombre_estado_pedido_supervisor
                    FROM pedido p
                    LEFT JOIN cliente c ON c.id=p.id_cliente
                    LEFT JOin estado_pedido ep ON ep.id=p.id_estado_pedido
                    LEFT JOIN localidad l ON l.id=p.id_localidad
                    LEFT JOin provincia pr ON pr.id=l.id_provincia
                    LEFT JOIN pedido_supervisor ps ON ps.id_pedido = p.id
                    LEFT JOIN estado_pedido_supervisor eps ON eps.id = ps.id_estado_pedido_supervisor
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
            $fila['estado_descripcion'] = utf8_encode($fila['estado_descripcion']);
            $fila['calle'] = utf8_encode($fila['calle']);
            $fila['piso'] = utf8_encode($fila['piso']);
            $fila['depto'] = utf8_encode($fila['depto']);
            $output[] = $fila;
        }

        //================== Postgres =======================
        // $result = pg_query($conexion, $consulta);
        // $output = array();
        // while($fila = pg_fetch_assoc($result))
        //     $output[] = $fila;

        return $output;
    }

    

    public function updateCarrito($conexion, $idPedido){
        $consulta = "UPDATE carrito_compra cc 
                    LEFT JOIN producto p ON p.id=cc.id_producto 
                    SET cc.precio = (p.precio * (SELECT valor_en_peso FROM moneda WHERE activo = 1)) , 
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
                            p.envio_domicilio,
                            p.dia_envio,
                            p.horario_envio,
                            ps.id id_pedido_supervisor,
                            eps.nombre nombre_estado_pedido_supervisor
                     FROM pedido p
                     LEFT JOIN cliente c ON c.id=p.id_cliente
                     LEFT JOin estado_pedido ep ON ep.id=p.id_estado_pedido
                    LEFT JOIN localidad l ON l.id=p.id_localidad
                    LEFT JOin provincia pr ON pr.id=l.id_provincia
                    LEFT JOIN pedido_supervisor ps ON ps.id_pedido = p.id
                    LEFT JOIN estado_pedido_supervisor eps ON eps.id = ps.id_estado_pedido_supervisor
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
            $fila['nombre_cliente'] = utf8_encode($fila['nombre_cliente']);
            $fila['apellido_cliente'] = utf8_encode($fila['apellido_cliente']);
            $fila['calle'] = utf8_encode($fila['calle']);
            $fila['piso'] = utf8_encode($fila['piso']);
            $fila['depto'] = utf8_encode($fila['depto']);
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
                            cc.precio,
                            cc.id_pedido_supervisor
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

    public static function buscarPedidoPorIdParaExel($conexion, $idPedido){
        $consulta = "SELECT pd.id as id_pedido,
                            pd.fecha,
                            pd.id_estado_pedido,
                            ep.descripcion as estado,
                            l.localidad,
                            pr.provincia,
                            pd.calle,
                            pd.codigo_postal,
                            pd.piso,
                            pd.depto,
                            CASE 
                            WHEN pd.envio_domicilio = 1 THEN 'Envio domicilio'
                            ELSE 'Retiro acordado con vendedor'
                            END AS envio_domicilio,
                            CASE 
                            WHEN pd.dia_envio = 0 THEN 'Lunes'
                            WHEN pd.dia_envio = 1 THEN 'Martes'
                            WHEN pd.dia_envio = 2 THEN 'Miercoles'
                            WHEN pd.dia_envio = 3 THEN 'Jueves'
                            WHEN pd.dia_envio = 4 THEN 'Viernes'
                            ELSE '-\-\-'
                            END AS dia_envio,
                            CASE 
                            WHEN pd.horario_envio = 0 THEN 'Mañana'
                            WHEN pd.horario_envio = 1 THEN 'Tarde'
                            ELSE '-\-\-'
                            END AS horario_envio,
                            cl.id AS id_cliente,
                            cl.usuario AS razon_social,
                            cl.email,
                            cl.telefono,
                            cl.nombre,
                            cl.apellido,
                            cl.cuit_cuil,
                            CASE
                            WHEN cl.id_condicion_iva = 1 THEN 'Consumidor final'
                            WHEN cl.id_condicion_iva = 2 THEN 'Monotributista'
                            WHEN cl.id_condicion_iva = 3 THEN 'Exento'
                            ELSE 'Responsable inscripto'
                            END AS condicion_iva,
                            cc.id,
                            p.descripcion,
                            p.id id_producto,
                            p.modelo,
                            p.cod_fabricante,
                            p.disponible,
                            p.id_categoria,
                            c.nombre categoria,
                            p.id_marca,
                            m.descripcion marca,
                            p.codigo_sku,
                            cc.cantidad,
                            cc.precio
                    FROM carrito_compra cc
                    LEFT JOIN producto p ON p.id=cc.id_producto
                    LEFT JOIN categoria c ON c.id=p.id_categoria
                    LEFT JOIN marca m ON m.id=p.id_marca
                    LEFT JOIN pedido pd ON pd.id=cc.id_pedido
                    LEFT JOIN estado_pedido ep ON ep.id=pd.id_estado_pedido
                    LEFT JOIN cliente cl ON cl.id=cc.id_cliente
                    LEFT JOIN localidad l ON l.id=pd.id_localidad
                    LEFT JOIN provincia pr ON pr.id=l.id_provincia
                    WHERE cc.id_pedido = ?
                    ORDER BY c.nombre ASC";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'i', $idPedido);
        mysqli_stmt_execute($stmt);
        $respuesta = mysqli_stmt_get_result($stmt);
        $output = array();
        // $resultado = mysqli_fetch_assoc($respuesta);
        while($fila = mysqli_fetch_assoc($respuesta)){
            $fila['descripcion'] = utf8_encode($fila['descripcion']);
            $fila['modelo'] = utf8_encode($fila['modelo']);
            $fila['categoria'] = utf8_encode($fila['categoria']);
            $fila['marca'] = utf8_encode($fila['marca']);
            $output[] = $fila;
        }

        //================ Postgres ===================
        // $result = pg_query_params($conexion, $consulta, array($id));
        // $resultado = pg_fetch_assoc($result);

        return $output;
    }

    public static function guardarPedidoSupervisor($conexion, $idPedido, $fecha){
        $consulta  = "INSERT INTO pedido_supervisor (id_pedido, id_estado_pedido_supervisor, fecha) 
                        VALUEs (?, ?, ?)";
        $idEstadoPedidoSupervisor = 1;
        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'iis', $idPedido, $idEstadoPedidoSupervisor, $fecha);
        mysqli_stmt_execute($stmt);

        //se obtiene el id autogenerado yse retorna el valor
        $id = mysqli_insert_id($conexion);
        return $id;

        //================== Postgres =======================
        // pg_query_params($conexcion, $consulta, array($this->descripcion));
    }

    public static function setPedidoSupervisorACarritoCompra($conexion, $idPedidoSupervisor, $idCarrito){
        $consulta = "UPDATE carrito_compra cc 
                    SET id_pedido_supervisor = ? 
                    WHERE cc.id = ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'ii', $idPedidoSupervisor, $idCarrito);
        mysqli_stmt_execute($stmt);
        $output = mysqli_stmt_affected_rows($stmt);
        return $output;
    }

    public static function listarPedidosSupervisor($conexion, $pedido, $desde, $limite){
        $wherePedido = "AND p.id > ? ";
        if($pedido > 0){
            $wherePedido = "AND p.id = ? ";
        }

        $limit = "LIMIT ?, ?";

        $consulta = "SELECT ps.id,
                            ps.fecha, 
                            ps.id_estado_pedido_supervisor id_estado_pedido_supervisor,
                            eps.nombre estado_pedido_supervisor,
                            p.id id_pedido,
                            p.id_cliente,
                            c.nombre nombre_cliente,
                            c.apellido apellido_cliente,
                            c.usuario razon_social,
                            c.email,
                            c.telefono,
                            c.cuit_cuil,
                            c.id_condicion_iva,
                            p.fecha fecha_pedido,
                            p.id_estado_pedido,
                            p.id_localidad,
                            l.localidad,
                            pr.provincia,
                            p.calle,
                            p.numero,
                            p.codigo_postal,
                            p.piso,
                            p.depto,
                            p.envio_domicilio tipo_pedido,
                            p.dia_envio,
                            p.horario_envio,
                            ps.id id_pedido_supervisor,
                            eps.nombre nombre_estado_pedido_supervisor
                    FROM pedido_supervisor ps
                    LEFT JOIN pedido p ON p.id = ps.id_pedido
                    LEFT JOIN estado_pedido_supervisor eps ON eps.id = ps.id_estado_pedido_supervisor
                    LEFT JOIN cliente c ON c.id=p.id_cliente
                    LEFT JOIN localidad l ON l.id=p.id_localidad
                    LEFT JOin provincia pr ON pr.id=l.id_provincia
                    WHERE c.existe = 1 AND c.activo = 1 
                    AND p.id_estado_pedido <> 6 ";

        $order = "ORDER BY ps.id_estado_pedido_supervisor, p.id DESC ";

        $consulta .=  $wherePedido . $order . $limit;

        //================== MySQL =======================
        // var_dump($consulta);
        // die();
        $resultado = mysqli_prepare($conexion, $consulta);
        
        mysqli_stmt_bind_param($resultado, 'iii', $pedido, $desde, $limite );
        mysqli_stmt_execute($resultado);
        $result = mysqli_stmt_get_result($resultado);
        $output = array();
        while ($fila = mysqli_fetch_assoc($result)){
            $fila['nombre_cliente'] = utf8_encode($fila['nombre_cliente']);
            $fila['apellido_cliente'] = utf8_encode($fila['apellido_cliente']);
            $fila['razon_social'] = utf8_encode($fila['razon_social']);
            $fila['localidad'] = utf8_encode($fila['localidad']);
            $fila['provincia'] = utf8_encode($fila['provincia']);
            $fila['calle'] = utf8_encode($fila['calle']);
            // $fila['estado_descripcion'] = utf8_encode($fila['estado_descripcion']);
            $fila['estado_pedido_suervisor'] = utf8_encode($fila['estado_pedido_supervisor']);
            $fila['calle'] = utf8_encode($fila['calle']);
            $fila['piso'] = utf8_encode($fila['piso']);
            $fila['depto'] = utf8_encode($fila['depto']);
            $output[] = $fila;
        }

        //================== Postgres =======================
        // $result = pg_query($conexion, $consulta);
        // $output = array();
        // while($fila = pg_fetch_assoc($result))
        //     $output[] = $fila;

        return $output;
    }

    public static function contarCantidadPedidosSupervisor($conexion, $pedido){
        $wherePedido = "AND p.id > ? ";
        if($pedido > 0){
            $wherePedido = "AND p.id = ? ";
        }

        $consulta = "SELECT count(*) AS cantidad
                    FROM pedido_supervisor ps
                    LEFT  JOIN pedido p ON p.id = ps.id_pedido
                    LEFT JOIN cliente c ON c.id=p.id_cliente
                    WHERE c.existe = 1 AND c.activo = 1 
                    And p.id_estado_pedido <> 6 ";

        $consulta .=  $wherePedido ;

        //================== MySQL =======================
        $resultado = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($resultado, 'i', $pedido);
        mysqli_stmt_execute($resultado);
        $result = mysqli_stmt_get_result($resultado);
        
        $output = mysqli_fetch_assoc($result);
        
        //================== Postgres =======================
        // $result = pg_query($conexion, $consulta);
        // $output = array();
        // while($fila = pg_fetch_assoc($result))
        //     $output[] = $fila;

        return $output;
    }

    public static function listarProductosCarritoPorIdPedidoSupervisor($conexion, $idPedido){
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
                            cc.precio,
                            cc.id_pedido_supervisor
                    FROM carrito_compra cc
                    LEFT JOIN producto p ON p.id=cc.id_producto
                    LEFT JOIN categoria c ON c.id=p.id_categoria
                    LEFT JOIN marca m ON m.id=p.id_marca
                    WHERE cc.id_pedido_supervisor = ?";

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

    public static function cambiarEstadoPedidoSupervisor($conexion, $idPedido, $estado){
        $consulta = "UPDATE pedido_supervisor
                    SET id_estado_pedido_supervisor = ?
                    WHERE id = ?";

        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, 'ii', $estado, $idPedido);
        mysqli_stmt_execute($stmt);
        $output = mysqli_stmt_affected_rows($stmt);
        return $output;
    }
}