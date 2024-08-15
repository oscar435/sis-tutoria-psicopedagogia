<?php
/*require_once("../config/connection.php");
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['admin_username'])) {
    header("Location: ../views2/view2LoginAdmin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cod_estudiante = $_POST['cod_estudiante'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $correo_personal = $_POST['correo_personal'];
    $escuela = $_POST['escuela'];
    $semestre = $_POST['semestre'];

    try {
        // Prepara la consulta de actualización
        $query = $connection->prepare("
            UPDATE estudiante 
            SET 
                nombre = :nombre, 
                apellido = :apellido, 
                telefono = :telefono, 
                correo_personal = :correo_personal, 
                escuela = :escuela, 
                semestre = :semestre
            WHERE 
                cod_estudiante = :cod_estudiante
        ");

        // Bindeo de los parámetros
        $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $query->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $query->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $query->bindParam(':correo_personal', $correo_personal, PDO::PARAM_STR);
        $query->bindParam(':escuela', $escuela, PDO::PARAM_STR);
        $query->bindParam(':semestre', $semestre, PDO::PARAM_STR);
        $query->bindParam(':cod_estudiante', $cod_estudiante, PDO::PARAM_STR);

        // Ejecutar la consulta
        $query->execute();

        // Redirigir de nuevo a la lista de estudiantes
        header("Location: ../views2/listEstudiante.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Método no permitido";
}
    */
?>
