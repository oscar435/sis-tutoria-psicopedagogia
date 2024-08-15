<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../views2/view2LoginAdmin.php");
    exit();
}

$admin_username = $_SESSION['admin_username'];
$admin_nombre = $_SESSION['admin_nombre'];
$admin_apellido = $_SESSION['admin_apellido'];
?>

<header>
    <div class="header-left">
        <div class="admin-info">
            <img src="../images/iconos/userAdmin.png" alt="Icono de usuario" width="40" height="40">
            <div class="admin-text">
                <span class="admin-title"><?php echo htmlspecialchars($admin_username); ?></span>
                <span class="admin-name"><?php echo htmlspecialchars($admin_nombre . ' ' . $admin_apellido); ?></span>
            </div>
        </div>
    </div>
    <div class="header-right">
        <a href="../controllers/logoutControllerAdmin.php" class="logout-btn">Cerrar Sesión</a>
    </div>
</header>
