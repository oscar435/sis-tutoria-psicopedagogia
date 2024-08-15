<?php
// Verificar si el usuario ha iniciado sesión y si los datos necesarios están en la sesión
if (!isset($_SESSION['session_codigo']) || !isset($_SESSION['session_fullname'])) {
    header("Location: ../views/viewLoginEstudiante.php");
    exit();
}
?>

<div class="navbar">
    <div class="user-info">
        <img src="../images/icon_user.jpg" alt="Icono de usuario" width="40" height="40">
        <div class="user-details">
            <!-- Mostrar el nombre completo y el código del usuario desde la sesión -->
            <span><?php echo htmlspecialchars($_SESSION['session_fullname']); ?></span>
            <span><?php echo htmlspecialchars($_SESSION['session_codigo']); ?></span>
        </div>
    </div>
    <nav>
        <div class="dropdown">
            <a href="#" class="dropbtn">Recursos Educativos</a>
            <div class="dropdown-content">
                <a href="https://linktr.ee/FIEI_tutoria_psicopedagogia">Enlaces Educativos</a>
                <a href="https://linktr.ee/Tutoria_UNFV">Enlaces Adicionales</a>
            </div>
        </div>


        <!--<div class="dropdown">
            <a href="#" class="dropbtn">Opciones de Tutoría</a>
            <div class="dropdown-content">
                <a href="#">Buscar Tutores</a>
                <a href="#">Mis Tutores</a>
                <a href="#">Historial de sesiones</a>
            </div>
        </div>-->


        <div class="dropdown">
    <a href="#" class="dropbtn">Comunícate</a>
    <div class="dropdown-content">
        <a href="#footer" id="contFooter">Telef. Oficina</a>
        <a href="#footer" id="contFooter">Correo Oficina</a>
    </div>
</div>
        <!-- Enlace para cerrar sesión -->
        <a href="../controllers/logoutController.php" class="logout">Cerrar Sesión</a>
    </nav>
</div>
