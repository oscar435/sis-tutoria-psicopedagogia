<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Solicitud de Tutoría Grupal - Facultad de Ingeniería Electrónica e Informática UNFV</title>
<link rel="stylesheet" href="../assets/css/formTutoGrup/formTutoGrup1.css">
</head>
<body>
<div class="container">
    <h2>Solicitud de Tutoría Grupal</h2>
    <form id="tutoriaGrupalForm" action="procesar_tutoria_grupal.php" method="post">
        <div class="input-group">
            <label for="nombre">Nombres y Apellidos completos:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div class="input-group">
            <label for="codigo">Código de estudiante:</label>
            <input type="text" id="codigo" name="codigo" required>
        </div>
        <div class="input-group">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="input-group">
            <label for="telefono">Teléfono: </label>
            <input type="tel" id="telefono" name="telefono" required>
        </div>
        <div class="input-group">
            <label for="motivo">Motivo de la solicitud: ¿Por qué está interesado en participar en tutorías grupales?</label>
            <textarea id="motivo" name="motivo" rows="4" required></textarea>
        </div>
        <div class="input-group">
            <label for="expectativas">Expectativas de la tutoría grupal: ¿Qué espera lograr participando en tutorías grupales?</label>
            <textarea id="expectativas" name="expectativas" rows="4" required></textarea>
        </div>
        <div class="input-group">
            <label for="disponibilidad">Disponibilidad Horaria: Indique los días y horas en los que estaría disponible para recibir tutoría</label>
            <textarea id="disponibilidad" name="disponibilidad" rows="4" required></textarea>
        </div>
        <div class="input-group">
            <label for="comentarios">Comentarios Adicionales: ¿Hay algo más que desee agregar o compartir con respecto a su rendimiento académico o la tutoría grupal?</label>
            <textarea id="comentarios" name="comentarios" rows="4"></textarea>
        </div>
        <div class="input-group">
            <button type="submit">Enviar Solicitud</button>
        </div>
    </form>
</div>

<script src="scripts.js"></script>
</body>
</html>
