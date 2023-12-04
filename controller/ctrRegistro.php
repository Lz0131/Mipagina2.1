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
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $msj_registro = new models_registro();
        $resultado = $msj_registro->verificar($email);
        //echo $resultado;
        if($resultado <= 0){
            //echo 'entra';
            $nombre = $_POST['nombre'];
            $apellido_p = $_POST['apellido_p'];
            $apellido_m = $_POST['apellido_m'];
            $contrasena = $_POST['contrasena'];
            $id_ciudad = $_POST['id_ciudad'];
            $calle = $_POST['calle'];
            $num_casa = $_POST['num_casa'];
            $caracteristicas = $_POST['caracteristicas'];
            $latitud = $_POST['latitud'];
            $longitud = $_POST['longitud'];
            $l1 = array(
                'success' => true,
                'message' => 'la latitud es de '.$latitud
            );
            $l2 = array(
                'success' => true,
                'message' => 'la longitud es de '.$longitud
            );
            if (empty($nombre) || empty($apellido_p) || empty($apellido_m) || empty($contrasena) || empty($id_ciudad) || empty($calle) || empty($num_casa) || empty($caracteristicas) || empty($latitud) || empty($longitud)) {
                $response = array(
                    'success' => true,
                    'message' => 'Todos los campos son obligatorios. Por favor, complete todos los campos.'
                );
                echo "Todos los campos son obligatorios. Por favor, complete todos los campos.";
            } else {
                $msj_registro -> crearUsuarioYRol($nombre, $apellido_p, $apellido_m, $email, $contrasena, $calle, $num_casa, $caracteristicas, $id_ciudad, $latitud, $longitud);
                $id_usuario = $msj_registro -> trerCorreo($email);
                $_SESSION['id_usuario'] = $id_usuario;
                $response = array(
                    'success' => true,
                    'message' => 'Registro exitoso'
                );
            }
            // Envía la respuesta como JSON
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
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
        'message' => 'Necesita completar el captcha porfavor'
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}
    

    
?>