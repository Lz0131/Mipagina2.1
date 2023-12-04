<?php
session_start();
require_once '../models/portadalib.php';
require_once '../models/carrito.php';
require_once '../models/conexion.php';
include_once '../assets/adodb5/adodb.inc.php';

$msjModel = new MensajesModel();
$msjCarrito =  new MensajesModelCarrito();
echo 'verifica inicio de sesion';
echo isset($_SESSION['id_usuario']);
if(isset($_SESSION['id_usuario'])){
    echo 'entra pero quien sabe porque ';
    $id_usuario = $_SESSION['id_usuario']; 
  // Supongamos que el ID del libro es 1

    // Verifica si 'txtCantidad' está presente en $_POST
    if (isset($_POST['cantidad'])) {
        $id_libro = $_GET['id_libro'];
        $cantidad = $_POST['cantidad'];
        $result = $msjModel->getAllCarritonum($id_usuario, $id_libro);
        $r = is_array($result) ? $result['num'] : 0;
        if ($r > 0) {
            if ($cantidad > 0) {
                $msjModel->UpdateCarrito($id_usuario, $id_libro);
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                exit; 
            } else if ($cantidad <= 0) {

                $msjModel->DeleteProducCarrito($id_usuario, $id_libro);
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                exit; 
            }
        } else {
            $msjModel->InsertCarrito($id_usuario, $id_libro, $cantidad);
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit; 
        }
    } else if (isset($_POST['Minus'])) {
        $id_libro = $_GET['id_libro'];
        $msjCarrito->Updateminus($id_usuario, $id_libro);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;
    } else if (isset($_POST['Plus'])) {
        $id_libro = $_GET['id_libro'];
        $msjCarrito->Updateplus($id_usuario, $id_libro);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;
    } else if (isset($_POST['Compra'])) {
        $numCarrito = $msjCarrito->getAllCarritonum($id_usuario);
        if($numCarrito['num'] == 0){
            $response = array(
                'success' => false,
                'message' => 'No hay libros en el carrito. Agrega libros antes de comprar.'
            );
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
            //echo json_encode($response);
            
        }
        $response = array(
                'success' => true,
                'message' => 'Compra exitosa. Gracias por tu compra.'
            ); 
        echo json_encode($response);
        exit;
    }else if(isset($_POST['Borrar'])){
        $id_libro = $_GET['id_libro'];
        $msjCarrito->DeleteProducCarrito($id_usuario, $id_libro);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;
    }

}else{
    echo 'no tiene sesion iniciada';
    echo header("Location: ../views/login.php");
    exit();
}
echo 'no verifica nada??';

?>