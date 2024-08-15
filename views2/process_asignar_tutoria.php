<?php
// Archivo: process_asignar_tutoria.php
require_once("../config/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo_tutoria = $_POST['tipo-tutoria'];
    $codi_docente = $_POST['codi_docente'];
    $nombre_docente = $_POST['docente-nombre'];
    $apellido_docente = $_POST['docente-apellido'];
    $codigo_estudiante = $_POST['codigo-estudiante'];
    $nombre_estudiante = $_POST['nombre-estudiante'];
    $apellido_estudiante = $_POST['apellido-estudiante'];
    $telefono = $_POST['telefono'];
    $correo_personal = $_POST['correo-personal'];
    $correo_institucional = isset($_POST['correo-institucional']) ? $_POST['correo-institucional'] : null;
    $escuela = $_POST['escuela'];
    $semestre = $_POST['semestre'];
    $curso = $_POST['curso'];
    $fecha = $_POST['fecha'];
    $hora_inicio = $_POST['hora-inicio'];
    $turno = $_POST['turno'];
    $modalidad = $_POST['modalidad'];
    $horas_tutoria = $_POST['horas-tutoria'];
    $salon = isset($_POST['salon']) ? $_POST['salon'] : null;

    // Si el tipo de tutoría es individual, el salón no debería ser obligatorio
    if ($tipo_tutoria === 'individual') {
        $salon = null; // O puedes usar una cadena vacía si prefieres
    }

    try {
        $stmt = $connection->prepare("INSERT INTO tutorias (tipo_tutoria, nombre_docente, apellido_docente, codi_docente, nombre_estudiante, apellido_estudiante, codigo_estudiante, correo_personal, correo_institucional, telefono, escuela, semestre, curso, fecha, hora_inicio, turno, modalidad, horas_tutoria, salon) VALUES (:tipo_tutoria, :nombre_docente, :apellido_docente, :codi_docente, :nombre_estudiante, :apellido_estudiante, :codigo_estudiante, :correo_personal, :correo_institucional, :telefono, :escuela, :semestre, :curso, :fecha, :hora_inicio, :turno, :modalidad, :horas_tutoria, :salon)");
        
        $stmt->bindParam(':tipo_tutoria', $tipo_tutoria);
        $stmt->bindParam(':nombre_docente', $nombre_docente);
        $stmt->bindParam(':apellido_docente', $apellido_docente);
        $stmt->bindParam(':codi_docente', $codi_docente);
        $stmt->bindParam(':nombre_estudiante', $nombre_estudiante);
        $stmt->bindParam(':apellido_estudiante', $apellido_estudiante);
        $stmt->bindParam(':codigo_estudiante', $codigo_estudiante);
        $stmt->bindParam(':correo_personal', $correo_personal);
        $stmt->bindParam(':correo_institucional', $correo_institucional);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':escuela', $escuela);
        $stmt->bindParam(':semestre', $semestre);
        $stmt->bindParam(':curso', $curso);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':hora_inicio', $hora_inicio);
        $stmt->bindParam(':turno', $turno);
        $stmt->bindParam(':modalidad', $modalidad);
        $stmt->bindParam(':horas_tutoria', $horas_tutoria);
        $stmt->bindParam(':salon', $salon);

        $stmt->execute();
        echo "Tutoria asignada exitosamente.";
    } catch (PDOException $e) {
        echo "Error al asignar tutoria: " . $e->getMessage();
    }
} else {
    echo "Método de solicitud no permitido.";
}
?>
