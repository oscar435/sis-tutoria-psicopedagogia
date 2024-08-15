<form id="gestion-disponibilidad" method="POST" action="procesarDisponibilidad.php">
    <h2>Registro de Disponibilidad</h2>

    <!-- Información del Docente -->
    <div class="gestion-form-group">
        <h4>INFORMACIÓN DEL DOCENTE:</h4>
        <div class="gestion-horizontal-group">
            <div class="gestion-input-wrapper">
                <label for="nombre-docente">Nombre:</label>
                <input type="text" id="nombre-docente" name="nombre-docente" value="<?php echo htmlspecialchars($tutor_nombre); ?>" readonly>
            </div>
            <div class="gestion-input-wrapper">
                <label for="apellido-docente">Apellido:</label>
                <input type="text" id="apellido-docente" name="apellido-docente" value="<?php echo htmlspecialchars($tutor_apellido); ?>" readonly>
            </div>
            <div class="gestion-input-wrapper">
                <label for="codigo-docente">Código de Docente:</label>
                <input type="text" id="codigo-docente" name="codigo-docente" value="<?php echo htmlspecialchars($tutor_codigo); ?>" readonly>
            </div>
        </div>
    </div>

    <!-- Cursos que Enseña -->
    <div class="gestion-form-group">
        <h4>CURSOS QUE ENSEÑA: </h4>
        <div class="gestion-horizontal-group">
            <div class="gestion-input-wrapper">
                <label for="curso-1">Curso 1:</label>
                <input type="text" id="curso-1" name="cursos[]" placeholder="Ingrese el nombre del curso">
            </div>
            <div class="gestion-input-wrapper">
                <label for="curso-2">Curso 2:</label>
                <input type="text" id="curso-2" name="cursos[]" placeholder="Ingrese el nombre del curso (opcional)">
            </div>
            <div class="gestion-input-wrapper">
                <label for="curso-3">Curso 3:</label>
                <input type="text" id="curso-3" name="cursos[]" placeholder="Ingrese el nombre del curso (opcional)">
            </div>
            <div class="gestion-input-wrapper">
                <label for="curso-4">Curso 4:</label>
                <input type="text" id="curso-4" name="cursos[]" placeholder="Ingrese el nombre del curso (opcional)">
            </div>
        </div>
    </div>

    <!-- Fecha, Turno, Horas y Modalidad -->
    <div class="gestion-form-group">
        <h4>FECHA, TURNO, HORAS Y MODALIDAD EN LAS QUE DESEA DAR LA TUTORÍA:</h4>
        <div class="gestion-horizontal-group">
            <div class="gestion-input-wrapper">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>
            </div>
            <div class="gestion-input-wrapper">
                <label for="turno">Turno:</label>
                <select id="turno" name="turno" required>
                    <option value="" disabled selected>Selecciona un turno</option>
                    <option value="mañana">Mañana</option>
                    <option value="tarde">Tarde</option>
                    <option value="noche">Noche</option>
                </select>
            </div>
            <div class="gestion-input-wrapper">
                <label for="horas">Horas de enseñanza:</label>
                <select id="horas" name="horas" required>
                    <option value="" disabled selected>Selecciona la duración</option>
                    <option value="1">1 hora</option>
                    <option value="2">2 horas</option>
                    <option value="3">3 horas</option>
                </select>
            </div>
            <div class="gestion-input-wrapper">
                <label for="modalidad">Modalidad de Tutoría:</label>
                <select id="modalidad" name="modalidad" required>
                    <option value="" disabled selected>Selecciona la modalidad</option>
                    <option value="virtual">Virtual</option>
                    <option value="presencial">Presencial</option>
                    <option value="ambas">Ambas modalidades</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Comentarios -->
    <div class="gestion-form-group">
        <h4>Comentarios</h4>
        <div class="gestion-input-wrapper">
            <label for="comentarios">Comentarios:</label>
            <textarea id="comentarios" name="comentarios" rows="3" placeholder="Ingrese algún comentario adicional"></textarea>
        </div>
    </div>

    <!-- Botón de Envío -->
    <div class="gestion-form-group gestion-buttons-container">
        <button type="submit">Registrar Disponibilidad</button>
    </div>
</form>
