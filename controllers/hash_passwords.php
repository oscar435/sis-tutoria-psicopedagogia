<?php

require_once("../config/connection.php");
//ejecutar script una vez para actualizar las contraseñas existentes en tu base de datos para que estén hashadas.

try {
    // Obtener todas las filas de la tabla estudiante
    $query = $connection->query("SELECT id, password FROM estudiante");
    $students = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($students as $student) {
        // Si la contraseña no está hashada (longitud menor a 60), la hashamos
        if (strlen($student['password']) < 60) {
            $hashedPassword = password_hash($student['password'], PASSWORD_DEFAULT);
            $updateQuery = $connection->prepare("UPDATE estudiante SET password = :password WHERE id = :id");
            $updateQuery->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $updateQuery->bindParam(':id', $student['id'], PDO::PARAM_INT);
            $updateQuery->execute();
        }
    }

    echo "Contraseñas actualizadas correctamente.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
