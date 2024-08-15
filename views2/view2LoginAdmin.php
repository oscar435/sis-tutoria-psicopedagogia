<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="../assets/css/logins/loginAdministrador.css">
</head>
<body>
    <!-- Contenedor de login -->
    <div class="login-container">
        <!-- Título del login -->
        <header>
            <h1>ADMINISTRADOR</h1>
        </header>

        <!-- Formulario de login -->
        <main>
            <form action="../controllers/loginControllerAdmin.php" method="post">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" name="username" id="username" placeholder="Escriba su usuario" required>
                
                <label for="admin_password">Contraseña:</label>
                <input type="password" name="admin_password" id="admin_password" placeholder="Escriba su contraseña" required>
                
                <input type="submit" name="loginAdmin" value="Entrar">
            </form>
        </main>

        <!-- Footer para regresar al inicio -->
        <footer class="footer">
            <?php require '../includes/headerLogin.php'; ?>
        </footer>
    </div>
</body>
</html>
