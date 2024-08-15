<?php
require_once("../config/connection.php");

$data = json_decode(file_get_contents('php://input'), true);

try {
    $stmt = $connection->prepare("DELETE FROM tutor WHERE codigo_docente = :codigo_docente");
    $stmt->bindParam(':codigo_docente', $data['id'], PDO::PARAM_STR);
    
    $stmt->execute();
    echo "Tutor eliminado exitosamente.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
