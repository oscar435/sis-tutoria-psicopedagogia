<?php
require_once("../config/connection.php");
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['key'])) {
        $inputKey = $_POST['key'];

        try {
            // Prepara la consulta para obtener la clave almacenada en la base de datos
            $id = 1; // Ajusta este valor según tu lógica
            $query = $connection->prepare("SELECT clave_admin FROM administrador WHERE id = :id");
            $query->bindParam(":id", $id, PDO::PARAM_INT);
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                // No se encontró la clave en la base de datos
                echo json_encode(['success' => false, 'error' => 'No se encontró la clave en la base de datos']);
            } else {
                $storedKey = $result['clave_admin'];

                if ($inputKey === $storedKey) {
                    // Clave correcta
                    echo json_encode(['success' => true]);
                } else {
                    // Clave incorrecta
                    echo json_encode(['success' => false, 'error' => 'Clave incorrecta']);
                }
            }
        } catch (PDOException $e) {
            // Manejo de errores de PDO
            echo json_encode(['success' => false, 'error' => 'Error en la base de datos: ' . $e->getMessage()]);
        }
    } else {
        // No se proporcionó la clave
        echo json_encode(['success' => false, 'error' => 'Ingrese la clave de seguridad.']);
    }
} else {
    // Método no permitido
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}
?>
