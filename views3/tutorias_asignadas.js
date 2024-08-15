document.addEventListener("DOMContentLoaded", function() {
    const verTutoriasLink = document.getElementById("ver-tutorias");
    const mainContent = document.getElementById("main-section"); // Asegúrate de que este ID sea correcto

    function clearContent() {
        mainContent.innerHTML = '';  // Limpia el contenido previo
    }

    verTutoriasLink.addEventListener("click", function(event) {
        event.preventDefault();
        clearContent();  // Limpia antes de cargar nuevo contenido

        // Realizar la solicitud AJAX al servidor para obtener las tutorías
        fetch('../views2/get_tutorias.php') // Ajusta la ruta si es necesario
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta de la red');
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    mainContent.innerHTML = `<p>Error: ${data.error}</p>`;
                } else {
                    // Generar la tabla HTML con todas las columnas especificadas
                    
                    let tablaHTML = '<table>';
                    tablaHTML += `
                        <thead>
                         
                            <tr>
                                <th>ID</th>
                                <th>Tipo de Tutoría</th>
                                <th>Nombre del Docente</th>
                                <th>Apellido del Docente</th>
                                <th>Código del Docente</th>
                                <th>Nombre del Estudiante</th>
                                <th>Apellido del Estudiante</th>
                                <th>Código del Estudiante</th>
                                <th>Correo Personal</th>
                                <th>Correo Institucional</th>
                                <th>Teléfono</th>
                                <th>Escuela</th>
                                <th>Semestre</th>
                                <th>Curso</th>
                                <th>Fecha</th>
                                <th>Hora de Inicio</th>
                                <th>Turno</th>
                                <th>Modalidad</th>
                                <th>Horas de Tutoría</th>
                                <th>Salón</th>
                            </tr>
                        </thead>
                        <tbody>`;

                    data.tutorias.forEach(tutoria => {
                        tablaHTML += `
                            <tr>
                                <td>${tutoria.id}</td>
                                <td>${tutoria.tipo_tutoria}</td>
                                <td>${tutoria.nombre_docente}</td>
                                <td>${tutoria.apellido_docente}</td>
                                <td>${tutoria.codi_docente}</td>
                                <td>${tutoria.nombre_estudiante}</td>
                                <td>${tutoria.apellido_estudiante}</td>
                                <td>${tutoria.codigo_estudiante}</td>
                                <td>${tutoria.correo_personal}</td>
                                <td>${tutoria.correo_institucional}</td>
                                <td>${tutoria.telefono}</td>
                                <td>${tutoria.escuela}</td>
                                <td>${tutoria.semestre}</td>
                                <td>${tutoria.curso}</td>
                                <td>${tutoria.fecha}</td>
                                <td>${tutoria.hora_inicio}</td>
                                <td>${tutoria.turno}</td>
                                <td>${tutoria.modalidad}</td>
                                <td>${tutoria.horas_tutoria}</td>
                                <td>${tutoria.salon}</td>
                            </tr>`;
                    });

                    tablaHTML += '</tbody></table>';
                    mainContent.innerHTML = tablaHTML;
                }
            })
            .catch(error => {
                mainContent.innerHTML = `<p>Error: ${error.message}</p>`;
            });
    });

    // Manejar "asignacion de tutorias" para evitar congelamiento
    const tutoriaGrupalLink = document.getElementById("tutoria-grupal"); // Asegúrate de que este ID sea correcto
    tutoriaGrupalLink.addEventListener("click", function(event) {
        event.preventDefault();
        clearContent();  // Limpia antes de cargar nuevo contenido

        // Aquí deberías cargar la asignación de tutorías, similar al método para ver tutorías.
        // Ejemplo simple:
        mainContent.innerHTML = "<p>Cargando la asignación de tutorías...</p>";
        
        // Puedes agregar la lógica específica de "asignacion de tutorias" aquí.
    });
});
