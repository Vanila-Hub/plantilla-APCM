<?php
session_start();


require_once __DIR__ . '/../autoload.php';

use Dwes\videoclub2_0\app\Cliente;

// creamos los clientes
if (!isset($_SESSION['clientes'])) {
    $clientes = [
        new Cliente('Juan Perez',1, 'juan', '1234', 3),
        new Cliente('Maria Lopez',2, 'maria', '5678', 2),
    ];

    // convertimos los clientes a JSON
    $_SESSION['clientes'] = array_map(function($cliente) {
        return $cliente->toJSON();
    }, $clientes);
}

$_SESSION['soportes'] = [
    ['titulo' => 'Star Wars', 'tipo' => 'Cinta Video', 'precio' => 10, 'duracion' => 120, 'alquilado' => false],
    ['titulo' => 'Matrix', 'tipo' => 'DVD', 'precio' => 15, 'idiomas' => 'Inglés, Español', 'pantalla' => '16:9', 'alquilado' => false],
    ['titulo' => 'FIFA 2022', 'tipo' => 'Juego', 'precio' => 60, 'consola' => 'PS5', 'minJugadores' => 1, 'maxJugadores' => 4, 'alquilado' => false]
];

// Datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Si es administrador
if ($username === 'admin' && $password === 'admin') {
    $_SESSION['username'] = 'admin';
    header('Location: mainAdmin.php');
    exit();
}

// Si es un cliente
foreach ($_SESSION['clientes'] as $clienteJson) {
    $cliente = Cliente::fromJSON($clienteJson);
    if ($cliente->getUser() === $username && $cliente->getPassword() === $password) {
        $_SESSION['username'] = $cliente->getUser();
        $_SESSION['cliente'] = $cliente->toJSON();  // Guardamos el cliente actual en la sesión
        header('Location: mainCliente.php');
        exit();
    }
}

// Si no coincide con ningún cliente ni es admin, mostrar error
header('Location: index.php?error=Usuario o contraseña incorrectos');
exit();