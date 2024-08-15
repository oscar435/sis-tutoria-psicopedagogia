<?php
require_once("../config/connection.php");
ini_set('session.gc_maxlifetime', 86400); // 1 día en segundos
session_set_cookie_params(86400); // 1 día en segundos
session_start();

if (isset($_POST["login"])) {
    if (!empty($_POST['codigo']) && !empty($_POST['password'])) {
        $codigo = $_POST['codigo'];
        $password = $_POST['password'];

        $query = $connection->prepare("SELECT * FROM estudiante WHERE cod_estudiante = :codigo");
        $query->bindParam(":codigo", $codigo, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            $message = "La combinación del código y la contraseña es inválida.";
        } else {
            // Verificar la contraseña usando password_verify
            if (password_verify($password, $result['password'])) {
                // Guardar el código y el nombre completo en la sesión
                    // Guardar información del estudiante en la sesión
    $_SESSION['session_codigo'] = $codigo;
    $_SESSION['session_fullname'] = $result['nombre'] . ' ' . $result['apellido'];
    $_SESSION['session_semestre'] = $result['semestre'];
    $_SESSION['session_escuela'] = $result['escuela'];

    header("Location: ../views/viewHome1.php");
    exit();
            } else {
                $message = "Código de estudiante o contraseña inválida.";
            }
        }
    } else {
        $message = "Todos los campos son requeridos.";
    }
}

if (!empty($message)) {
    echo "<p class=\"error\">$message</p>";
}
?>
