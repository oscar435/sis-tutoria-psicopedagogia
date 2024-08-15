<?php
session_start();
require '../libraries/PHPMailer/PHPMailer.php';
require '../libraries/PHPMailer/SMTP.php';
require '../libraries/PHPMailer/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Verificar si hay datos del formulario en la sesión
if (!isset($_SESSION['tutoria_individual'])) {
    echo 'No hay datos para enviar el correo.';
    exit();
}

$formData = $_SESSION['tutoria_individual'];
$nombreRemitente = $userInfo['nombre_completo'] ?? 'Estudiante'; // Nombre del remitente desde el formulario
$emailRemitente = $formData['email'] ?? ''; // Correo personal del remitente desde el formulario

// Enviar el PDF por correo electrónico usando PHPMailer
$mail = new PHPMailer(true);

// Habilitar la depuración SMTP (descomentar para ver detalles de depuración)
/*$mail->SMTPDebug = 2; // Activa el modo de depuración
$mail->Debugoutput = 'html'; // Salida en HTML*/

try {
    // Configuración del servidor SMTP
    $mail->isSMTP(); // Usa SMTP para enviar el correo
    $mail->Host       = 'btutoria.fiei.online'; // Servidor SMTP de tu dominio (proporcionado por cPanel)
    $mail->SMTPAuth   = true; // Activa la autenticación SMTP
    $mail->Username   = 'tutopsico@btutoria.fiei.online'; // Dirección de correo electrónico proporcionada por cPanel
    $mail->Password   = 'OnmUKc3xQG-u'; // Contraseña de esa cuenta de correo
    $mail->SMTPSecure = 'ssl'; // Usa STARTTLS para la encriptación
    $mail->Port       = 465; // Puerto para STARTTLS (587 es común)

    // Configuración del correo
    $mail->setFrom($emailRemitente, $nombreRemitente); // El correo se envía desde tu cuenta, pero con el nombre del estudiante
    $mail->addAddress('davidodiseascript@gmail.com'); // Dirección fija del destinatario
    $mail->addReplyTo($emailRemitente, $nombreRemitente); // Dirección de respuesta con el nombre del remitente


    $mail->isHTML(true);
    $mail->Subject = 'Resultados de tu Solicitud de Tutoria';
    $mail->Body    = 'Estimado/a, adjunto encontrarás el PDF con los detalles de tu solicitud de tutoría.';

    // Adjuntar el archivo PDF
    $pdfFilePath = realpath('../views/doc_pdf/resultados_tutoria_individual.pdf');
    if (file_exists($pdfFilePath)) {
        $mail->addAttachment($pdfFilePath);
    } else {
        echo 'El archivo no existe: ' . $pdfFilePath;
        exit();
    }

    // Enviar el correo
    $mail->send(); 
    // Mostrar un mensaje de confirmación usando SweetAlert2
    // Incluir SweetAlert2 desde un CDN
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Envio de Correo</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>";

    // Mostrar un mensaje de confirmación usando SweetAlert2
    echo "<script>
        Swal.fire({
            title: 'Correo Enviado',
            text: 'El mensaje ha sido enviado exitosamente.',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../views/viewHome1.php'; // Opcional: redirigir después de aceptar
            }
        });
    </script>";

    echo "</body>
    </html>";

} catch (Exception $e) {
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Error de Envio</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>";

    // Mostrar un mensaje de error usando SweetAlert2
    echo "<script>
        Swal.fire({
            title: 'Error',
            text: 'El mensaje no se pudo enviar. Error de Mailer: {$mail->ErrorInfo}',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    </script>";

    echo "</body>
    </html>";

}
?>
