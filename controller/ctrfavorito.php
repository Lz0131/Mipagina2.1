<?php
require_once '../models/favorito.php';
require_once '../models/conexion.php';
include_once '../assets/adodb5/adodb.inc.php';

$msjModel = new MensajesModel();
$id_usuario = '1';  // Supongamos que el ID del usuario es 1
$id_libro = $_GET['id'];    // Supongamos que el ID del libro es 1

// Verifica si 'txtCantidad' está presente en $_POST
$result = $msjModel->getAllFavoritosnum($id_usuario, $id_libro);
$r= $result->fields[0];
    if ($r == 1) {
        $msjModel->DeleteFavorito($id_usuario, $id_libro);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit; 
    } else if ($r == 0) {
        $msjModel->InsertFavorito($id_usuario, $id_libro);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit; 
    }
    if( isset($_GET['opc']) ){
        $msjModel = new MensajesModel();
        switch($_GET['opc']){
            case 1: // INSERT TO DB
                
                break;
            case 2: // UPDATE TO BD
                //$msjModel->updateMensaje();
                break;
            case 3: // DELETE TO DB
                $idMsj = $_POST['idMsj'];
                $msjModel->DeleteFavorito($idMsj);
                //echo 'Mensaje AJAX';
                break;
            case 4: // SELECT TO DB
                echo getMensajes ($msjModel);
                break;
        }
    }
?>
