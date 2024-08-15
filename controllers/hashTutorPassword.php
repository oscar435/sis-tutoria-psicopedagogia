<?php

require_once("../config/connection.php");

try {
    // Obtener todas las filas de la tabla tutor
    $query = $connection->query("SELECT codigo_docente, password FROM tutor");
    $tutors = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tutors as $tutor) {
        // Si la contraseña no está hasheada (longitud menor a 60), la hashamos
        if (strlen($tutor['password']) < 60) {
            $hashedPassword = password_hash($tutor['password'], PASSWORD_DEFAULT);
            $updateQuery = $connection->prepare("UPDATE tutor SET password = :password WHERE codigo_docente = :codigo_docente");
            $updateQuery->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $updateQuery->bindParam(':codigo_docente', $tutor['codigo_docente'], PDO::PARAM_INT);
            $updateQuery->execute();
        }
    }

    echo "Contraseñas de tutores actualizadas correctamente.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
