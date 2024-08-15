<?php
session_start();
require_once('../config/connection.php');

// Obtener el ID del tutor desde la sesión
$tutor_id = $_SESSION['tutor_id'];

// Consultar todas las disponibilidades del tutor
$query = "SELECT * FROM disponibilidad_docentes WHERE tutor_id = :tutor_id";
$stmt = $connection->prepare($query);
$stmt->bindParam(':tutor_id', $tutor_id);
$stmt->execute();
$disponibilidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Disponibilidades</title>
    <link rel="stylesheet" href="../views3/formDisponibilidad.css">
</head>
<body>

<h1>Disponibilidades del Tutor</h1>

<table>
    <thead>
        <tr>
            <th>Cursos</th>
            <th>Fecha</th>
            <th>Turno</th>
            <th>Horas</th>
            <th>Modalidad</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($disponibilidades as $disponibilidad): ?>
            <tr>
                <td><?php echo htmlspecialchars($disponibilidad['curso_1']); ?></td>
                <td><?php echo htmlspecialchars($disponibilidad['fecha']); ?></td>
                <td><?php echo htmlspecialchars($disponibilidad['turno']); ?></td>
                <td><?php echo htmlspecialchars($disponibilidad['horas']); ?></td>
                <td><?php echo htmlspecialchars($disponibilidad['modalidad']); ?></td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>