<?php
session_start();

require_once __DIR__ . '/../autoload.php';
require_once 'db.php';
use Dwes\videoclub2_0\app\Cliente;

// Verificar que el cliente a editar está disponible en la sesión

if (!isset($_GET['numero'])) {
    header('Location: mainAdmin.php');
    exit();
}

// Obtener el cliente a editar de la sesión
$numeroCliente = intval($_GET['numero']);

// $clientes = isset($_SESSION['clientes']) ? $_SESSION['clientes'] : [];
// $clienteAEditar = null;

// foreach ($clientes as $clienteJson) {
//     $cliente = Cliente::fromJSON($clienteJson);
//     if ($cliente->getNumero() === $numeroCliente) {
//         $clienteAEditar = $cliente;
//         break;
//     }
// }

// // Si no se encontró el cliente, redirigir
// if ($clienteAEditar === null) {
//     header('Location: mainAdmin.php');
//     exit();
// }


// obtienen los datos de la sesion
$sql = "select * from clientes where id = ?";

$sentencia = $pdo->prepare($sql);
$sentencia->execute([$numeroCliente]);

$resulset = $sentencia->fetchAll();
$clienteAEditar = [];
foreach ($resulset as $cliente) {
    $clienteAEditar = new Cliente($cliente["nombre"], $cliente["id"], $cliente["user"], $cliente["password"], $cliente["maxAlquilerConcurrente"]);
}

$isAdmin = $_SESSION['username'] === 'admin';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="card">
        <h2 class="titulo-principal">Editar Cliente: <?php echo htmlspecialchars($clienteAEditar->getNombre()); ?></h2>

        <form action="updateCliente.php" method="POST">
            <input type="hidden" name="numero" value="<?php echo htmlspecialchars($clienteAEditar->getNumero()); ?>">
            <input type="hidden" name="isAdmin" value="<?php echo $isAdmin ? 'true' : 'false'; ?>">

            <div class="campo-formulario">
                <label for="nombre" class="etiqueta">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($clienteAEditar->getNombre()); ?>" required class="input-formulario"><br>
            </div>

            <input type="hidden" id="id" name="id" value="<?php echo htmlspecialchars($clienteAEditar->getNumero());?>"><br>

            <div class="campo-formulario">
                <label for="user" class="etiqueta">Usuario:</label>
                <input type="text" id="user" name="user" value="<?php echo htmlspecialchars($clienteAEditar->getUser()); ?>" required class="input-formulario"><br>
            </div>

            <div class="campo-formulario">
                <label for="password" class="etiqueta">Contraseña:</label>
                <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($clienteAEditar->getPassword()); ?>" required class="input-formulario"><br>
            </div>

            <div class="campo-formulario">
                <label for="maxAlquilerConcurrente" class="etiqueta">Alquileres Permitidos:</label>
                <input type="number" id="maxAlquilerConcurrente" name="maxAlquilerConcurrente" value="<?php echo htmlspecialchars($clienteAEditar->getMaxAlquilerConcurrente()); ?>" required class="input-formulario"><br>
            </div>

            <input type="submit" value="Actualizar Cliente" class="boton-enviar">
        </form>

        <a href="mainAdmin.php" class="enlace-volver">Volver al panel de administrador</a>
    </div>
</body>
</html>
