// Archivo: addTutor.js
document.addEventListener('DOMContentLoaded', function () {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '../styles/addTutor.css'; // Ajusta la ruta según sea necesario
    document.head.appendChild(link);

    const btnAgregarTutor = document.getElementById('agregar-tutor');

    if (btnAgregarTutor) {
        btnAgregarTutor.addEventListener('click', function (e) {
            e.preventDefault();
            const mainContent = document.getElementById('main-content');
            mainContent.innerHTML = `
                <div id="contenido-agregar-tutor">
                    <h2>AGREGAR NUEVO TUTOR</h2>
                    <form id="add-tutor-form">
                        <div class="form-group">
                            <label for="codigo_docente">Código Docente:</label>
                            <input type="text" id="codigo_docente" name="codigo_docente" required>
                        </div>

                         <div class="form-group">
                            <label for="clave_tutor">Clave Tutor:</label>
                            <input type="password" id="clave_tutor" name="clave_tutor" required>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="correo_institucional">Correo Institucional:</label>
                            <input type="email" id="correo_institucional" name="correo_institucional" required>
                        </div>                        
                        
                        <div class="form-group">
                            <label for="apellido">Apellido:</label>
                            <input type="text" id="apellido" name="apellido" required>
                        </div>                        
                        
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" id="telefono" name="telefono" required>
                        </div>
                        <div class="form-group">
                            <label for="dni">DNI:</label>
                            <input type="text" id="dni" name="dni" required>
                        </div>                        
  
                        <div class="form-group">
                            <label for="carrera">Carrera:</label>
                            <input type="text" id="carrera" name="carrera" required>
                        </div>

                        <button type="submit">Agregar Tutor</button>
                    </form>
                    <div id="mensaje-agregar-tutor"></div>
                </div>
            `;

            document.getElementById('add-tutor-form').addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch('../views2/add_tutor_action.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    console.log('Respuesta del servidor:', data);
                    const mensaje = document.getElementById('mensaje-agregar-tutor');
                    mensaje.textContent = data.includes("exitosamente") ? data : "Error al agregar tutor.";
                    mensaje.style.color = data.includes("exitosamente") ? 'green' : 'red';
                })
                .catch(error => {
                    console.error('Error al agregar tutor:', error);
                });
            });
        });
    } else {
        console.error('Botón "agregar-tutor" no encontrado');
    }
});
