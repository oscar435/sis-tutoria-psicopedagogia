<?php
// Archivo: search_estudiante.php
require_once("../config/connection.php");

if (isset($_GET['codigo_estudiante'])) {
    $codigo_estudiante = $_GET['codigo_estudiante'];

    try {
        $stmt = $connection->prepare("SELECT cod_estudiante, nombre, apellido, telefono, correo_personal, escuela, semestre FROM estudiante WHERE cod_estudiante = :codigo_estudiante");
        $stmt->bindParam(':codigo_estudiante', $codigo_estudiante);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            echo json_encode([
                'success' => true,
                'nombre' => $result['nombre'],
                'apellido' => $result['apellido'],
                'telefono' => $result['telefono'],
                'correo_personal' => $result['correo_personal'],
                'escuela' => $result['escuela'],
                'semestre' => $result['semestre']
            ]);
        } else {
            echo json_encode(['success' => false]);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Código estudiante no proporcionado']);
}
?>
