<?php
use Dompdf\Dompdf;
use Dompdf\Options;
use Dompdf\Autoloader;

session_start();
require_once '../../models/miscompras.php';
require_once '../../models/conexion.php';
require_once '../../vendor/autoload.php';

ob_start();



$miCompra = new MensajesModelMis_Compras();
if(isset($_GET['id_venta'])){
    $dompdf = new Dompdf();
    $id_venta = $_GET['id_venta'];
    $id_usuario = $_SESSION['id_usuario'];
    $cantidad_producto = $miCompra->getCantidadProducto($id_venta);
    $sub_total = $miCompra->getSubTotal($id_venta);
    $costo_envio = 99.90;
    $total = $miCompra->getTotal($id_venta, $costo_envio);
    $venta = $miCompra-> getVenta($id_venta);
    $info_usuario = $miCompra-> getInfoUsuario($id_usuario);
    $info_direccion = $miCompra-> getDireccion ($id_usuario);
    $info_pago = $miCompra-> getInfoPago($id_venta);
    $info_fecha = $miCompra-> getFecha($id_venta);
    $html = '
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>Compra</title>
            <style>
                #resumen_compra {
                    max-width: 600px;
                    margin: 20px auto;
                    padding: 20px;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    border-radius: 5px;
                    color: black;
                }
                table {
                    width: 100%;
                    margin-top: 20px;
                    border-collapse: collapse;
                }
                
                table, th, td {
                    border: 1px solid #fff;
                }
                
                th, td {
                    padding: 10px;
                    text-align: left;
                }
            </style>
        </head>
        <body>
            <div id = "resumen_compra">
                <h2>Resumen de Compra '.$id_venta.'</h2>
                <p>Cantidad de productos: <span>'.$cantidad_producto.'</span></p>
                <p>Subtotal: $ <span>'.$sub_total.'</span></p>
                <p>Costo de envio: $ <span>'.$costo_envio.'</span></p>
                <p>Total: $ <span>'.$total.'</span></p>
                <table>
                    <thead>
                        <tr>
                            <th>Libro</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
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
        $html.= '
                        <tr>
                            <td>'.$v['nombre'].'</td>
                            <td>'.$v['cantidad'].'</td>
                            <td>'.$v['precio'].'</td> 
                            <td>'.$v['sub_total'].'</td>
                        </tr>';
    }   
    $html.='        </tbody>
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
        </body>
    </html>
    ';
    $dompdf->loadHtml($html);
    $dompdf->render();
    $dompdf->stream("documento.'.$id_venta.'.pdf", array('Attachment' => '0'));
    ob_end_flush();
    exit;
}
?>