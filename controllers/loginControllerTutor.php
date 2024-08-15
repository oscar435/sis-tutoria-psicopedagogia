<?php
require_once("../config/connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['teacher_code']) && isset($_POST['tutor_password'])) { // Verifica si los datos han sido enviados
        $teacherCode = $_POST['teacher_code'];
        $password = $_POST['tutor_password']; // Usa el nombre correcto del campo de contraseña

        try {
            // Prepara la consulta para obtener el tutor de la base de datos
            $query = $connection->prepare("SELECT * FROM tutor WHERE codigo_docente = :teacher_code");
            $query->bindParam(":teacher_code", $teacherCode, PDO::PARAM_STR);
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Obtener el hash de la contraseña almacenada
                $storedPasswordHash = $result['password']; // Asegúrate de que el campo se llama 'password'

                // Verificar la contraseña usando password_verify
                if (password_verify($password, $storedPasswordHash)) {
                    // Inicio de sesión exitoso
                    $_SESSION['tutor_id'] = $result['id'];
                    $_SESSION['tutor_nombre'] = $result['nombre'];
                    $_SESSION['tutor_apellido'] = $result['apellido'];
                    $_SESSION['tutor_codigo_docente'] = $teacherCode;
                    header("Location: ../views3/view3homeTutor.php"); // Redirige al panel de tutor
                    exit();
                } else {
                    // Contraseña incorrecta
                    $message = "Contraseña incorrecta.";
                }
            } else {
                // Código de docente no encontrado
                $message = "Código de docente no encontrado.";
            }
        } catch (PDOException $e) {
            // Manejo de errores de PDO
            $message = 'Error en la base de datos: ' . $e->getMessage();
        }
    } else {
        $message = "Todos los campos son requeridos.";
    }

    // Si hay un mensaje, lo mostramos en el formulario
    if (!empty($message)) {
        echo "<p class=\"error\">$message</p>";
    }
} else {
    // Método no permitido
    header("HTTP/1.1 405 Method Not Allowed");
    echo "Método no permitido";
}
?>
