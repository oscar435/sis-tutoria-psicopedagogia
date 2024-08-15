<?php
require_once("../config/connection.php");

try {
    $stmt = $connection->prepare("SELECT 
        id, 
        tipo_tutoria, 
        nombre_docente, 
        apellido_docente, 
        codi_docente, 
        nombre_estudiante, 
        apellido_estudiante, 
        codigo_estudiante, 
        correo_personal, 
        correo_institucional, 
        telefono, 
        escuela, 
        semestre, 
        curso, 
        fecha, 
        hora_inicio, 
        turno, 
        modalidad, 
        horas_tutoria, 
        salon 
        FROM tutorias");
    $stmt->execute();
    $tutorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'tutorias' => $tutorias
    ]);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
}
?>
