<?php
session_start();
require_once '../models/venta.php';
require_once '../models/conexion.php';

$msjVenta = new MensajesModelVentas();
$id_usuario = $_SESSION['id_usuario'];
//echo $id_usuario;
$r = '<h2>Resumen de Compra</h2>';
$id_venta = $msjVenta->traerId_Venta($id_usuario);
//echo $id_venta;
$cantidad_producto = $msjVenta->getCantidadProducto ($id_venta);
$r.= '
<p>Cantidad de productos: <span>'.$cantidad_producto.'</span></p>';
$sub_total = $msjVenta->getSubTotal($id_venta);
$r.= '
<p>Subtotal: $ <span>'.$sub_total.'</span></p>';
$costo_envio = 99.90;
$r.= '
<p>Costo de envio: $ <span>'.$costo_envio.'</span></p>';
$total = $msjVenta->getTotal($id_venta, $costo_envio);
$r.= '
<p>Total: $ <span>'.$total.'</span></p>';

$r.= '
<table>
    <thead>
        <tr>
            <th>Producto</th>
            <th></th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
';
$venta = $msjVenta-> getVenta($id_venta);
foreach($venta as $v){
    $portada = "";
    if (isset($v['portada'])) {
        $url_imagen = htmlspecialchars($v['portada'], ENT_QUOTES, 'UTF-8');
        $portada.='<div class="centrar-imagen">';
        $portada.= '<img src="' . $url_imagen . '" alt="' . $url_imagen . '" width="100" height="150">';
        $portada.= '</div>';
    } else {
        $portada.='La URL de la imagen no está disponible.';
    }
    $r.= '
    <tr>
        <td>'.$portada.'</td>
        <td>'.$v['nombre'].'</td>
        <td>'.$v['cantidad'].'</td>
        <td>'.$v['precio'].'</td> 
        <td>'.$v['sub_total'].'</td>
    </tr>';
}
$info_usuario = $msjVenta-> getInfoUsuario($id_usuario);
$info_direccion = $msjVenta-> getDireccion ($id_usuario);
$info_pago = $msjVenta-> getInfoPago($id_venta);
$info_fecha = $msjVenta-> getFecha($id_venta);
$r.= '
    </tbody>
</table>
<h3>Direccion de Envio</h3>
<p>Destinatario: <span>'.$info_usuario['nombre'].' '.$info_usuario['apellido_p'].' '.$info_usuario['apellido_m'].'</span></p>
<p>Correro de contacto: <span>'.$info_usuario['email'].'</span></p>
<p>Direccion: <span>'.$info_direccion['calle'].', '.$info_direccion['num_casa'].', '.$info_direccion['ciudad'].', '.$info_direccion['estado'].', '.$info_direccion['pais'].'</span></p>

<h3>Informacion de Pago</h3>
<p>Paypal</p>

<h2>Informacion General</h2>
<p>Fecha de compra: <span>'.$info_fecha.' </span></p>
';
echo $r;
?>