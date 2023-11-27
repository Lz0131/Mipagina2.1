<?php
session_start();
require_once '../models/portadalib.php';
require_once '../models/carrito.php';
require_once '../models/conexion.php';
include_once '../assets/adodb5/adodb.inc.php';

$msjCarrito = new MensajesModelCarrito();
$id_usuario = $_SESSION['id_usuario'];
$r = '
<table class="table">
              <thead>
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">Portada</th>
                      <th scope="col">Titulo</th>
                      <th scope="col"></th>
                      <th scope="col">Cantidad</th>
                      <th scope="col"></th>
                      <th scope="col"></th>
                      <th scope="col">Subtotal</th>
                  </tr>
              </thead>
              <tbody>

';
$carrito = $msjCarrito->getAllCarrito($id_usuario);
foreach ($carrito as $c){
    $portada = "";
    if (isset($c['portada'])) {
        $url_imagen = htmlspecialchars($c['portada'], ENT_QUOTES, 'UTF-8');
        $portada.='<div class="centrar-imagen">';
        $portada.= '<img src="' . $url_imagen . '" alt="' . $url_imagen . '" width="300" height="450">';
        $portada.= '</div>';
    } else {
        $portada.='La URL de la imagen no está disponible.';
    }
    $r.= '
            <tr>
                <th scope="row">'.$c['id_libro'].'</th>
                <td>'.$portada.'</td>
                <td><h1>'.$c['nombre'].'</h1></td>
                <td>
                    <form action=../controller/carrito.php?id_libro='.$c['id_libro'].' method="post">
                        <input type="hidden" id="Minus" name="Minus" value = "1">
                        <button  type="submit" class="btn"><i class="fa fa-minus" aria-hidden="true"></i></button>
                    </form>
                </td>
                <td><h1>'.$c['cantidad'].'</h1></td>
                <td>
                    <form action=../controller/carrito.php?id_libro='.$c['id_libro'].' method="post">
                        <input type="hidden" id="Plus" name="Plus" value = "2">
                        <button  type="submit" class="btn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </form>
                </td>
                <td><h1>'.$c['subtotal'].'</h1></td>
            </tr>';
}  
$subtotal = $msjCarrito->getSubTotal($id_usuario);

$r.='
</tbody>
<h1>Subtotal :'.$subtotal.'</h1>
';      
echo $r; 
?>