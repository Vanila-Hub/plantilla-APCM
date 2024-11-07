<?php
session_start();

require_once __DIR__ . '/../autoload.php';

use Dwes\videoclub2_0\app\Cliente;

// Vverificar usuario y sesion
if (!isset($_SESSION['username']) || !isset($_SESSION['cliente'])) {
    header('Location: index.php');
    exit();
}

// comprobaciones de json
if (is_string($_SESSION['cliente'])) {
    $cliente = Cliente::fromJSON($_SESSION['cliente']);  // Convertir la cadena JSON en un objeto Cliente
} else {
    // Error: el cliente en la sesión no es una cadena JSON
    echo "Error: Cliente no está en el formato correcto.";
    exit();
}

$alquileres = $cliente->getAlquileres();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Cliente</title>
</head>
<body>
    <h2>Bienvenido, <?php echo htmlspecialchars($cliente->getNombre()); ?></h2>
    <p>Tus alquileres actuales:</p>

    <?php if (empty($alquileres)): ?>
        <p>No tienes ningún alquiler en este momento.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($alquileres as $alquiler): ?>
                <li><?php echo htmlspecialchars($alquiler); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    
    <p><a href="formUpdateCliente.php?numero=<?php echo htmlspecialchars($cliente->getNumero()); ?>">Editar mis datos</a></p>


    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
