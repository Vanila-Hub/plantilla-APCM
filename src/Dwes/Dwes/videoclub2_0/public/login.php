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
    //hacer la cosulta

    $sql = "select * from clientes";

    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    
    $resulset = $sentencia->fetchAll();

    $clientes = [];
    foreach ($resulset as $resultado) {
        $clientes[]=new Cliente($resultado["nombre"], $resultado["id"], $resultado["user"], $resultado["password"], $resultado["maxAlquilerConcurrente"]);
    }

    // $_SESSION['clientes'] = array_map(function ($clientes) {
    //     return $clientes->toJSON();
    // }, $clientes);

    $_SESSION['clientes'] = $clientes;

    $sql = "select * from soportes";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    
    $resulset = $sentencia->fetchAll();
    $soportes=[];
    foreach ($resulset as $resultado) {
        switch ($resultado["tipo"]) {
            case 'Cinta Video':
                $soportes[]= new CintaVideo($resultado["titulo"],$resultado["id"], $resultado["precio"], $resultado["duracion"]);
                break;
            case 'DVD':
                $soportes[]= new Dvd($resultado["titulo"], $resultado["id"], $resultado["precio"],$resultado["idiomas"], $resultado["pantalla"]);
                break;
            case 'Juego':
                $soportes[]= new Juego($resultado["titulo"],$resultado["id"], $resultado["precio"], $resultado["consola"], $resultado["minJugadores"],$resultado["maxJugadores"]);
                break;
            default:
                break;
        }
    }

}
// $_SESSION['soportes'] = [
//     ['titulo' => 'Star Wars', 'tipo' => 'Cinta Video', 'precio' => 10, 'duracion' => 120, 'alquilado' => false],
//     ['titulo' => 'Matrix', 'tipo' => 'DVD', 'precio' => 15, 'idiomas' => 'Inglés, Español', 'pantalla' => '16:9', 'alquilado' => false],
//     ['titulo' => 'FIFA 2022', 'tipo' => 'Juego', 'precio' => 60, 'consola' => 'PS5', 'minJugadores' => 1, 'maxJugadores' => 4, 'alquilado' => false]
// ];
$_SESSION['soportes'] = $soportes;


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
