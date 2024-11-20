<?php
require_once '../clases/Libro.php';
require_once '../clases/Usuario.php';
$libros = Libro::obtenerTodos();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id_usuario = (int) $_GET["id_usuario"];
    $id_libro = (int) $_GET["id_libro"];
    $fecha = $_GET["fecha"];
    Usuario::alquilar($id_libro, $id_usuario, $fecha);
    header("Location: index2.php");
}

?>
