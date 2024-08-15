<?php
session_start(); // Inicia la sesión
require_once('../config/connection.php'); // Incluye la conexión a la base de datos

header('Content-Type: application/json');

// Verifica si los datos del estudiante ya están en la sesión
if (isset($_SESSION['studentData'])) {
    echo json_encode($_SESSION['studentData']);
    exit();
}

// Verifica si el código del estudiante está en la sesión
if (!isset($_SESSION['session_codigo'])) {
    echo json_encode(['error' => 'Código del estudiante no encontrado.']);
    exit();
}

$studentCode = $_SESSION['session_codigo'];

try {
    $query = $connection->prepare('SELECT semestre, escuela FROM estudiante WHERE cod_estudiante = :cod_estudiante');
    $query->execute(['cod_estudiante' => $studentCode]);
    $studentData = $query->fetch(PDO::FETCH_ASSOC);

    if ($studentData) {
        // Guardar los datos en la sesión
        $_SESSION['studentData'] = $studentData;
        echo json_encode($studentData);
    } else {
        echo json_encode(['error' => 'Datos del estudiante no encontrados.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => "Error al consultar la base de datos: " . $e->getMessage()]);
}

?>
