<?php
require_once '../clases/Libro.php';
$libros = Libro::obtenerTodos();
include '../views/header.php';
include '../views/lista_libros.php';
include '../views/footer.php';
?>