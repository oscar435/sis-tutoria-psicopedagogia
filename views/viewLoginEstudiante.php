<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Estudiante</title>
    <link rel="stylesheet" href="../assets/css/logins/loginEstudiante.css">
</head>
<body>
    <!-- Contenedor de login -->
    <div class="login-container">
        <!-- Título del login -->
        <header>
            <h1>ESTUDIANTE</h1>
        </header>

        <!-- Formulario de login -->
        <main>
            <form action="../controllers/loginController.php" method="post">
                <label for="codigo">Código del Estudiante:</label>
                <input type="text" name="codigo" id="codigo" placeholder="Escriba su código" required>
                
                <label for="password">Clave:</label>
                <input type="password" name="password" id="password" placeholder="Escriba su clave" required>
                
                <input type="submit" name="login" value="Entrar">
            </form>
        </main>

        <!-- Footer para regresar al inicio -->
        <footer class="footer">
            <?php require '../includes/headerLogin.php'; ?>
        </footer>
    </div>
</body>
</html>
