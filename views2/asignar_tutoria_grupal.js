document.addEventListener('DOMContentLoaded', function () {
    const btnTutoriaGrupal = document.getElementById('tutoria-grupal');

    if (btnTutoriaGrupal) {
        btnTutoriaGrupal.addEventListener('click', function (e) {
            e.preventDefault();

            // Limpiar contenido anterior
            const mainContent = document.querySelector('.dashboard');
            mainContent.innerHTML = '';

            // Mostrar el formulario de asignación de tutorías
            mainContent.innerHTML = `
                <div id="form-tutoria">
                    <h3>Asignar Tutoria</h3>
                    <form id="asignar-tutoria-form">
                        <!-- Campos del formulario -->
                        <div class="form-group">
                            <label for="tipo-tutoria">Tipo de Tutoria:</label>
                            <select id="tipo-tutoria" name="tipo-tutoria" required>
                                <option value="">Seleccione</option>
                                <option value="grupal">Grupal</option>
                                <option value="individual">Individual</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="codi_docente">Código Docente:</label>
                            <input type="text" id="codi_docente" name="codi_docente" required>
                            <button type="button" id="buscar-docente">Buscar Docente</button>
                        </div>
                        <div class="form-group">
                            <label for="docente-nombre">Nombre del Docente:</label>
                            <input type="text" id="docente-nombre" name="docente-nombre" readonly>
                        </div>
                        <div class="form-group">
                            <label for="docente-apellido">Apellido del Docente:</label>
                            <input type="text" id="docente-apellido" name="docente-apellido" readonly>
                        </div>
                        <div class="form-group">
                            <label for="codigo-estudiante">Código Estudiante:</label>
                            <input type="text" id="codigo-estudiante" name="codigo-estudiante" required>
                            <button type="button" id="buscar-estudiante">Buscar Estudiante</button>
                        </div>
                        <div class="form-group">
                            <label for="correo-institucional">Correo Institucional:</label>
                            <input type="email" id="correo-institucional" name="correo-institucional">
                        </div>                       
                        <div class="form-group">
                            <label for="nombre-estudiante">Nombre del Estudiante:</label>
                            <input type="text" id="nombre-estudiante" name="nombre-estudiante" readonly>
                        </div>
                        <div class="form-group">
                            <label for="apellido-estudiante">Apellido del Estudiante:</label>
                            <input type="text" id="apellido-estudiante" name="apellido-estudiante" readonly>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Número de Teléfono:</label>
                            <input type="text" id="telefono" name="telefono" required>
                        </div>
                        <div class="form-group">
                            <label for="correo-personal">Correo Personal:</label>
                            <input type="email" id="correo-personal" name="correo-personal" required>
                        </div>
                        <div class="form-group">
                            <label for="escuela">Escuela:</label>
                            <input type="text" id="escuela" name="escuela" required>
                        </div>
                        <div class="form-group">
                            <label for="semestre">Semestre:</label>
                            <input type="text" id="semestre" name="semestre" required>
                        </div>
                        <div class="form-group">
                            <label for="curso">Curso que Necesita Tutoría:</label>
                            <input type="text" id="curso" name="curso" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha de Tutoria:</label>
                            <input type="date" id="fecha" name="fecha" required>
                        </div>
                        <div class="form-group">
                            <label for="hora-inicio">Hora de Inicio:</label>
                            <input type="time" id="hora-inicio" name="hora-inicio" required>
                        </div>
                        <div class="form-group">
                            <label for="turno">Turno:</label>
                            <select id="turno" name="turno" required>
                                <option value="">Seleccione</option>
                                <option value="mañana">Mañana</option>
                                <option value="tarde">Tarde</option>
                                <option value="noche">Noche</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="modalidad">Modalidad:</label>
                            <select id="modalidad" name="modalidad" required>
                                <option value="">Seleccione</option>
                                <option value="virtual">Virtual</option>
                                <option value="presencial">Presencial</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="horas-tutoria">Horas de Tutoria:</label>
                            <input type="text" id="horas-tutoria" name="horas-tutoria" placeholder="Ej: 2 horas" required>
                        </div>
                        <div class="form-group">
                            <label for="salon">Salón:</label>
                            <input type="text" id="salon" name="salon" placeholder="Opcional, solo para modalidad presencial">
                        </div>

                        <button type="submit" id="asignar-tutoria">Asignar Tutoria</button>
                        <button type="button" id="nueva-asignacion">Agregar Nueva Asignación</button>
                    </form>
                    <div id="mensaje-tutoria"></div>
                </div>
            `;

            // Event listeners for search buttons
            document.getElementById('buscar-docente').addEventListener('click', function () {
                const codigoDocente = document.getElementById('codi_docente').value;
                if (codigoDocente) {
                    fetch(`../views2/search_docente.php?codigo_docente=${codigoDocente}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById('docente-nombre').value = data.nombre;
                                document.getElementById('docente-apellido').value = data.apellido;
                            } else {
                                alert('Docente no encontrado.');
                            }
                        })
                        .catch(error => console.error('Error buscando docente:', error));
                }
            });

            document.getElementById('buscar-estudiante').addEventListener('click', function () {
                const codigoEstudiante = document.getElementById('codigo-estudiante').value;
                if (codigoEstudiante) {
                    fetch(`../views2/search_estudiante.php?codigo_estudiante=${codigoEstudiante}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById('nombre-estudiante').value = data.nombre;
                                document.getElementById('apellido-estudiante').value = data.apellido;
                                document.getElementById('telefono').value = data.telefono;
                                document.getElementById('correo-personal').value = data.correo_personal;
                                document.getElementById('escuela').value = data.escuela;
                                document.getElementById('semestre').value = data.semestre;
                            } else {
                                alert('Estudiante no encontrado.');
                            }
                        })
                        .catch(error => console.error('Error buscando estudiante:', error));
                }
            });

            document.getElementById('tipo-tutoria').addEventListener('change', function () {
                const tipoTutoria = this.value;
                const salonInput = document.getElementById('salon');
                const modalidadSelect = document.getElementById('modalidad');

                if (tipoTutoria === 'individual') {
                    salonInput.disabled = true;
                    modalidadSelect.value = 'virtual'; // Selecciona "Virtual" por defecto
                    modalidadSelect.disabled = true; // Bloquea la selección de modalidad
                } else {
                    salonInput.disabled = false;
                    modalidadSelect.disabled = false; // Habilita la selección de modalidad para "grupal"
                }
            });

            document.getElementById('nueva-asignacion').addEventListener('click', function () {
                document.getElementById('asignar-tutoria-form').reset(); // Limpia todos los campos del formulario
                document.getElementById('tipo-tutoria').value = ''; // Restablece el select a su estado inicial
                document.getElementById('modalidad').disabled = false; // Asegura que la modalidad no esté bloqueada
                document.getElementById('salon').disabled = false; // Asegura que el salón no esté bloqueado
            });

            document.getElementById('asignar-tutoria-form').addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch('../views2/process_asignar_tutoria.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    const mensaje = document.getElementById('mensaje-tutoria');
                    mensaje.textContent = data.includes("exitosamente") ? data : "Error al asignar tutoria.";
                    mensaje.style.color = data.includes("exitosamente") ? 'green' : 'red';
                })
                .catch(error => {
                    console.error('Error al asignar tutoria:', error);
                });
            });
        });
    } else {
        console.error('Botón "tutoria-grupal" no encontrado');
    }
});
