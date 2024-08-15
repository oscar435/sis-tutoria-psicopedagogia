
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio del Tutor</title>
    <link rel="stylesheet" href="../assets/css/homeTutor/estilosGeneralesTutor.css">
    <link rel="stylesheet" href="../views3/formDisponibilidad.css"> <!-- CSS del formulario -->
    <link rel="stylesheet" href="../views3/actualizarDisponibilidad.css">
    <link rel="stylesheet" href="../views3/verDisponibilidades.css">
    <link rel="stylesheet" href="../views3/ver_tutoriasTutor.css">

</head>
<body>
    <!-- Contenedor para el mensaje -->
    <div id="mensaje-top" style="display: none; position: fixed; top: 0; width: 100%; background-color: #f4f4f4; padding: 10px; border-bottom: 1px solid #ddd; text-align: center;">
        <!-- El mensaje se insertará aquí -->
    </div>
    <?php if (isset($_GET['status'])): ?>
        <script>
      document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('btn-actualizar-disponibilidad').addEventListener('click', function(e) {
        e.preventDefault();
        
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'actualizarDisponibilidad.php', true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                document.getElementById('form-container').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    });
});
</script>

<?php endif; ?>



    <!-- Archivo que se incluye en el body (el encabezado) -->
    <?php 
        include '../includes/headerHomeTutor.php'; 
        
        // Pasar los datos del tutor a JavaScript
        echo "<script>
            window.docenteData = {
                nombre: '" . addslashes($tutor_nombre) . "',
                apellido: '" . addslashes($tutor_apellido) . "',
                codigo: '" . addslashes($tutor_codigo) . "'
            };
        </script>";
    ?>

    <!-- Contenedor principal -->
    <div class="container">
        <main id="main-content">
            <section class="main-section" id="form-container">
                <!-- Contenedor para cargar el formulario dinámicamente -->
                <div id="form-container">
                    <?php include '../views3/contenedorContenidosTutor.php'; ?>
                </div>
            </section>
        </main>
    </div>

    <!-- Barra lateral fija en la parte inferior -->
    <nav class="sidebar">
        <ul>
            <li><a href="#" id="btn-gestion-disponibilidad" class="sidebar-item">Registrar Disponibilidad</a></li>
            <li><a href="#" id="btn-actualizar-disponibilidad" data-id="1" class="sidebar-item">Modificar mis disponibilidades</a></li>
            

            <li><a href="#" id="btn-ver-disponibilidad" data-id="1" class="sidebar-item">Ver mis disponibilidades</a></li>
            <li><a href="ver-tutorias" id="ver-tutorias">Tutorías Asignadas</a></li>
            <!--<li><a href="messaging.php" class="sidebar-item">Comunicación con Estudiantes</a></li>-->
        </ul>
    </nav>

    <!-- Incluye el archivo JavaScript al final del body -->
    <script src="../views3/formDisponibilidad.js"></script>
    <script src="../views3/actualizarDisponibilidad.js" defer></script>
    <script src="../views3/verDisponibilidades.js"></script>
    <script src="../views3/ajaxActualizacionSeleccionDispo.js"></script>
    <script src="../views2/ver_tutorias.js"></script>
    <script src="../views3/tutorias_asignadas.js"></script>
</body>
</html>
