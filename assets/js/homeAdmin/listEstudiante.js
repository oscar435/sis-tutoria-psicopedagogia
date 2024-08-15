document.addEventListener('DOMContentLoaded', function() {
    const btnListaEstudiantes = document.getElementById('lista-estudiantes');
    let currentPage = 1;
    const limit = 12;

    function loadStudents(page = 1, searchBy = '', query = '') {
        fetch(`../views2/list_estudiantes_action.php?page=${page}&limit=${limit}&searchBy=${searchBy}&query=${query}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Datos recibidos:', data); // Depuración
                renderStudents(data.students);
                renderPagination(data.total, data.page, data.limit);
            })
            .catch(error => console.error('Error al cargar estudiantes:', error));
    }

    function renderStudents(students) {
        const tableBody = document.querySelector('#contenido-estudiantes table tbody');
        if (!tableBody) {
            console.error('No se encontró tbody en #contenido-estudiantes table');
            return;
        }
        tableBody.innerHTML = '';
        students.forEach(student => {
            const row = document.createElement('tr');
            row.dataset.id = student.id;

            row.innerHTML = `
                <td><input type="text" id="cod_estud" value="${student.cod_estudiante}" readonly></td>
                <td><input type="text" value="${student.nombre}" readonly></td>
                <td><input type="text" value="${student.apellido}" readonly></td>
                <td><input type="text" id="telef" value="${student.telefono}" readonly></td>
                <td><input type="text" id="correo_pers" value="${student.correo_personal}" readonly></td>
                <td><input type="text" id="escuelaa" value="${student.escuela}" readonly></td>
                <td><input type="text" id="semestree" value="${student.semestre}" readonly></td>
                <td>
                    <a href="#" class="btn edit-btn">Editar</a>
                    <a href="#" class="btn save-btn" style="display:none;">Guardar</a>
                    <a href="#" class="btn delete-btn">Eliminar</a>
                </td>
            `;
            tableBody.appendChild(row);
        });

        addEditSaveDeleteEventListeners();
    }

    function addEditSaveDeleteEventListeners() {
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const row = this.closest('tr');
                toggleEditMode(row, true);
            });
        });

        document.querySelectorAll('.save-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const row = this.closest('tr');
                saveStudent(row);
            });
        });

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const row = this.closest('tr');
                if (confirm('¿Estás seguro de que deseas eliminar este estudiante?')) {
                    deleteStudent(row);
                }
            });
        });
    }

    function toggleEditMode(row, isEditing) {
        const inputs = row.querySelectorAll('input');
        inputs.forEach(input => {
            input.readOnly = !isEditing;
            input.style.backgroundColor = isEditing ? '#fff' : '#f9f9f9';
        });

        const editButton = row.querySelector('.edit-btn');
        const saveButton = row.querySelector('.save-btn');

        editButton.style.display = isEditing ? 'none' : 'inline';
        saveButton.style.display = isEditing ? 'inline' : 'none';
    }

    function saveStudent(row) {
        const inputs = row.querySelectorAll('input');
        const studentData = {
            id: row.dataset.id,
            cod_estudiante: inputs[0].value,
            nombre: inputs[1].value,
            apellido: inputs[2].value,
            telefono: inputs[3].value,
            correo_personal: inputs[4].value,
            escuela: inputs[5].value,
            semestre: inputs[6].value
        };

        fetch('../views2/update_estudianteEditar.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(studentData)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            console.log('Datos guardados:', data);
            toggleEditMode(row, false);
        })
        .catch(error => console.error('Error al guardar estudiante:', error));
    }

    function deleteStudent(row) {
        const studentId = row.dataset.id;

        fetch('../views2/delete_estudiante.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: studentId })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            console.log('Estudiante eliminado:', data);
            row.remove();
            loadStudents(currentPage);
        })
        .catch(error => console.error('Error al eliminar estudiante:', error));
    }

    function renderPagination(total, page, limit) {
        const totalPages = Math.ceil(total / limit);
        const paginationContainer = document.getElementById('pagination');
        if (!paginationContainer) {
            console.error('No se encontró el contenedor de paginación');
            return;
        }
        paginationContainer.innerHTML = '';

        if (page > 1) {
            const firstButton = document.createElement('button2');
            firstButton.textContent = 'Primera pag';
            firstButton.addEventListener('click', () => loadStudents(1, document.getElementById('search-by').value, document.getElementById('search-query').value));
            paginationContainer.appendChild(firstButton);
        }
        const prevButton = document.createElement('button');
        prevButton.textContent = '<< Anterior';
        prevButton.disabled = page === 1;
        prevButton.addEventListener('click', () => loadStudents(page - 1, document.getElementById('search-by').value, document.getElementById('search-query').value));
        paginationContainer.appendChild(prevButton);

        const nextButton = document.createElement('button');
        nextButton.textContent = 'Siguiente >>';
        nextButton.disabled = page === totalPages;
        nextButton.addEventListener('click', () => loadStudents(page + 1, document.getElementById('search-by').value, document.getElementById('search-query').value));
        paginationContainer.appendChild(nextButton);



        if (page < totalPages) {
            const lastButton = document.createElement('button2');
            lastButton.textContent = 'Última pag';
            lastButton.addEventListener('click', () => loadStudents(totalPages, document.getElementById('search-by').value, document.getElementById('search-query').value));
            paginationContainer.appendChild(lastButton);
        }
    }

    if (btnListaEstudiantes) {
        btnListaEstudiantes.addEventListener('click', function(e) {
            e.preventDefault();
            const mainContent = document.getElementById('main-content');
            if (!mainContent) {
                console.error('No se encontró #main-content');
                return;
            }
            mainContent.innerHTML = `
                <div id="contenido-estudiantes">
                    <h2>LISTA DE ESTUDIANTES</h2>
                    <div id="search-container">
                        <form id="search-form">
                            <select id="search-by">
                                <option value="cod_estudiante">Código</option>
                                <option value="nombre">Nombre</option>
                                <option value="apellido">Apellido</option>
                                <option value="telefono">Teléfono</option>
                                <option value="correo_personal">Correo Personal</option>
                                <option value="escuela">Escuela</option>
                                <option value="semestre">Semestre</option>
                            </select>
                            <input type="text" id="search-query" placeholder="Buscar...">
                            <button type="submit">Buscar</button>
                        </form>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Teléfono</th>
                                <th>Correo Personal</th>
                                <th>Escuela</th>
                                <th>Semestre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <div id="pagination"></div>
                </div>
            `;
            document.getElementById('search-form').addEventListener('submit', function(e) {
                e.preventDefault();
                const searchBy = document.getElementById('search-by').value;
                const query = document.getElementById('search-query').value;
                loadStudents(currentPage, searchBy, query);
            });
            loadStudents(); // Carga inicial
        });
    } else {
        console.error('Botón "lista-estudiantes" no encontrado');
    }

    
});
