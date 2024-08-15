<?php

session_start(); // Inicia la sesión


// Recoge los datos del formulario
$formData2 = array(
    'nombre_completo' => $_POST['nombre_completo'] ?? '',
    'codigo_estudiante' => $_POST['codigo_estudiante'] ?? '',
    'telefono' => $_POST['telefono'] ?? '',
    'email' => $_POST['email'] ?? '',
    'tutoria' => $_POST['tutoria'] ?? '', // Tipo de tutoría
    'teacher' => $_POST['teacher'] ?? '', // Docente seleccionado}
    'cursos'  => $_POST['cursos'] ?? '', // curso seleccionado
    'teacher_name' => $_POST['teacher_name'] ?? '', // Nombre del docente
    'fecha' => $_POST['fecha'] ?? '', // Fecha seleccionada
    'turno' => $_POST['turno'] ?? '', // Turno seleccionado
    'horas' => $_POST['horas'] ?? '', // Horas seleccionadas
    'modalidad' => $_POST['modalidad'] ?? '', // Modalidad seleccionada
    'motivo' => $_POST['motivo'] ?? '',
    'motivo_otro' => $_POST['motivo_otro'] ?? '', // En caso de seleccionar "Otro" en motivo
    'expectativas' => $_POST['expectativas'] ?? '',
    'expectativas_otro' => $_POST['expectativas_otro'] ?? '', // En caso de seleccionar "Otro" en expectativas
    'preferencia' => $_POST['preferencia'] ?? '',
    'tiempo' => $_POST['tiempo'] ?? '',
    'recursos' => $_POST['recursos'] ?? [],
    'requerimientos' => $_POST['requerimientos'] ?? []
);



// Almacena los datos del formulario en la sesión con una clave específica
$_SESSION['tutoria_individual'] = $formData2;

// Depura los datos de disponibilidad para asegurar que todo se está capturando correctamente(se tiene que eliminar al momento de subirlo el proyecto)
/*echo '<pre>';
print_r($formData2);
echo '</pre>';*/

// Redirige al script de generación del PDF
header('Location: generate_pdf_tutoIndiv.php');
exit();

?>
