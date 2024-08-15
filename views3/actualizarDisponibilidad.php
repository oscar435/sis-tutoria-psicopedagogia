<?php
require_once('../config/connection.php');
session_start();
$tutor_id = $_SESSION['tutor_id'];

// Inicializar variables
$disponibilidad = null;
$tutor = null;
$selected_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Consultar todas las disponibilidades del tutor
$stmt = $connection->prepare('SELECT * FROM disponibilidad_docentes WHERE tutor_id = ?');
$stmt->execute([$tutor_id]);
$disponibilidades = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener los datos de la disponibilidad seleccionada
if ($selected_id) {
    $stmt = $connection->prepare('SELECT * FROM disponibilidad_docentes WHERE id = ?');
    $stmt->execute([$selected_id]);
    $disponibilidad = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$disponibilidad) {
        echo "Disponibilidad no encontrada.";
        exit();
    }

    // Consultar los datos del tutor si se ha encontrado una disponibilidad
    $stmt = $connection->prepare('SELECT * FROM tutor WHERE id = ?');
    $stmt->execute([$tutor_id]);
    $tutor = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$tutor) {
        echo "Docente no encontrado.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Disponibilidad</title>
    <link rel="stylesheet" href="../views3/formDisponibilidad.css">
    <link rel="stylesheet" href="../views3/actualizarDisponibilidad.css">
</head>
<body>

    <h1>Actualizar Disponibilidad</h1>

    <form action="procesarActualizacion.php" method="post">

        <!-- Selección de Disponibilidad -->
        <div class="form-group">
            <label for="select-disponibilidad">Selecciona una Disponibilidad a modificar de la lista:</label>
            <select id="select-disponibilidad" name="select-id" onchange="cargarDisponibilidad(this.value)">
                <option value="">Selecciona una disponibilidad</option>
                <?php foreach ($disponibilidades as $item): ?>
                    <option value="<?php echo htmlspecialchars($item['id']); ?>"
                        <?php echo ($item['id'] == $selected_id) ? 'selected' : ''; ?>>
                        Disponibilidad ID: <?php echo htmlspecialchars($item['id']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <?php if ($disponibilidad && $tutor): ?>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($disponibilidad['id']); ?>">
            <input type="hidden" name="action" value="update"> <!-- Campo oculto para la acción -->

            <!-- Información del Docente -->
            <h4>INFORMACIÓN DEL DOCENTE</h4>
            <div class="form-group horizontal-group">
                
                <div class="input-wrapper">
                    <label for="nombre-docente">Nombres:</label>
                    <input type="text" id="nombre-docente" name="nombre-docente" value="<?php echo htmlspecialchars($tutor['nombre']); ?>" readonly>
                </div>
                <div class="input-wrapper">
                    <label for="apellido-docente">Apellidos:</label>
                    <input type="text" id="apellido-docente" name="apellido-docente" value="<?php echo htmlspecialchars($tutor['apellido']); ?>" readonly>
                </div>
                <div class="input-wrapper">
                    <label for="codigo-docente">Código de docente:</label>
                    <input type="text" id="codigo-docente" name="codigo-docente" value="<?php echo htmlspecialchars($tutor['codigo_docente']); ?>" readonly>
                </div>
            </div>

            <!-- Cursos -->
            <h4>CURSOS QUE ENSEÑA EL DOCENTE:</h4>
            <div class="form-group horizontal-group">
            
                <div class="input-wrapper">
                    <label for="curso-1">Curso 1:</label>
                    <input type="text" id="curso-1" name="cursos[]" value="<?php echo htmlspecialchars($disponibilidad['curso_1']); ?>" required>
                </div>
                <div class="input-wrapper">
                    <label for="curso-2">Curso 2:</label>
                    <input type="text" id="curso-2" name="cursos[]" value="<?php echo htmlspecialchars($disponibilidad['curso_2']); ?>">
                </div>
                <div class="input-wrapper">
                    <label for="curso-3">Curso 3:</label>
                    <input type="text" id="curso-3" name="cursos[]" value="<?php echo htmlspecialchars($disponibilidad['curso_3']); ?>">
                </div>
                <div class="input-wrapper">
                    <label for="curso-4">Curso 4:</label>
                    <input type="text" id="curso-4" name="cursos[]" value="<?php echo htmlspecialchars($disponibilidad['curso_4']); ?>">
                </div>
            </div>

            <!-- Fecha y Turno -->
            <h4>FECHA Y TURNO DISPONIBLE PARA LA TUTORIA:</h4>
            <div class="form-group horizontal-group">
            
                <div class="input-wrapper">
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" value="<?php echo htmlspecialchars($disponibilidad['fecha']); ?>" required>
                </div>
                <div class="input-wrapper">
                    <label for="turno">Turno:</label>
                    <select id="turno" name="turno" required>
                        <option value="mañana" <?php echo ($disponibilidad['turno'] == 'mañana') ? 'selected' : ''; ?>>Mañana</option>
                        <option value="tarde" <?php echo ($disponibilidad['turno'] == 'tarde') ? 'selected' : ''; ?>>Tarde</option>
                        <option value="noche" <?php echo ($disponibilidad['turno'] == 'noche') ? 'selected' : ''; ?>>Noche</option>
                    </select>
                </div>
            </div>

            <!-- Horas de Enseñanza y Modalidad -->
            <h4>TIEMPO QUE DESEA ENSEÑAR Y LA MODALIDAD:</h4>
            <div class="form-group horizontal-group">

                <div class="input-wrapper">
                    <label for="horas">Horas de enseñanza:</label>
                    <select id="horas" name="horas" required>
                        <option value="1" <?php echo ($disponibilidad['horas'] == '1') ? 'selected' : ''; ?>>1 hora</option>
                        <option value="2" <?php echo ($disponibilidad['horas'] == '2') ? 'selected' : ''; ?>>2 horas</option>
                        <option value="3" <?php echo ($disponibilidad['horas'] == '3') ? 'selected' : ''; ?>>3 horas</option>
                    </select>
                </div>
                <div class="input-wrapper">
                    <label for="modalidad">Modalidad de Tutoría:</label>
                    <select id="modalidad" name="modalidad" required>
                        <option value="virtual" <?php echo ($disponibilidad['modalidad'] == 'virtual') ? 'selected' : ''; ?>>Virtual</option>
                        <option value="presencial" <?php echo ($disponibilidad['modalidad'] == 'presencial') ? 'selected' : ''; ?>>Presencial</option>
                        <option value="ambas" <?php echo ($disponibilidad['modalidad'] == 'ambas') ? 'selected' : ''; ?>>Ambas modalidades</option>
                    </select>
                </div>
            </div>

            <!-- Comentarios -->
            <div class="form-group">
                <label for="comentarios">Comentarios:</label>
                <textarea id="comentarios" name="comentarios" rows="3"><?php echo htmlspecialchars($disponibilidad['comentarios']); ?></textarea>
            </div>

            <!-- Botones -->
            <div class="form-group buttons-container">
                <button type="submit">Guardar Cambios</button>
                <a href="eliminarDisponibilidad.php?id=<?php echo htmlspecialchars($disponibilidad['id']); ?>" onclick="return confirm('¿Está seguro de que desea eliminar esta disponibilidad?');">Eliminar Disponibilidad</a>
            </div>
        <?php endif; ?>
    </form>

</body>
</html>
