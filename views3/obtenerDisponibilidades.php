<?php
session_start();
require_once('../config/connection.php');

// Obtener el ID del tutor desde la sesión
$tutor_id = $_SESSION['tutor_id'];

header('Content-Type: application/json');

try {
    // Consultar todas las disponibilidades del tutor
    $query = "SELECT * FROM disponibilidad_docentes WHERE tutor_id = :tutor_id";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':tutor_id', $tutor_id);
    $stmt->execute();
    $disponibilidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Devolver los resultados en formato JSON
    echo json_encode($disponibilidades);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al obtener disponibilidades: ' . $e->getMessage()]);
}
?>
