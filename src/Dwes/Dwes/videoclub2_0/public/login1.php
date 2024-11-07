<?php
session_start();

// usuarios validos
$valid_users = [
    'admin' => 'admin',
    'usuario' => 'usuario'
];

// obtenemos los datos del formulario
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// comprobar el usuario y contraseña que sean validos
if (isset($valid_users[$username]) && $valid_users[$username] === $password) {
    // es correcto entonces se almacena en la sesion y redirige a main
    $_SESSION['username'] = $username;
    header('Location: main.php');
    exit();
} else {
    // no es correcto y redirige a index con un error
    header('Location: index.php?error=Usuario o contraseña incorrectos');
    exit();
}
