<?php
session_start();
if (!isset($_SESSION['tutor_id'])) {
    header("Location: ../views3/view3LoginTutor.php");
    exit();
}

// Datos del tutor almacenados en la sesión
$tutor_codigo = $_SESSION['tutor_codigo_docente']; // Cambiado a 'tutor_codigo_docente'
$tutor_nombre = $_SESSION['tutor_nombre'];
$tutor_apellido = $_SESSION['tutor_apellido'];
?>

<header>
    <div class="header-left">
        <div class="tutor-info">
            <img src="../images/iconos/userAdmin.png" alt="Icono" width="40" height="40">
            <div class="tutor-text">
                <span class="tutor-name"><?php echo htmlspecialchars($tutor_nombre . ' ' . $tutor_apellido); ?></span>
                <span class="tutor-title"><?php echo htmlspecialchars($tutor_codigo); ?></span>

            </div>
        </div>
    </div>
    <div class="header-right">
        <a href="../controllers/logoutControllerTutor.php" class="logout-btn">Cerrar Sesión</a>
    </div>
</header>
