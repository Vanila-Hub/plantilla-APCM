<?php
require_once '../clases/Libro.php';
require_once '../clases/Autor.php';
require_once '../clases/Generos.php';
$libros = Libro::obtenerTodos();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST["titulo"];

    $libros =  Libro::eliminar(
        $titulo
    );    
    header("Location: index.php");
}
include '../views/header.php';
include '../views/formulario_eliminar_libro.php';
include '../views/footer.php';
