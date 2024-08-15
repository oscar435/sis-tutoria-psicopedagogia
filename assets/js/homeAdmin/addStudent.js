// addStudent.js

document.addEventListener('DOMContentLoaded', function() {
    const btnAddStudent = document.getElementById('add-student');

    if (btnAddStudent) {
        btnAddStudent.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Botón "Agregar Estudiante" presionado');

            // Cargar contenido dinámico en #main-content
            const mainContent = document.getElementById('main-content');
            mainContent.innerHTML = `
                <div id="add-student-form">
                    <h2>Agregar Nuevo Estudiante</h2>
                    <form action="add_student_action.php" method="post">
                        <label for="cod_estudiante">Código Estudiante:</label>
                        <input type="text" id="cod_estudiante" name="cod_estudiante" placeholder="0000011111" required>
                        
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Escriba sus nombres" required>
                        
                        <label for="apellido">Apellido:</label>
                        <input type="text" id="apellido" name="apellido" placeholder="Escriba sus apellidos" required>
                        
                        <label for="telefono">Teléfono:</label>
                        <input type="text" id="telefono" name="telefono" placeholder="999-999-999" required>
                        
                        <label for="correo_personal">Correo Personal:</label>
                        <input type="email" id="correo_personal" name="correo_personal" placeholder="example@gmail.com" required>
                        
                        <label for="escuela">Escuela:</label>
                        <input type="text" id="escuela" name="escuela" placeholder="Informatica"  required>
                        
                        <label for="semestre">Semestre:</label>
                        <input type="text" id="semestre" name="semestre" placeholder="5" required>
                        
                        <button type="submit">Agregar Estudiante</button>
                    </form>
                </div>
            `;
        });
    } else {
        console.error('Botón "add-student" no encontrado');
    }
});
