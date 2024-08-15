<?php
require_once("../config/connection.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Consulta SQL para actualizar los campos específicos
    $query = "UPDATE disponibilidad_docentes 
              SET curso_1 = NULL, curso_2 = NULL, curso_3 = NULL, curso_4 = NULL, 
                  fecha = NULL, turno = NULL, horas = NULL, modalidad = NULL, comentarios = NULL 
              WHERE id = ?";
    
    $stmt = $connection->prepare($query);
    
    try {
        if ($stmt->execute([$id])) {
            header('Location: view3homeTutor.php?id=' . $id . '&status=deleted');
        } else {
            echo "Error al eliminar los datos.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de disponibilidad no proporcionado.";
}
exit();
