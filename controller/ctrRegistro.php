<?php 
session_start();
    require_once '../models/registro.php';
    require_once '../models/conexion.php';
    include_once '../assets/adodb5/adodb.inc.php';
//echo '0';
$recaptchaSecretKey = '6LfXi_8oAAAAABDaB25yPOKfh4Yq3fNRzDupSMB6'; // Reemplaza con tu clave secreta de reCAPTCHA
$recaptchaResponse = $_POST['g-recaptcha-response'];

$recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecretKey&response=$recaptchaResponse";
$recaptchaResponse = file_get_contents($recaptchaUrl);
$recaptchaData = json_decode($recaptchaResponse);
//echo '1';
if ($recaptchaData->success) {
    //echo '2';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $msj_registro = new models_registro();
        $resultado = $msj_registro->verificar($email);
        //echo $resultado;
        if($resultado <= 0){
            //echo 'entra';
            $nombre = $_POST['nombre'];
            $apellido_p = $_POST['apellido_p'];
            $apellido_m = $_POST['apellido_m'];
            $contrasena = $_POST['contrasena'];
            $msj_registro -> crearUsuarioYRol($nombre, $apellido_p, $apellido_m, $email, $contrasena);
            $id_usuario = $msj_registro -> trerCorreo($email);
            $_SESSION['id_usuario'] = $id_usuario;
            $response = array(
                'success' => true,
                'message' => 'Registro exitoso'
            );
            // Envía la respuesta como JSON
            header('Content-Type: application/json');
            echo json_encode($response);
            // header("Location: Admin/ctrlAdmin.php");
        }else{
            $response = array(
            'success' => false,
            'message' => 'Error: El correo ya está registrado.'
            );
            // Envía la respuesta como JSON
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    } else {
        $response = array(
            'success' => false
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}else{
    // El captcha no se completó con éxito
    // Muestra un mensaje de error o realiza alguna acción
    // Puedes enviar una respuesta JSON con un mensaje de error si lo deseas
    $response = array(
        'success' => false,
        'message' => 'complete el captcha porFavor'
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}
    

    
?>