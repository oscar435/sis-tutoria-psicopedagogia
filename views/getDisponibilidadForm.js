document.addEventListener('DOMContentLoaded', function () {
    const teacherSelect = document.getElementById('teacher');
    const disponibilidadContainer = document.getElementById('disponibilidad-container');

    teacherSelect.addEventListener('change', function () {
        const tutorId = this.value;

        if (tutorId) {
            fetch(`getDisponibilidades.php?tutor_id=${tutorId}`)
                .then(response => response.json())
                .then(data => {
                    if (Array.isArray(data) && data.length > 0) {
                        // Crear el contenido HTML para las disponibilidades y cursos
                        let html = '<h3>DISPONIBILIDAD DE LAS TUTORÍAS DEL DOCENTE SELECCIONADO:</h3>';


                        // Mostrar cursos disponibles
                        html += '<div class="input-group"><label for="cursos">Cursos disponibles:</label>';
                        html += '<select id="cursos" name="cursos" ><option value="" disabled selected>Seleccione un curso</option>';
                        
                        // Añadir cursos de cada disponibilidad
                        data.forEach(d => {
                            if (d.curso_1) html += `<option value="${d.curso_1}">${d.curso_1}</option>`;
                            if (d.curso_2) html += `<option value="${d.curso_2}">${d.curso_2}</option>`;
                            if (d.curso_3) html += `<option value="${d.curso_3}">${d.curso_3}</option>`;
                            if (d.curso_4) html += `<option value="${d.curso_4}">${d.curso_4}</option>`;
                        });
                        
                        html += '</select></div>' 
                        
                        //modalidad de la tutoria
                        html += '<div class="input-group"><label for="modalidad">Modalidades disponibles de la tutoria:</label>';
                        html += '<select id="modalidad" name="modalidad" required><option value="" disabled selected>Seleccione una modalidad</option>';
                        data.forEach(d => {
                            html += `<option value="${d.modalidad}">${d.modalidad}</option>`;
                        });
                        html += '</select></div>';                        


                        // Mostrar fechas
                        html += '<div class="input-group"><label for="fecha">Fechas disponibles:</label>';
                        html += '<select id="fecha" name="fecha" required><option value="" disabled selected>Seleccione una fecha</option>';
                        data.forEach(d => {
                            html += `<option value="${d.fecha}">${d.fecha}</option>`;
                        });
                        html += '</select></div>';

;

                        // Mostrar turno, horas y modalidad como antes
                        html += '<div class="input-group"><label for="turno">Turno para recibir la tutoria:</label>';
                        html += '<select id="turno" name="turno" required><option value="" disabled selected>Seleccione un turno</option>';
                        data.forEach(d => {
                            html += `<option value="${d.turno}">${d.turno}</option>`;
                        });
                        html += '</select></div>';

                        html += '<div class="input-group"><label for="horas">Horas disponibles para la tutoria:</label>';
                        html += '<select id="horas" name="horas" required><option value="" disabled selected>Seleccione un rango de horas</option>';
                        data.forEach(d => {
                            html += `<option value="${d.horas}">${d.horas}</option>`;
                        });
                        html += '</select></div>';


                        disponibilidadContainer.innerHTML = html;
                    } else {
                        disponibilidadContainer.innerHTML = '<p>No hay disponibilidades disponibles para el docente seleccionado.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        } else {
            disponibilidadContainer.innerHTML = ''; // Limpiar el contenedor si no hay tutor seleccionado
        }
    });
});
