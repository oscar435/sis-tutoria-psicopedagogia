<?php
require_once('../config/connection.php');

$tutorId = isset($_GET['tutor_id']) ? (int)$_GET['tutor_id'] : 0;

if ($tutorId > 0) {
    $stmt = $connection->prepare('SELECT curso_1, curso_2, curso_3, curso_4, fecha, turno, horas, modalidad 
                                  FROM disponibilidad_docentes 
                                  WHERE tutor_id = :tutor_id');
    $stmt->bindParam(':tutor_id', $tutorId, PDO::PARAM_INT);
    $stmt->execute();
    $disponibilidades = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retornar los datos como JSON
    echo json_encode($disponibilidades);
} else {
    echo json_encode([]); // Si no se pasa un ID válido, retornar un array vacío
}
?>
