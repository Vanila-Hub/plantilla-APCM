<?php
// Iniciar la sesión al principio del archivo
session_start();

// Ahora puedes acceder a $_SESSION

require_once("../clases/Usuario.php");
require_once '../clases/Libro.php';
include '../views/header.php';
$libros = Libro::obtenerTodos();
$listaUsuarios = Usuario::obtenerTodos();
include '../views/lista_libros.php';
include '../views/footer.php';
?>
    