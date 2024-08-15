<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link rel="stylesheet" href="../assets/css/welcome/welcome1.css">
</head>
<body>
    <div class="container">
        <h1>BIENVENIDO AL SISTEMA DE TUTORIA DE FIEI!!</h1>
        <h2>Elija la siguiente opción de usuario</h2>
    </div>
    <div class="buttons">
        <!-- Características y funcionalidades del botón Estudiante -->
        <div class="button-group" id="estudiante-group">
            <button id="estudiante-btn" onclick="showIngresar('estudiante')">
                <img src="../images/estudiantes.png" alt="Icono representando estudiante" class="button-icon">
                <span>Estudiante</span>
            </button>
            <div class="input-container" id="estudiante-input-container">
                <button onclick="handleIngresar('estudiante')">
                    <span>Ingresar</span>
                </button>
            </div>
        </div>

        <!-- Características y funcionalidades del botón Tutor -->
        <div class="button-group" id="tutor-group">
            <button id="tutor-btn" onclick="showIngresar('tutor')">
                <img src="../images/tutor.png" alt="Icono representando tutor" class="button-icon">
                <span>Tutor</span>
            </button>
            <div class="input-container" id="tutor-input-container">
                <input type="password" id="tutor-security-key" placeholder="Ingrese clave de seguridad">
                <button onclick="handleIngresar('tutor')">
                    <span>Ingresar</span>
                </button>
            </div>
        </div>

        <!-- Características y funcionalidades del botón Administrador -->
        <div class="button-group" id="administrador-group">
            <button id="administrador-btn" onclick="showIngresar('administrador')">
                <img src="../images/administrador.png" alt="Icono representando administrador" class="button-icon">
                <span>Administrador</span>
            </button>
            <div class="input-container" id="administrador-input-container">
                <input type="password" id="administrador-security-key" placeholder="Ingrese clave de seguridad">
                <button onclick="handleIngresar('administrador')">
                    <span>Ingresar</span>
                </button>
            </div>
        </div>
    <script>
        function showIngresar(role) {
            // Oculta todos los contenedores de entrada
            var inputContainers = document.querySelectorAll('.input-container');
            inputContainers.forEach(container => container.style.display = 'none');

            // Muestra el contenedor de entrada correspondiente solo para "tutor" y "administrador"
            var inputContainer = document.getElementById(`${role}-input-container`);
            if (role === 'estudiante') {
                inputContainer.style.display = 'flex'; // Muestra el botón "Ingresar" para Estudiante
            } else {
                inputContainer.style.display = 'flex'; // Muestra el contenedor para Tutor y Administrador
            }
        }

        function handleIngresar(role) {
            // Para el botón Estudiante, redirige directamente
            if (role === 'estudiante') {
                window.location.href = '../views/viewLoginEstudiante.php'; 
                // Asegúrate de que la ruta sea correcta
                return; // Salir de la función para evitar que el resto del código se ejecute
            }



             // Para los botones Tutor y Administrador, verifica la clave de seguridad
            var securityKey = document.getElementById(`${role}-security-key`);
            var key = securityKey ? securityKey.value : null;
            
            if (key) {
                if (role === 'tutor') {
                    window.location.href = '../views3/view3LoginTutor.php'; // Asegúrate de que la ruta sea correcta
                } else if (role === 'administrador') {
                    // Verificar la clave para administrador
                    fetch('../controllers/claveVerifyController.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `key=${encodeURIComponent(key)}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = '../views2/view2LoginAdmin.php'; // Redirige si la clave es correcta
                        } else {
                            alert(data.error || 'Clave incorrecta. Intente nuevamente.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Ocurrió un error. Intente nuevamente.');
                    });
                }
            } else {
                alert('Ingrese la clave de seguridad.');
            }
        }
    </script>
</body>
</html>
