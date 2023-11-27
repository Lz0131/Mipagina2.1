<?php
session_start();
header('Content-Type: application/json');
require_once '../models/carrito.php';
require_once '../models/conexion.php';
require_once '../models/envCorreoCompra.php';
require_once '../models/miscompras.php';
$msjCarrito =  new MensajesModelCarrito();
$id_usuario = $_SESSION['id_usuario'];

if (isset($_GET['Compra'])) {
    $numCarrito = $msjCarrito->getAllCarritonum($id_usuario);
    if($numCarrito['num'] == 0){
        $response = array(
            'success' => false,
            'message' => 'No hay libros en el carrito. Agrega libros antes de comprar.'
        );
        echo json_encode($response);
        exit;
    }else{
        $fecha = date('Y-m-d H:i:s');
        $mensaje = "asdsa";
        //echo "<script>console.log('$mensaje');</script>";
        $id_metodo_pago = 1;
        $id_venta = $msjCarrito -> Crearventa($id_usuario, $id_metodo_pago, $fecha);
        $carrito = $msjCarrito -> getCarrito($id_usuario);
        foreach($carrito as $c){
            $id_libro = $c['id_libro'];
            $precio = $c['precio'];
            $cantidad = $c['cantidad'];
            $sub_total = $c['sub_total'];
            $msjCarrito -> CrearVenta_detalle($id_venta, $id_libro, $cantidad, $precio, $sub_total);
        }
        $msjCarrito->DeleteAllCarrito($id_usuario);

        $ticket = ticket($id_venta, $id_usuario);

        $email = $msjCarrito->getCorreo($id_usuario);
        
        $correo = new MailerService();
        
        $correo->sendMailTicket($correo, $ticket);
        
        //echo json_encode($response);
        $response = array(
            'success' => true,
            'message' => 'Compra exitosa. Gracias por tu compra.'
        ); 
        echo json_encode($response);
        exit;
    }
    $response = array(
        'success' => false,
        'message' => 'No llega'
    ); 
    echo json_encode($response);
    exit;
}

function ticket($id_venta, $id_usuario){
    $miCompra = new MensajesModelMis_Compras();
    $cantidad_producto = $miCompra->getCantidadProducto($id_venta);
    $sub_total = $miCompra->getSubTotal($id_venta);
    $costo_envio = 99.90;
    $total = $miCompra->getTotal($id_venta, $costo_envio);
    $venta = $miCompra-> getVenta($id_venta);
    $info_usuario = $miCompra-> getInfoUsuario($id_usuario);
    $info_direccion = $miCompra-> getDireccion ($id_usuario);
    $info_pago = $miCompra-> getInfoPago($id_venta);
    $info_fecha = $miCompra-> getFecha($id_venta);
    $ticket = '
            <div id = "resumen_compra" style="max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; border-radius: 5px; color: black;">
                <h2>Resumen de Compra '.$id_venta.'</h2>
                <p>Cantidad de productos: <span>'.$cantidad_producto.'</span></p>
                <p>Subtotal: $ <span>'.$sub_total.'</span></p>
                <p>Costo de envio: $ <span>'.$costo_envio.'</span></p>
                <p>Total: $ <span>'.$total.'</span></p>
                <table style="width: 100%; margin-top: 20px; border-collapse: collapse; border: 1px solid #fff;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid #fff; padding: 10px; text-align: left;">Libro</th>
                            <th style="border: 1px solid #fff; padding: 10px; text-align: left;">Cantidad</th>
                            <th style="border: 1px solid #fff; padding: 10px; text-align: left;">Precio</th>
                            <th style="border: 1px solid #fff; padding: 10px; text-align: left;">Subtotal</th>
                        </tr>
                    </thead>
                <tbody>';
    foreach($venta as $v){
        $portada = "";
        if (isset($v['portada'])) {
            $url_imagen = htmlspecialchars($v['portada'], ENT_QUOTES, 'UTF-8');
            $portada.='<div class="centrar-imagen">';
            $portada.= '<img src="' . $url_imagen . '" alt="' . $url_imagen . '" width="50" height="100">';
            $portada.= '</div>';
        } else {
            $portada.='La URL de la imagen no está disponible.';
        }
        $ticket.= '
                        <tr>
                            <td style="border: 1px solid #fff; padding: 10px; text-align: left;">'.$v['nombre'].'</td>
                            <td style="border: 1px solid #fff; padding: 10px; text-align: left;">'.$v['cantidad'].'</td>
                            <td style="border: 1px solid #fff; padding: 10px; text-align: left;">'.$v['precio'].'</td> 
                            <td style="border: 1px solid #fff; padding: 10px; text-align: left;">'.$v['sub_total'].'</td>
                        </tr>';
    }   
    $ticket.='        </tbody>
                </table>
                <h3>Direccion de Envio</h3>
                <p>Destinatario: <span>'.$info_usuario['nombre'].' '.$info_usuario['apellido_p'].' '.$info_usuario['apellido_m'].'</span></p>
                <p>Correro de contacto: <span>'.$info_usuario['email'].'</span></p>
                <p>Direccion: <span>'.$info_direccion['calle'].', '.$info_direccion['num_casa'].', '.$info_direccion['ciudad'].', '.$info_direccion['estado'].', '.$info_direccion['pais'].'</span></p>
                <h3>Informacion de Pago</h3>
                <p>'.$info_pago.'</p>
                <h2>Informacion General</h2>
                <p>Fecha de compra: <span>'.$info_fecha.' </span></p>
            </div>
    ';
    return $ticket;
}

?>