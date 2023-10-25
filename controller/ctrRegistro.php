<?php 
    require_once '../models/registro.php';
    require_once '../models/conexion.php';
    include_once '../assets/adodb5/adodb.inc.php';

    $msj_registro = new models_registro();

    if(isset($_POST['txtcorreo'])){
        $email = $_POST['txtcorreo'];
        $resultado = $msj_registro->verificar($email);
        echo $resultado;
        if($resultado <= 0){
            echo 'entra';
            $msj_registro ->insertUsuario();
        }else{
            echo 'ya esta registrado';
        }
    }else{
        echo 'no hay correo';
    }
?>