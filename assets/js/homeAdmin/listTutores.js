document.addEventListener('DOMContentLoaded', function() {
    const btnListaTutores = document.getElementById('lista-tutores');
    let currentPage = 1;
    const limit = 12;

    function loadTutors(page = 1, searchBy = '', query = '') {
        fetch(`../views2/list_tutores_action.php?page=${page}&limit=${limit}&searchBy=${searchBy}&query=${query}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Datos recibidos:', data); // Depuración
                renderTutors(data.tutors);
                renderPagination(data.total, data.page, data.limit);
            })
            .catch(error => console.error('Error al cargar tutores:', error));
    }

    function renderTutors(tutors) {
        const tableBody = document.querySelector('#contenido-tutores table tbody');
        if (!tableBody) {
            console.error('No se encontró tbody en #contenido-tutores table');
            return;
        }
        tableBody.innerHTML = '';
        tutors.forEach(tutor => {
            const row = document.createElement('tr');
            row.dataset.id = tutor.codigo_docente;

            row.innerHTML = `
                <td><input type="text" id="cod_docente" value="${tutor.codigo_docente}" readonly></td>
                <td><input type="text" id="nomtuto" value="${tutor.nombre}" readonly></td>
                <td><input type="text" id="apellidoo" value="${tutor.apellido}" readonly></td>
                <td><input type="text" id="dni" value="${tutor.dni}" readonly></td>
                <td><input type="text" id="telefono" value="${tutor.telefono}" readonly></td>
                <td><input type="text" id="correo_institucional" value="${tutor.correo_institucional}" readonly></td>
                <td><input type="text" id="carrera" value="${tutor.carrera}" readonly></td>
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
                saveTutor(row);
            });
        });

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const row = this.closest('tr');
                if (confirm('¿Estás seguro de que deseas eliminar este tutor?')) {
                    deleteTutor(row);
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

    function saveTutor(row) {
        const inputs = row.querySelectorAll('input');
        const tutorData = {
            codigo_docente: row.dataset.id,
            nombre: inputs[1].value,
            apellido: inputs[2].value,
            dni: inputs[3].value,
            telefono: inputs[4].value,
            correo_institucional: inputs[5].value,
            carrera: inputs[6].value
        };

        fetch('../views2/update_tutor.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(tutorData)
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
        .catch(error => console.error('Error al guardar tutor:', error));
    }

    function deleteTutor(row) {
        const tutorId = row.dataset.id;

        fetch('../views2/delete_tutor.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: tutorId })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            console.log('Tutor eliminado:', data);
            row.remove();
            loadTutors(currentPage);
        })
        .catch(error => console.error('Error al eliminar tutor:', error));
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
            firstButton.addEventListener('click', () => loadTutors(1, document.getElementById('search-by').value, document.getElementById('search-query').value));
            paginationContainer.appendChild(firstButton);
        }
        const prevButton = document.createElement('button');
        prevButton.textContent = '<< Anterior';
        prevButton.disabled = page === 1;
        prevButton.addEventListener('click', () => loadTutors(page - 1, document.getElementById('search-by').value, document.getElementById('search-query').value));
        paginationContainer.appendChild(prevButton);

        const nextButton = document.createElement('button');
        nextButton.textContent = 'Siguiente >>';
        nextButton.disabled = page === totalPages;
        nextButton.addEventListener('click', () => loadTutors(page + 1, document.getElementById('search-by').value, document.getElementById('search-query').value));
        paginationContainer.appendChild(nextButton);

        if (page < totalPages) {
            const lastButton = document.createElement('button2');
            lastButton.textContent = 'Última pag';
            lastButton.addEventListener('click', () => loadTutors(totalPages, document.getElementById('search-by').value, document.getElementById('search-query').value));
            paginationContainer.appendChild(lastButton);
        }
    }

    if (btnListaTutores) {
        btnListaTutores.addEventListener('click', function(e) {
            e.preventDefault();
            const mainContent = document.getElementById('main-content');
            if (!mainContent) {
                console.error('No se encontró #main-content');
                return;
            }
            mainContent.innerHTML = `
                <div id="contenido-tutores">
                    <h2>LISTA DE TUTORES</h2>
                    <div id="search-container">
                        <form id="search-form">
                            <select id="search-by">
                                <option value="codigo_docente">Código</option>
                                <option value="nombre">Nombre</option>
                                <option value="apellido">Apellido</option>
                                <option value="dni">DNI</option>
                                <option value="telefono">Teléfono</option>
                                <option value="correo_institucional">Correo Institucional</option>
                                <option value="carrera">Carrera</option>
                            </select>
                            <input type="text" id="search-query" placeholder="Buscar...">
                            <button type="submit">Buscar</button>
                        </form>
                    </div>
                    <table >
                        <thead>
                            <tr >
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>DNI</th>
                                <th>Teléfono</th>
                                <th>Correo Institucional</th>
                                <th>Carrera</th>
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
                loadTutors(currentPage, searchBy, query);
            });
            loadTutors(); // Carga inicial
        });
    } else {
        console.error('Botón "lista-tutores" no encontrado');
    }
});
