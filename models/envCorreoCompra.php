<?php
require('src/PHPMailer/src/Exception.php');
require 'src/PHPMailer/src/PHPMailer.php';
require 'src/PHPMailer/src/SMTP.php';
require("src/vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class MailerService{
    public function sendMail($para, $asunto, $mensaje, $nombre){
        $mail = new PHPMailer(true);
        try{
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; 
            $mail->SMTPAuth   = true;
            $mail->Port       = 587;
            $mail->Username   = 'milibfav@gmail.com';
            $mail->Password   = 'qW2Q8C7Sgj5cW9J'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            $mail->setFrom('milibfav@gmail.com', 'milibfav');
            $mail->addAddress($para, $nombre);
            $mail->isHTML(true);
            $mail->Subject = $asunto;
            $mail->Body = '
            <h1>Gracias por tu compra, ' . $para . '</h1>
            <p>Nos alegra que confies en nosotros para comprar tus libros.</p>
            <p>Nos encanta que puedas ampliar tu biblioteca con nuestra ayuda y disfrutar de las mejores historias.</p>
            <p>¡Sigue ampliando tu mundo y dejate llevar por tu imaginación!</p>
            <p>Ahora que eres parte de nuestra bonita comunidad, estaremos al tanto de cualquier inconveniente o duda que tengas.</p>
            <p>Un cordial saludo, </p>
            <p>Equipo de MiLibFav</p>
            <img src="https://assets-global.website-files.com/5a9ee6416e90d20001b20038/63e21a374758723bb2b910bc_019.jpg" alt="Imagen de felicitación">
            ';
            $mail->AltBody = 'FELICITACIONES';
            $mail->send();
            echo 'El mensaje ha sido enviado';
        }catch (Exception $e) {
            echo "No se pudo enviar el mensaje. Error del remitente: {$mail->ErrorInfo}";
        }
    }

    public function sendMailTicket($para, $mensaje){
        $mail = new PHPMailer(true);
        try{
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; 
            $mail->SMTPAuth   = true;
            $mail->Port       = 587;
            $mail->Username   = 'milibfav@gmail.com';
            $mail->Password   = 'hkzw tcyi htct ghpv'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            $mail->setFrom('milibfav@gmail.com', 'milibfav');
            $mail->addAddress($para);
            $mail->isHTML(true);
            $mail->Subject = 'TICKET';
            $mail->Body = $mensaje;
            $mail->AltBody = 'Comprobante de pago';
            $mail->send();
            echo 'El mensaje ha sido enviado';
        }catch (Exception $e) {
            echo "No se pudo enviar el mensaje. Error del remitente: {$mail->ErrorInfo}";
        }
    }

}
?>