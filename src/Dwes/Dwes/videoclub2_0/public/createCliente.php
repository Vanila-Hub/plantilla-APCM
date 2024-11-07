<?php
session_start();

require_once __DIR__ . '/../autoload.php';

use Dwes\videoclub2_0\app\Cliente;

// Validar los datos del formulario
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$user = isset($_POST['user']) ? trim($_POST['user']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
$numero = isset($_POST['numero']) ? intval($_POST['numero']) : 0;
$maxAlquilerConcurrente = isset($_POST['maxAlquilerConcurrente']) ? intval($_POST['maxAlquilerConcurrente']) : 3;

// Verificar que todos los campos estén completos
if (empty($nombre) || empty($user) || empty($password) || $numero <= 0 || $maxAlquilerConcurrente <= 0) {
    header('Location: formCreateCliente.php?error=Datos incorrectos, por favor rellena todos los campos.');
    exit();
}

// Verificar si el número de cliente ya existe
$clientes = isset($_SESSION['clientes']) ? $_SESSION['clientes'] : [];
foreach ($clientes as $clienteJson) {
    $cliente = Cliente::fromJSON($clienteJson);
    if ($cliente->getNumero() === $numero || $cliente->getUser() === $user) {
        header('Location: formCreateCliente.php?error=El número de cliente o el usuario ya existe.');
        exit();
    }
}

// Crear un nuevo cliente y agregarlo a la sesión
$nuevoCliente = new Cliente($nombre, $numero, $user, $password, $maxAlquilerConcurrente);
$_SESSION['clientes'][] = $nuevoCliente->toJSON();  // Añadir el nuevo cliente a la sesión

// Redirigir de vuelta a mainAdmin.php
header('Location: mainAdmin.php');
exit();
