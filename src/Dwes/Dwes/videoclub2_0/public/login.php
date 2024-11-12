<?php
session_start();
require_once 'db.php'; 

require_once __DIR__ . '/../autoload.php';

use Dwes\videoclub2_0\app\Cliente;
use Dwes\videoclub2_0\app\CintaVideo;
use Dwes\videoclub2_0\app\Dvd;
use Dwes\videoclub2_0\app\Juego;

// creamos los clientes
if (!isset($_SESSION['clientes'])) {
    
    //hacer la cosulta clientes
    $sql = "select * from clientes";

    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    
    $resulset = $sentencia->fetchAll();

    $clientes = $resulset;
    
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
    foreach ($clientes as $clienteJson) {
        if ($clienteJson["user"] === $username && $clienteJson["password"] === $password) {
            $_SESSION['username'] = $clienteJson["user"];
            $_SESSION['cliente'] = $clienteJson;  // Guardamos el cliente actual en la sesión
            header('Location: mainCliente.php');
            exit();
        }
    }
}
// $_SESSION['soportes'] = [
//     ['titulo' => 'Star Wars', 'tipo' => 'Cinta Video', 'precio' => 10, 'duracion' => 120, 'alquilado' => false],
//     ['titulo' => 'Matrix', 'tipo' => 'DVD', 'precio' => 15, 'idiomas' => 'Inglés, Español', 'pantalla' => '16:9', 'alquilado' => false],
//     ['titulo' => 'FIFA 2022', 'tipo' => 'Juego', 'precio' => 60, 'consola' => 'PS5', 'minJugadores' => 1, 'maxJugadores' => 4, 'alquilado' => false]
// ];



// Si no coincide con ningún cliente ni es admin, mostrar error
header('Location: index.php?error=Usuario o contraseña incorrectos');
exit();
