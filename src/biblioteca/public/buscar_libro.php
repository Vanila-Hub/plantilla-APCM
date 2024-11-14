<?php
require_once '../clases/Libro.php';
require_once '../clases/Autor.php';
require_once '../clases/Generos.php';
$autores = Autor::obtenerTodos();
$generos = Genero::obtenerTodos();
$libros = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $libros=[];
    //agregar el libro que se pasa desde el formulario_agregar_libro.php
    $id_autor = $_POST["id_autor"];
    $id_genero = $_POST["id_genero"];

    $libros =  Libro::buscar(
        $id_autor,
        $id_genero,
    );    
    var_dump($id_autor);
}
include '../views/header.php';
include '../views/formulario_buscar_libro.php';
include '../views/footer.php';
