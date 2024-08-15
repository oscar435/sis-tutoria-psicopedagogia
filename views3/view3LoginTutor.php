<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Tutor</title>
    <link rel="stylesheet" href="../assets/css/logins/loginTutor.css">
</head>
<body>
    <!-- Contenedor de login -->
    <div class="login-container">
        <!-- Título del login -->
        <header>
            <h1>TUTOR</h1>
        </header>

        <!-- Formulario de login -->
        <main>
            <form action="../controllers/loginControllerTutor.php" method="post">
                <label for="teacher_code">Código de Docente:</label>
                <input type="text" name="teacher_code" id="teacher_code" placeholder="Escriba su código de docente" required>
                
                <label for="tutor_password">Contraseña:</label>
                <input type="password" name="tutor_password" id="tutor_password" placeholder="Escriba su contraseña" required>
                
                <input type="submit" name="loginTutor" value="Entrar">
            </form>
        </main>

        <!-- Footer para regresar al inicio -->
        <footer class="footer">
            <?php require '../includes/headerLogin.php'; ?>
        </footer>
    </div>
</body>
</html>
