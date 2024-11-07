<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Cliente</title>
</head>
<body>
    <h2>Formulario para Crear Cliente</h2>

    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;">Error: <?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>

    <form action="createCliente.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="user">Usuario:</label>
        <input type="text" id="user" name="user" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="numero">Número de Cliente:</label>
        <input type="number" id="numero" name="numero" required><br>

        <label for="maxAlquileresConcurrentes">Alquileres Permitidos:</label>
        <input type="number" id="maxAlquilerConcurrente" name="maxAlquilerConcurrente" value="3" required><br>

        <input type="submit" value="Crear Cliente">
    </form>

    <a href="mainAdmin.php">Volver al panel de administrador</a>
</body>
</html>
