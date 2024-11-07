<?php
session_start();

// si esta logeado redirigir a main
if (isset($_SESSION['username'])) {
    header('Location: main.php');
    exit();
}

$error = isset($_GET['error']) ? $_GET['error'] : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Videoclub</title>
</head>
<body>
    <h2>Login Videoclub</h2>
    <form action="login.php" method="POST">
        <label for="username">Usuario:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Iniciar Sesión">
    </form>

    <?php if ($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
</body>
</html>
