<?php
require_once("../config/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod_estudiante = $_POST['cod_estudiante'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $correo_personal = $_POST['correo_personal'];
    $escuela = $_POST['escuela'];
    $semestre = $_POST['semestre'];

    try {
        // Preparar la consulta
        $stmt = $connection->prepare("INSERT INTO estudiante (cod_estudiante, nombre, apellido, telefono, correo_personal, escuela, semestre) VALUES (:cod_estudiante, :nombre, :apellido, :telefono, :correo_personal, :escuela, :semestre)");
        
        // Enlazar los parámetros
        $stmt->bindParam(':cod_estudiante', $cod_estudiante);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correo_personal', $correo_personal);
        $stmt->bindParam(':escuela', $escuela);
        $stmt->bindParam(':semestre', $semestre);

        // Ejecutar la consulta
        $stmt->execute();

        echo "Nuevo estudiante agregado exitosamente.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
