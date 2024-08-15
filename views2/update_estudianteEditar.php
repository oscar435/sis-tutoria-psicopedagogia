<?php
require_once("../config/connection.php");

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    try {
        $stmt = $connection->prepare("
            UPDATE estudiante
            SET cod_estudiante = :cod_estudiante,
                nombre = :nombre,
                apellido = :apellido,
                telefono = :telefono,
                correo_personal = :correo_personal,
                escuela = :escuela,
                semestre = :semestre
            WHERE id = :id
        ");

        $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
        $stmt->bindParam(':cod_estudiante', $data['cod_estudiante'], PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':apellido', $data['apellido'], PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
        $stmt->bindParam(':correo_personal', $data['correo_personal'], PDO::PARAM_STR);
        $stmt->bindParam(':escuela', $data['escuela'], PDO::PARAM_STR);
        $stmt->bindParam(':semestre', $data['semestre'], PDO::PARAM_STR);

        $stmt->execute();

        echo "Datos actualizados exitosamente.";
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'ID no proporcionado';
}
?>
