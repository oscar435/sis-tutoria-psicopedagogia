<?php
require_once("../config/connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['admin_password'])) { // Asegúrate de que los nombres coincidan
        $username = $_POST['username'];
        $password = $_POST['admin_password']; // Usa el nombre correcto

        try {
            // Prepara la consulta para obtener el usuario de la base de datos
            $query = $connection->prepare("SELECT * FROM administrador WHERE nom_usuario = :username");
            $query->bindParam(":username", $username, PDO::PARAM_STR);
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Obtener el hash de la contraseña almacenada
                $storedPasswordHash = $result['password']; // Asegúrate de que el campo se llama 'password'

                // Verificar la contraseña usando password_verify
                if (password_verify($password, $storedPasswordHash)) {
                    // Inicio de sesión exitoso
                    $_SESSION['admin_id'] = $result['id'];
                    $_SESSION['admin_username'] = $username;
                    $_SESSION['admin_nombre'] = $result['nombre'];
                    $_SESSION['admin_apellido'] = $result['apellido'];
                    header("Location: ../views2/view2homeAdmin.php"); // Redirige al panel de administración
                    exit();
                } else {
                    // Contraseña incorrecta
                    $message = "Contraseña incorrecta.";
                }
            } else {
                // Nombre de usuario no encontrado
                $message = "Nombre de usuario no encontrado.";
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
