<?php
require_once '../models/portadalib.php';
require_once '../models/conexion.php';
include_once '../assets/adodb5/adodb.inc.php';

$msjModel = new MensajesModel();
$id_usuario = '1';  // Supongamos que el ID del usuario es 1
$id_libro = $_GET['id'];    // Supongamos que el ID del libro es 1

// Verifica si 'txtCantidad' está presente en $_POST
if (isset($_POST['txtCantidad'])) {
    $cantidad = $_POST['txtCantidad'];
    $result = $msjModel->getAllCarritonum($id_usuario, $id_libro);
    $r= $result->fields[0];
    if ($r > 0) {
        if ($cantidad > 0) {
            $msjModel->UpdateCarrito($id_usuario, $id_libro);
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit; 
        } else if ($cantidad <= 0) {

            $msjModel->DeleteCarrito($id_usuario, $id_libro);
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit; 
        }
    } else {
        $msjModel->InsertCarrito($id_usuario, $id_libro, $cantidad);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit; 
    }
} else {
    // 'txtCantidad' no está presente en $_POST, manejar esto según tus necesidades
    echo "Error: 'txtCantidad' no está presente en la solicitud POST.";
}
?>
