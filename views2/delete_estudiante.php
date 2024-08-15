<?php
require_once("../config/connection.php");

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

try {
    $stmt = $connection->prepare("DELETE FROM estudiante WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    echo 'Estudiante eliminado correctamente.';
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
