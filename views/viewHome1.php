<?php
session_start();
if (!isset($_SESSION['session_codigo'])) {
    header("Location: ../views/viewLoginEstudiante.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../assets/css/home/home1.css">
</head>
<body>
    <?php include '../includes/headerHome1.php'; ?>
    <div class="container">
    </div>
    <div class="buttons">
        <button onclick="window.location.href='viewTutoIndiv.php'">
            <img src="../images/icon_individual.png" alt="Tutoría Individual" class="button-icon">
            <span>TUTORIAS</span>
        </button>
        <!--<button onclick="window.location.href='viewTutoGrup.php'">
            <img src="../images/icon_grupal.png" alt="Tutoría Grupal" class="button-icon">
            <span>Tutoría Grupal</span>
        </button>-->
        <button onclick="window.location.href='viewFormPsico.php'">
            <img src="../images/icon_psicopedagogia.png" alt="Ayuda Psicopedagógica" class="button-icon">
            <span>AYUDA PSICOPEDAGOGICA</span>
        </button>
        <button onclick="window.location.href='../includes/infofinal.php'">
            <img src="../images/icon_info.png" alt="Información" class="button-icon">
            <span>Acerca de..</span>
        </button>
    </div>
    <div id="footer">
         <?php include('../includes/footer.php'); ?>
    </div>

</body>
</html>
