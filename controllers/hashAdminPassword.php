<?php

require_once("../config/connection.php");

try {
    // Obtener todas las filas de la tabla administrador
    $query = $connection->query("SELECT id, password FROM administrador");
    $administrators = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($administrators as $admin) {
        // Si la contraseña no está hasheada (longitud menor a 60), la hashamos
        if (strlen($admin['password']) < 60) {
            $hashedPassword = password_hash($admin['password'], PASSWORD_DEFAULT);
            $updateQuery = $connection->prepare("UPDATE administrador SET password = :password WHERE id = :id");
            $updateQuery->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $updateQuery->bindParam(':id', $admin['id'], PDO::PARAM_INT);
            $updateQuery->execute();
        }
    }

    echo "Contraseñas de administradores actualizadas correctamente.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
