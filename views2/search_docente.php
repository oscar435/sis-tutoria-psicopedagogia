<?php
// Archivo: search_docente.php
require_once("../config/connection.php");

if (isset($_GET['codigo_docente'])) {
    $codigo_docente = $_GET['codigo_docente'];

    try {
        $stmt = $connection->prepare("SELECT codigo_docente, nombre, apellido FROM tutor WHERE codigo_docente = :codigo_docente");
        $stmt->bindParam(':codigo_docente', $codigo_docente);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            echo json_encode(['success' => true, 'nombre' => $result['nombre'], 'apellido' => $result['apellido']]);
        } else {
            echo json_encode(['success' => false]);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Código docente no proporcionado']);
}
?>
