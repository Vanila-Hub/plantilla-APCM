<?php
session_start();

require_once __DIR__ . '/../autoload.php';

use Dwes\videoclub2_0\app\Cliente;

/* $testCliente = new Cliente('Test',1, 'testuser', 'testpass', 1, 3);
echo 'Cliente cargado correctamente: ' . $testCliente->getNombre() . '<br>'; */


// si no hay sesion o no es admin redirigir a index
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: index.php');
    exit();
}

// obtienen los datos de la sesion
$clientes = isset($_SESSION['clientes']) ? $_SESSION['clientes'] : [];
$soportes = isset($_SESSION['soportes']) ? $_SESSION['soportes'] : [];

/* echo "<pre>";
print_r($clientes); 
echo "</pre>";
 */
// Convertir cada cliente JSON en un objeto Cliente
$clientes = array_map(function($clienteJson) {
    return Cliente::fromJSON($clienteJson);
}, $clientes);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <script>
        function confirmDelete(clienteNumero) {
            if (confirm("¿Estás seguro de que deseas eliminar este cliente?")) {
                window.location.href = "removeCliente.php?numero=" + clienteNumero;
            }
        }
    </script>
</head>
<body>
    <h2>Bienvenido, Administrador</h2>
    <p>Has iniciado sesión como administrador.</p>

    <h3>Listado de Clientes</h3>
    <ul>
    <?php foreach ($clientes as $cliente): ?>
            <li>
                Nombre: <?php echo htmlspecialchars($cliente->getNombre()); ?> - 
                Usuario: <?php echo htmlspecialchars($cliente->getUser()); ?> - 
                Número de Cliente: <?php echo htmlspecialchars($cliente->getNumero()); ?> - 
                Alquileres permitidos: <?php echo htmlspecialchars($cliente->getMaxAlquilerConcurrente()); ?>
                <a href="formUpdateCliente.php?numero=<?php echo htmlspecialchars($cliente->getNumero()); ?>">Editar</a>
                <a href="#" onclick="confirmDelete(<?php echo htmlspecialchars($cliente->getNumero()); ?>)">Eliminar</a>

            </li>
        <?php endforeach; ?>
    </ul>

    <a href="formCreateCliente.php">Añadir nuevo cliente</a>

    <h3>Listado de Soportes</h3>
    <ul>
        <?php foreach ($soportes as $soporte): ?>
            <li>
                Título: <?php echo htmlspecialchars($soporte['titulo']); ?> - Tipo: <?php echo htmlspecialchars($soporte['tipo']); ?> - Precio: <?php echo htmlspecialchars($soporte['precio']); ?> €
                <?php if ($soporte['tipo'] === 'Cinta Video'): ?>
                    - Duración: <?php echo htmlspecialchars($soporte['duracion']); ?> minutos
                <?php elseif ($soporte['tipo'] === 'DVD'): ?>
                    - Idiomas: <?php echo htmlspecialchars($soporte['idiomas']); ?> - Pantalla: <?php echo htmlspecialchars($soporte['pantalla']); ?>
                <?php elseif ($soporte['tipo'] === 'Juego'): ?>
                    - Consola: <?php echo htmlspecialchars($soporte['consola']); ?> - Jugadores: de <?php echo htmlspecialchars($soporte['minJugadores']); ?> a <?php echo htmlspecialchars($soporte['maxJugadores']); ?>
                <?php endif; ?>
                - Alquilado: <?php echo $soporte['alquilado'] ? 'Sí' : 'No'; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
