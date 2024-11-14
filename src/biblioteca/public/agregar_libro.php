<link rel="stylesheet" href="../views/estilos.css">

<?php
require_once '../clases/Libro.php';
require_once '../clases/Autor.php';
require_once '../clases/Generos.php';
$autores = Autor::obtenerTodos();
$generos = Genero::obtenerTodos();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //agregar el libro que se pasa desde el formulario_agregar_libro.php
    $titulo = $_POST["titulo"];
    $id_autor = $_POST["id_autor"];
    $id_genero = $_POST["id_genero"];
    $fecha_publicacion = $_POST["fecha_publicacion"];

    Libro::agregar(
        $titulo,
        $id_autor,
        $id_genero,
        $fecha_publicacion
    );
    
    header("Location: index.php");
    exit;
}
include '../views/header.php';
include '../views/formulario_agregar_libro.php';
include '../views/footer.php';
