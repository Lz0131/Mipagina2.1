<?php
    session_start();
    header('Content-Type: application/json');
    require_once '../models/usuario.php';
    require_once '../models/conexion.php';

    $msjRol = new models_usuario();
    if(isset($_SESSION['id_usuario'])){
        $id_usuario = $_SESSION['id_usuario'];
        if(isset($_GET['opc'])){
            switch($_GET['opc']){
                case 1: //Graficas Administrador
                    if($msjRol->getRol($id_usuario) == 3){
                        $response = array(
                            'success' => true,
                            'message' => 'Es admin'
                        );
                        echo json_encode($response);
                    }else{
                        $response = array(
                            'success' => false,
                            'message' => 'No puedes entrar aqui'
                        );
                        echo json_encode($response);
                    }
                break;
                case 2: //Agregar libros
                    if($msjRol->getRol($id_usuario) == 2){
                        $response = array(
                            'success' => true,
                            'message' => 'Es Escritor'
                        );
                        echo json_encode($response);
                    }else{
                        $response = array(
                            'success' => false,
                            'message' => 'No puedes entrar aqui'
                        );
                        echo json_encode($response);
                    }
                break;
            }
        }else{
            $response = array(
                'success' => true,
                'message' => 'Permitido'
            );
            echo json_encode($response);
        }
        
    }else{
        $response = array(
            'success' => false,
            'message' => 'No tiene sesion iniciada'
        );
        echo json_encode($response);
    }
?>