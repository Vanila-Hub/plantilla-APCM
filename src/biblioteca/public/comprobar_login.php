<?php
require_once '../clases/Usuario.php';

session_start();
// mirar si el usuario est en la sesion, si no esta obetener todos los uduarios de la BBDD mirar si el POSt el ususario es admin o un usuario de la BBDD
if (!isset($_SESSION["user"])) {
    $usuariosBD = Usuario::obtenerTodos();
    $user = $_POST["user"];
    $password = $_POST["password"];

    if ($user== "admin" && $password == "1234") {
        // $_SESSION["usuario"] = "admin";
        $_SESSION["usuarios"] = $usuariosBD;
        header("location: index.php");
        exit();
    }

    foreach ($usuariosBD as $usuario) {
       if ($usuario["user"]== $user && password_verify($password,$usuario["password"])) {
            $_SESSION["usuario"] = $usuario;
            header("location: index2.php");
            exit();
        }
    }
    
    header("location: login.php?error=error ");
    exit();
}
?>
