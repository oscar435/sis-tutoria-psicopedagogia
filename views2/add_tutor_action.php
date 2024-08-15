<?php
// Archivo: add_tutor_action.php
require_once("../config/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_docente = $_POST['codigo_docente'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $telefono = $_POST['telefono'];
    $correo_institucional = $_POST['correo_institucional'];
    $clave_tutor = $_POST['clave_tutor'];
    $carrera = $_POST['carrera'];

    try {
        // Preparar la consulta
        $stmt = $connection->prepare("INSERT INTO tutor (codigo_docente, nombre, apellido, dni, telefono, correo_institucional, clave_tutor, carrera) VALUES (:codigo_docente, :nombre, :apellido, :dni, :telefono, :correo_institucional, :clave_tutor, :carrera)");
        
        // Enlazar los parámetros
        $stmt->bindParam(':codigo_docente', $codigo_docente);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':dni', $dni);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correo_institucional', $correo_institucional);
        $stmt->bindParam(':clave_tutor', $clave_tutor);
        $stmt->bindParam(':carrera', $carrera);

        // Ejecutar la consulta
        $stmt->execute();

        echo "Nuevo tutor agregado exitosamente.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
