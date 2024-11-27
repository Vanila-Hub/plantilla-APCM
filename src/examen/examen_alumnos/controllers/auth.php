<?php
session_start();
require_once "../config/db.php";
require_once "../models/User.php";

// funcion de inicio de sesión
function login($username, $password) {
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    if ($user->login($username, $password)) { //Maitane: esta es la función que hay que hacer en User.php
        //Maitane: guardar en sesión los datos que estimes necesarios obteniendo los datos de $user
        $_SESSION["username"] = $user->username;
        $_SESSION["role"] = $user->role;
        $_SESSION["id"] = $user->id;
       
        header("Location: ../views/resources.php");
        exit;
    } else {
        echo "Credenciales incorrectas";
    }
}

// funcion de cierre de sesión
function logout() {
    session_unset();
    session_destroy();
    header("Location: ../views/login.php");
    exit;
}

// manejar login y logout
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['login'])) {
        login($_POST['username'], $_POST['password']);
    }
} elseif (isset($_GET['action']) && $_GET['action'] === 'logout') {
    logout();
}
?>
