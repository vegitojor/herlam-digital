<?php 

require_once('../clases/ConexionBDClass.php');
require_once('../clases/PedidoClass.php');

// ini_set('memory_limit', '64M');

if(isset($_GET['p'])){
    //CONEXION DE DB
    $conn = new ConexionBD();
    $conexion = $conn->getConexion();

    //ESTABLESCO EL ID DEL PEDIDO
    $idPedido = strip_tags($_GET['p']);
    $productos = array();
    $clientePedido = array();
    $resultado = Pedido::buscarPedidoPorIdParaExel($conexion, $idPedido);
    
    if(!empty($resultado)){

        $pedidoArray = array(
            "Numero pedido"=>$resultado[0]['id_pedido'],
            "Fecha"=>$resultado[0]['fecha'],
            "Estado"=>$resultado[0]['estado'],
            "Tipo envio"=>$resultado[0]['envio_domicilio'],
            "Domicilio"=>$resultado[0]['calle'],
            "Piso"=>$resultado[0]['piso'],
            "Depto."=>$resultado[0]['depto'],
            "Localidad"=>$resultado[0]['localidad'],
            "Provincia"=>$resultado[0]['provincia'],
            "Codigo postal"=>$resultado[0]['codigo_postal'],
        );
        $pedidoArrayKeys=array_keys($pedidoArray);
    
        $clienteArray = array(
            "Cliente id"=>$resultado[0]['id_cliente'],
            "Razon social"=>$resultado[0]['razon_social'],
            "Nombre"=>$resultado[0]['nombre'],
            "Apellido"=>$resultado[0]['apellido'],
            "Email"=>$resultado[0]['email'],
            "Telefono"=>$resultado[0]['telefono'],
            "Cuit-Cuil"=>$resultado[0]['cuit_cuil'],
            "Condicion iva"=>$resultado[0]['condicion_iva'],
        );
        $clienteArrayKeys = array_keys($clienteArray);
        
        $productos = array();
        foreach($resultado as $elemento){
            $producto = array(
                "Id"=>$elemento['id_producto'],
                "Descripcion"=>$elemento['descripcion'],
                "Modelo"=>$elemento['modelo'],
                "Codigo fabricante"=>$elemento['cod_fabricante'],
                "Id categoria"=>$elemento['id_categoria'],
                "Categoria"=>$elemento['categoria'],
                "Id marca"=>$elemento['id_marca'],
                "Marca"=>$elemento['marca'],
                "Codigo sku"=>$elemento['codigo_sku'],
                "Cantidad"=>$elemento['cantidad'],
                "Precio"=>$elemento['precio'],
            );
            $productos[]=$producto;

        }
        $productoKeys = array_keys($productos[0]);
       
        //DEFINO EL NOMBRE DEL ARCHIVO
        $filename = "pedido_".$idPedido. "-".rand(). ".xlsx";
        header("Content-Type: application/vnd.ms-excel;charset=iso-8859-15");
        header("Content-Disposition: attachment; filename=".$filename);
        
    }
}
?>

<!-- Tabla pedido -->
<table>
    <tr>
        <?php foreach($pedidoArrayKeys as $claves): ?>
            <th><?= $claves; ?></th>
        <?php endforeach; ?>
    </tr>
    <tr>
        <?php foreach($pedidoArray as $pedido): ?>
            <td><?= $pedido; ?></td>
        <?php endforeach; ?>
    </tr>
</table>
<br>
<table>
    <tr>
        <?php foreach($clienteArrayKeys as $claves): ?>
            <th><?= $claves; ?></th>
        <?php endforeach; ?>
    </tr>
    <tr>
        <?php foreach($clienteArray as $cliente): ?>
            <td><?= $cliente; ?></td>
        <?php endforeach; ?>
    </tr>
</table>
<br>
<table>
    <tr>
        <?php foreach($productoKeys as $claves): ?>
            <th><?= $claves; ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach($productos as $producto): ?>
        <tr>
            <?php foreach($producto as $item): ?>
                <td><?= $item; ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>

</table>