<?php
require_once("../config/connection.php");

$data = json_decode(file_get_contents('php://input'), true);

try {
    $stmt = $connection->prepare("UPDATE tutor SET nombre = :nombre, apellido = :apellido, dni = :dni, telefono = :telefono, correo_institucional = :correo_institucional, carrera = :carrera WHERE codigo_docente = :codigo_docente");
    
    $stmt->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
    $stmt->bindParam(':apellido', $data['apellido'], PDO::PARAM_STR);
    $stmt->bindParam(':dni', $data['dni'], PDO::PARAM_STR);
    $stmt->bindParam(':telefono', $data['telefono'], PDO::PARAM_STR);
    $stmt->bindParam(':correo_institucional', $data['correo_institucional'], PDO::PARAM_STR);
    $stmt->bindParam(':carrera', $data['carrera'], PDO::PARAM_STR);
    $stmt->bindParam(':codigo_docente', $data['codigo_docente'], PDO::PARAM_STR);
    
    $stmt->execute();
    echo "Tutor actualizado exitosamente.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
