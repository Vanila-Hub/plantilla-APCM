<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Cliente</title>
</head>
<body>
    <div class="card">
        <h2 class="titulo-principal">Formulario para Crear Cliente</h2>

        <?php if (isset($_GET['error'])): ?>
            <p class="error-mensaje">Error: <?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>

        <form action="createCliente.php" method="POST">
            <div class="campo-formulario">
                <label for="nombre" class="etiqueta">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required class="input-formulario"><br>
            </div>

            <div class="campo-formulario">
                <label for="user" class="etiqueta">Usuario:</label>
                <input type="text" id="user" name="user" required class="input-formulario"><br>
            </div>

            <div class="campo-formulario">
                <label for="password" class="etiqueta">Contraseña:</label>
                <input type="password" id="password" name="password" required class="input-formulario"><br>
            </div>

            <!-- <div class="campo-formulario">
                <label for="numero" class="etiqueta">Número de Cliente:</label>
                <input type="number" id="numero" name="numero" required class="input-formulario"><br>
            </div> -->

            <div class="campo-formulario">
                <label for="maxAlquileresConcurrentes" class="etiqueta">Alquileres Permitidos:</label>
                <input type="number" id="maxAlquilerConcurrente" name="maxAlquilerConcurrente" value="3" required class="input-formulario"><br>
            </div>

            <input type="submit" value="Crear Cliente" class="boton-enviar">
        </form>

        <a href="mainAdmin.php" class="enlace-volver">Volver al panel de administrador</a>
    </div>
</body>
</html>
