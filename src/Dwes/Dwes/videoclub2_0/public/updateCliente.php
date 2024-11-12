<?php
session_start();

require_once __DIR__ . '/../autoload.php';
require_once 'db.php';
use Dwes\videoclub2_0\app\Cliente;

// Recoger los datos enviados por el formulario
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$user = isset($_POST['user']) ? trim($_POST['user']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
$maxAlquilerConcurrente = isset($_POST['maxAlquilerConcurrente']) ? intval($_POST['maxAlquilerConcurrente']) : 3;
$id = isset($_POST['id']) ? trim($_POST['id']) : '';

// Verificar que todos los campos están completos
if (empty($nombre) || empty($user) || empty($password) || $maxAlquilerConcurrente <= 0) {
    header('Location: formUpdateCliente.php?error=Datos incorrectos, por favor rellena todos los campos.');
    exit();
}

// // Obtener los clientes de la sesión
// $clientes = isset($_SESSION['clientes']) ? $_SESSION['clientes'] : [];

// // Buscar y actualizar el cliente en la sesión
// foreach ($clientes as &$clienteJson) {
//     $cliente = Cliente::fromJSON($clienteJson);
//     if ($cliente->getNumero() === $numero) {
//         $cliente->setNombre($nombre);
//         $cliente->setUser($user);
//         $cliente->setPassword($password);
//         $cliente->setMaxAlquilerConcurrente($maxAlquilerConcurrente);
//         $clienteJson = $cliente->toJSON();  // Actualizar el cliente en la sesión
//         break;
//     }
// $_SESSION['clientes'] = $clientes;
// }
$isAdmin = $_SESSION["username"];
// Actualizar la sesión con el cliente modificado
$sql = "UPDATE clientes SET nombre=:nombre,user=:usuario,password=:password,maxAlquilerConcurrente=:maxAlquilerConcurrente WHERE id = :id";
$sentencia = $pdo->prepare($sql);
$sentencia ->bindParam(":nombre",$nombre);
$sentencia ->bindParam(":usuario",$user);
$sentencia ->bindParam(":password",$password);
$sentencia ->bindParam(":maxAlquilerConcurrente",$maxAlquilerConcurrente);
$sentencia ->bindParam(":id",$id);
$isOk = $sentencia->execute();

// Redirigir de vuelta al panel de administrador o cliente
if ($isAdmin) {
    header('Location: mainAdmin.php');
} else {
    header('Location: mainCliente.php');
}

exit();
