<?php
session_start(); // Inicia la sesión

// Verifica si los datos del estudiante están en la sesión
if (!isset($_SESSION['studentData'])) {
    die('Datos del estudiante no disponibles.');
}

// Obtiene los datos del estudiante
$studentData = $_SESSION['studentData'];
$semester = $studentData['semestre'];
$school = $studentData['escuela'];

// Muestra los datos
echo "Semestre: " . htmlspecialchars($semester) . "<br>";
echo "Escuela: " . htmlspecialchars($school) . "<br>";
?>
