<?php
session_start();


// si no hay sesion se redirige al index
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
</head>
<body>
    <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>Has iniciado sesión correctamente en el Videoclub.</p>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
