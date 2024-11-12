<?php
session_start();

require_once __DIR__ . '/../autoload.php';
require_once 'db.php';
use Dwes\videoclub2_0\app\Cliente;

// Verificar que el número del cliente a eliminar está disponible
if (!isset($_GET['numero'])) {
    header('Location: mainAdmin.php');
    exit();
}

$numeroCliente = intval($_GET['numero']);

// // Obtener los clientes de la sesión
// $clientes = isset($_SESSION['clientes']) ? $_SESSION['clientes'] : [];

// // Buscar y eliminar el cliente en la sesión
// foreach ($clientes as $key => $clienteJson) {
//     $cliente = Cliente::fromJSON($clienteJson);
//     if ($cliente->getNumero() === $numeroCliente) {
//         unset($clientes[$key]);  // Eliminar el cliente del array
//         break;
//     }
// $_SESSION['clientes'] = array_values($clientes);  // Reindexar el array
// }

// Redirigir de vuelta al panel de administración
$sql = "DELETE FROM clientes WHERE id=?";
$sentencia = $pdo->prepare($sql);
$isOk = $sentencia-> execute([$numeroCliente]);

header('Location: mainAdmin.php');
exit();
