<?php
    require_once '../models/portadalib.php';
    require_once '../models/conexion.php';
    include_once '../assets/adodb5/adodb.inc.php';


        $msjModel = new MensajesModel();
        $id_usuario = 1;  // Supongamos que el ID del usuario es 1
        $id_libro = 1;    // Supongamos que el ID del libro es 1
        $verificar_query = "SELECT * FROM carrito WHERE id_usuario = $id_usuario AND id_libro = $id_libro";
        $result = $conn->query($verificar_query);
        $cantidad = $_POST['cantidad'];
        if ($result->num_rows > 0) {
            if($cantidad > 0){
                $msjModel->UpdateCarrito($id_usuario, $id_libro, $cantidad);
            }else if($cantidad == 0){
                $msjModel->DeleteCarrito($id_usuario, $id_libro);
            }
        }else{
            $msjModel->InsertCarrito($id_usuario, $id_libro, $cantidad);
        }
?> 