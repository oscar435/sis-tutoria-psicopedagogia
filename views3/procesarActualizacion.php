<?php
require_once("../config/connection.php");

session_start();
$tutor_id = $_SESSION['tutor_id'];
$id = $_POST['id'];

// Verifica si 'action' está definida
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action === 'update') {
    // Actualizar disponibilidad
    $cursos = $_POST['cursos'];
    $fecha = $_POST['fecha'];
    $turno = $_POST['turno'];
    $horas = $_POST['horas'];
    $modalidad = $_POST['modalidad'];

    // Prepara la consulta SQL
    $query = "UPDATE disponibilidad_docentes 
              SET curso_1 = :cursos, fecha = :fecha, turno = :turno, horas = :horas, modalidad = :modalidad 
              WHERE id = :id AND tutor_id = :tutor_id";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':cursos', $cursos);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':turno', $turno);
    $stmt->bindParam(':horas', $horas);
    $stmt->bindParam(':modalidad', $modalidad);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':tutor_id', $tutor_id, PDO::PARAM_INT);
    
    try {
        if ($stmt->execute()) {
            header('Location: view3homeTutor.php?id=' . $id . '&status=success');
        } else {
            header('Location: actualizarDisponibilidad.php?id=' . $id . '&status=error');
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
}
exit();
