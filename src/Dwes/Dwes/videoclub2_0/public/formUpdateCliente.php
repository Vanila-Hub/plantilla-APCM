<?php
session_start();

require_once __DIR__ . '/../autoload.php';

use Dwes\videoclub2_0\app\Cliente;

// Verificar que el cliente a editar está disponible en la sesión
if (!isset($_GET['numero'])) {
    header('Location: mainAdmin.php');
    exit();
}

// Obtener el cliente a editar de la sesión
$numeroCliente = intval($_GET['numero']);
$clientes = isset($_SESSION['clientes']) ? $_SESSION['clientes'] : [];
$clienteAEditar = null;

foreach ($clientes as $clienteJson) {
    $cliente = Cliente::fromJSON($clienteJson);
    if ($cliente->getNumero() === $numeroCliente) {
        $clienteAEditar = $cliente;
        break;
    }
}

// Si no se encontró el cliente, redirigir
if ($clienteAEditar === null) {
    header('Location: mainAdmin.php');
    exit();
}

$isAdmin = $_SESSION['username'] === 'admin';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
</head>
<body>
    <h2>Editar Cliente: <?php echo htmlspecialchars($clienteAEditar->getNombre()); ?></h2>

    <form action="updateCliente.php" method="POST">
        <input type="hidden" name="numero" value="<?php echo htmlspecialchars($clienteAEditar->getNumero()); ?>">
        <input type="hidden" name="isAdmin" value="<?php echo $isAdmin ? 'true' : 'false'; ?>">


        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($clienteAEditar->getNombre()); ?>" required><br>

        <label for="user">Usuario:</label>
        <input type="text" id="user" name="user" value="<?php echo htmlspecialchars($clienteAEditar->getUser()); ?>" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($clienteAEditar->getPassword()); ?>" required><br>

        <label for="maxAlquilerConcurrente">Alquileres Permitidos:</label>
        <input type="number" id="maxAlquilerConcurrente" name="maxAlquilerConcurrente" value="<?php echo htmlspecialchars($clienteAEditar->getMaxAlquilerConcurrente()); ?>" required><br>

        <input type="submit" value="Actualizar Cliente">
    </form>

    <a href="mainAdmin.php">Volver al panel de administrador</a>
</body>
</html>
