<?php
session_start();
require_once '../models/miscompras.php';
require_once '../models/conexion.php';

$msjMisCompras = new MensajesModelMis_Compras();
$id_usuario = $_SESSION['id_usuario'];
//echo 'no es el id';
$r = '';
$Mis_Compras = $msjMisCompras->getInfoMis_Compras($id_usuario);
//echo 'no es el objeto mis compras';

foreach($Mis_Compras as $mc){
    $id_venta = $mc['id_venta'];
    //echo 'id venta: '.$id_venta;
    $cantidad_producto = $msjMisCompras->getCantidadProducto ($id_venta);
    //echo ' cantidad producto: '.$cantidad_producto;
    $sub_total = $msjMisCompras->getSubTotal($id_venta);
    //echo ' sub total'.$sub_total;
    $costo_envio = 99.90;
    //echo ' costo envio'.$costo_envio;
    $total = $msjMisCompras->getTotal($id_venta, $costo_envio);
    //echo ' total '.$total;
    $info_fecha = $msjMisCompras-> getFecha($id_venta);
    //echo ' fecha:'.$info_fecha;
    $r.= '
    <div id = "resumen_compra">
        <h2>Resumen de Compra</h2>
        <p>ID compra <span>'.$id_venta.' </span></p>
        <p>Fecha de compra: <span>'.$info_fecha.' </span></p>
        <p>Cantidad de productos: <span>'.$cantidad_producto.'</span></p>
        <p>Subtotal: $ <span>'.$sub_total.'</span></p>
        <p>Costo de envio: $ <span>'.$costo_envio.'</span></p>
        <p>Total: $ <span>'.$total.'</span></p>
        <form id="frmCompra" method="post" action = "../controller/PDF/ctrPDFCompra.php?id_venta='.$id_venta.'">
          <button  type="submit" class="btn "><i class="fa fa-download" aria-hidden="true">Descargar</i></button>
        </form>
    </div>';
}

echo $r;
?>