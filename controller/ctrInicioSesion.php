<?php
session_start();

require_once '../models/iniciosesion.php';
require_once '../models/conexion.php';
include_once '../assets/adodb5/adodb.inc.php';


$msjInicioS = new models_InicioSesion();

if(isset($_POST['txtemail']) && isset($_POST['txtpassword'])){
    $email = filter_var($_POST['txtemail'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['txtpassword'];
    if($msjInicioS->verificarEmail($email) == 1){
        if(isset($_POST['txtpassword'])){
            if($msjInicioS->verificarCuenta($email, $password) == 1){
                $_SESSION['id_usuario'] = $msjInicioS->obtenerIDUsuario($email, $password);
                
            }
        }else{
            echo 'Contraseña incorrecta';
        }
    }else{
        echo 'No esta registrado';
    }
}else{
    echo 'no hay correo';
}
?>