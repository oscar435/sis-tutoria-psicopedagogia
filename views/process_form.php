<?php

session_start(); // Inicia la sesión

// Recoge los datos del formulario
$formData = array(
    'emotion' => $_POST['emotion'] ?? '',
    'study_hours' => $_POST['study_hours'] ?? '',
    'performance_rating' => $_POST['performance_rating'] ?? '',
    'fisico' => $_POST['fisico'] ?? '',
    'afectivo' => $_POST['afectivo'] ?? '',
    'estres' => $_POST['estres'] ?? '',
    'stress_management' => $_POST['stress_management'] ?? '',
    'balance' => $_POST['balance'] ?? '',
    'satisfaction' => $_POST['satisfaction'] ?? '',
    'phone' => $_POST['phone'] ?? '', 
    'email' => $_POST['email'] ?? '',
    'student_code' => $_POST['student_code'] ?? '', // Código del estudiante
    'student_name' => $_POST['student_name'] ?? ''  // Nombre completo del estudiante
);


// Almacena los datos adicionales en la sesión
$_SESSION['studentData'] = $studentData;

// Almacena los datos del formulario en la sesión
$_SESSION['formData'] = $formData;

// Redirige al script de generación del PDF
header('Location: generate_pdf.php');
exit();
?>
