<?php
require_once '../models/libros.php';
require_once '../models/conexion.php';
include_once '../assets/adodb5/adodb.inc.php';

 // Supongamos que el ID del usuario es 1

 $msjModel = new MensajesLibro();
if( isset($_GET['opc']) ){
   
    switch($_GET['opc']){
        case 1: // INSERT TO DB
            if(!empty($_POST['hddId']) )
                $msjModel->updateLibro();    
            else
                $msjModel->InsertLibro();
            break;
        case 2: // UPDATE TO BD
            $msjModel->updateLibro();
            break;
        case 3: // DELETE TO DB
            $msjModel->DeleteLibro($id_libro);
            //echo 'Mensaje AJAX';
            break;
        case 4: // SELECT TO DB
            echo getLibro($msjModel);
            
    }
}else if(isset($_POST['eliminar'])){ 
    $id_libro = $_GET['id']; 
    $msjModel->DeleteLibro($id_libro);
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}else{
    header('Location: ../index.php');
}

?>
