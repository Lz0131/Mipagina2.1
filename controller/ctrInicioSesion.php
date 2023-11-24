<?php
session_start();

require_once '../models/iniciosesion.php';
require_once '../models/conexion.php';
include_once '../assets/adodb5/adodb.inc.php';

//echo '1';
$msjInicioS = new models_InicioSesion();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
}
if(isset($_POST['contrasena']) && isset($_POST['email'])){
    $contrasena = $_POST['contrasena'];
    //echo $contrasena;
    //echo $email;
    //$contrasena = md5($contrasena);
    if($msjInicioS->verificarEmail($email) == 1){
        //echo 'si existe la cuenta';
        if($msjInicioS->verificarCuenta($email, $contrasena) == 1){
            //echo 'contrasena y correo correctos';
            $_SESSION['id_usuario'] = $msjInicioS->obtenerIDUsuario($email, $contrasena);
            //echo $msjInicioS->obtenerIDUsuario($email, $contrasena);
            $response = array(
                'success' => true,
                'message' => 'Inicio de sesion exitoso'
            );
            
        }else{
            echo 'espero qie no llegie aqui xd';
        }
    }else{
        $response = array(
            'success' => true,
            'message' => 'Cuenta no registrada'
        );
    }
}else{
    $response = array(
        'success' => true,
        'message' => 'Sin datos'
    );
}
?>