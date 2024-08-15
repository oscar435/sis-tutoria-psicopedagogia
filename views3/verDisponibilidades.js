document.addEventListener('DOMContentLoaded', function () {
    const btnVerDisponibilidad = document.getElementById('btn-ver-disponibilidad');
    const formContainer = document.getElementById('form-container');

    btnVerDisponibilidad.addEventListener('click', function () {
        fetch('../views3/obtenerDisponibilidades.php')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    formContainer.innerHTML = `<p>Error: ${data.error}</p>`;
                } else {
                    displayDisponibilidades(data);
                }
            })
            .catch(error => {
                formContainer.innerHTML = `<p>Error: ${error.message}</p>`;
            });
    });

    function displayDisponibilidades(disponibilidades) {
        let html = '<h2>Disponibilidades Registradas</h2><table><thead><tr><th>Id</th><th>Cursos</th><th>Fecha</th><th>Turno</th><th>Horas</th><th>Modalidad</th><th>Comentarios</th></tr></thead><tbody>';

        disponibilidades.forEach(disponibilidad => {
            html += `<tr>
                <td>${disponibilidad.id}</td>
                <td>${disponibilidad.curso_1}</td>
                <td>${disponibilidad.fecha}</td>
                <td>${disponibilidad.turno}</td>
                <td>${disponibilidad.horas}</td>
                <td>${disponibilidad.modalidad}</td>
                <td>${disponibilidad.comentarios}</td>
            </tr>`;
        });

        html += '</tbody></table>';
        formContainer.innerHTML = html;
    }
});
