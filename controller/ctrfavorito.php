<?php
session_start();
require_once '../models/favorito.php';
require_once '../models/conexion.php';
include_once '../assets/adodb5/adodb.inc.php';

$msjModel = new MensajesModel();
//$id_usuario = '1';  // Supongamos que el ID del usuario es 1
if(isset($_SESSION['id_usuario'])){
    $id_usuario = $_SESSION['id_usuario'];
    $id_libro = $_GET['id_libro'];
    $result = $msjModel->getAllFavoritosnum($id_usuario, $id_libro);
    if ($result == 1) {
        $msjModel->DeleteFavorito($id_usuario, $id_libro);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    } else if ($result == 0) {
        $msjModel->InsertFavorito($id_usuario, $id_libro);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}else{
    echo 'no tiene sesion iniciada';
    echo header("Location: ../views/login.php");
    exit();
}
    
?>
