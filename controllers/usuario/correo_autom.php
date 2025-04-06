<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require __DIR__ . '/../../vendor/autoload.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $destino = $_POST['correo_destino'];
    $mensaje = $_POST['mensaje'];

    $mail = new PHPMailer(true);

    try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'martinmh0722@gmail.com';
    $mail->Password   = 'eejp abav vptx fidw';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('martinmh0722@gmail.com', 'AgroSys');
    $mail->addAddress($destino);

    $mail->isHTML(true);
    $mail->Subject = 'Mensaje de AgroSys';
    $mail->Body    = $mensaje;
    $mail->AltBody = strip_tags($mensaje);

    $mail->send();
    echo "Correo enviado, mostrando alerta...<br>";
    echo '<script>alert("Correo enviado exitosamente."); window.history.back();</script>';
    } catch (Exception $e) {
        echo '<script>alert("Error al enviar el correo: ' . $mail->ErrorInfo . '"); window.history.back();</script>';
    }
}
