<?php
session_start();
require_once __DIR__ . '/../autoload.php';
require_once 'db.php';



use Dwes\videoclub2_0\app\Cliente;
use Dwes\videoclub2_0\app\CintaVideo;
use Dwes\videoclub2_0\app\Dvd;
use Dwes\videoclub2_0\app\Juego;

$testCliente = new Cliente('Test', 1, 'testuser', 'testpass', 1, 3);
echo 'Cliente cargado correctamente: ' . $testCliente->getNombre() . '<br>';


// si no hay sesion o no es admin redirigir a index
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: index.php');
    exit();
}

// obtienen los datos de la sesion
$sql = "select * from clientes";

$sentencia = $pdo->prepare($sql);
$sentencia->execute();

$resulset = $sentencia->fetchAll();

$clientes = $resulset;

$sql = "select * from soportes";

$sentencia = $pdo->prepare($sql);
$sentencia->execute();

$resulset = $sentencia->fetchAll();

$soportes = $resulset;

// echo "<pre>";
// print_r($clientes);
// print_r($soportes);
// echo "</pre>";

$clientesPOO = [];
$soportesPOO = [];
foreach ($clientes as $cliente) {
    $clientesPOO[] = new Cliente($cliente["nombre"], $cliente["id"], $cliente["user"], $cliente["password"], $cliente["maxAlquilerConcurrente"]);
}
foreach ($soportes as $soporte) {
    switch ($soporte["tipo"]) {
        case 'Cinta Video':
            $soportesPOO[] = new CintaVideo($soporte["titulo"], $soporte["id"], $soporte["precio"], $soporte["duracion"]);
            $soportesPOO[count($soportesPOO) - 1]->alquilado = $soporte["alquilado"];
            break;
        case 'DVD':
            $soportesPOO[] = new Dvd($soporte["titulo"], $soporte["id"], $soporte["precio"], $soporte["idiomas"], $soporte["pantalla"]);
            $soportesPOO[count($soportesPOO) - 1]->alquilado = $soporte["alquilado"];
            break;
        case 'Juego':
            $soportesPOO[] = new Juego($soporte["titulo"], $soporte["id"], $soporte["precio"], $soporte["consola"], $soporte["minJugadores"], $soporte["maxJugadores"]);
            $soportesPOO[count($soportesPOO) - 1]->alquilado = $soporte["alquilado"];
            break;
        default:
            break;
    }
}
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
        <?php foreach ($clientesPOO as $cliente): ?>
            <li>
                Nombre: <?php echo htmlspecialchars($cliente->getNombre()); ?> -
                Usuario: <?php echo htmlspecialchars($cliente->getUser()) ?> -
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
        <?php foreach ($soportesPOO as $soporte): ?>
            <li>
                - Título: <?php echo htmlspecialchars($soporte->getTitulo());?> 
                - Numero: <?php echo htmlspecialchars($soporte->getNumero()) ?>
                - Precio: <?php echo htmlspecialchars($soporte->getPrecio()) ?>
                - Alquilado: <?php echo $soporte->alquilado == 1 ? 'Sí' : 'No'; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="logout.php">Cerrar Sesión</a>
</body>

</html>