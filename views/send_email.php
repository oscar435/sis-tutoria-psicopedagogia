<?php
session_start();
require '../libraries/PHPMailer/PHPMailer.php';
require '../libraries/PHPMailer/SMTP.php';
require '../libraries/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Verificar si hay datos del formulario en la sesión
if (!isset($_SESSION['formData'])) {
    echo 'No hay datos para enviar el correo.';
    exit();
}

$formData = $_SESSION['formData'];
$nombreRemitente = $userInfo['nombre_completo'] ?? 'Estudiante'; // Nombre del remitente desde el formulario
$emailRemitente = $formData['email'] ?? ''; // Correo personal del remitente desde el formulario

// Enviar el PDF por correo electrónico usando PHPMailer
$mail = new PHPMailer(true);

// Habilitar la depuración SMTP(comentarlo por el momento, ya que si se envio)
/*$mail->SMTPDebug = 2; // Activa el modo de depuración
$mail->Debugoutput = 'html'; // Salida en HTML*/

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'haylerquispe@gmail.com'; // Asegúrate de que el correo sea correcto
    $mail->Password = 'gfjewdtbnckbvigm'; // Usa la contraseña de aplicación correcta
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Usa la constante en lugar de 'tls'
    $mail->Port = 587;

    // Configuración del correo
    // Configuración del correo
    $mail->setFrom($emailRemitente, $nombreRemitente); // El correo se envía desde tu cuenta, pero con el nombre del estudiante
    $mail->addAddress('davidodiseascript@gmail.com'); // Dirección fija del destinatario
    $mail->addReplyTo($emailRemitente, $nombreRemitente); // Dirección de respuesta con el nombre del remitente

    $mail->isHTML(true);
    $mail->Subject = 'Resultados de la Encuesta psicopedagogica';
    $mail->Body    = 'Adjunto encontrarás los resultados de la encuesta psicopedagogica en formato PDF.';

    // Adjuntar el archivo PDF
    $pdfFilePath = realpath('../views/doc_pdf/resultados_encuesta.pdf');
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
