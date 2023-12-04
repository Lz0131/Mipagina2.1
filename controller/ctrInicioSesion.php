<?php
session_start();
header('Content-Type: application/json');
require_once '../models/iniciosesion.php';
require_once '../models/conexion.php';
include_once '../assets/adodb5/adodb.inc.php';

//echo '1';
$msjInicioS = new models_InicioSesion();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (esCorreoElectronicoValido($correo)) {
        if(isset($_POST['contrasena']) && isset($_POST['email'])){

            $contrasena =md5( $_POST['contrasena']);
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
                    echo json_encode($response);
                }else{
                    //echo 'espero qie no llegie aqui xd';
                    $response = array(
                        'success' => false,
                        'message' => 'Valores no aceptados'
                    );
                    echo json_encode($response);
                }
            }else{
                $response = array(
                    'success' => false,
                    'message' => 'Cuenta no registrada'
                );
                echo json_encode($response);
            }
        }else{
            $response = array(
                'success' => false,
                'message' => 'Sin datos'
            );
            echo json_encode($response);
        }
    } else {
        $response = array(
            'success' => false,
            'message' => 'Correo Electronico no valido'
        );
        echo json_encode($response);
    }
    
}
function esCorreoElectronicoValido($correo) {
    // Expresión regular para verificar si es un correo electrónico válido
    $expresionRegularCorreo = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
    
    // Utilizamos la función preg_match() para verificar si el correo cumple con la expresión regular
    return preg_match($expresionRegularCorreo, $correo);
  }

?>