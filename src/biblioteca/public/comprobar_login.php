<?php
require_once '../clases/Autor.php';

session_start();
if (!isset($_SESSION["user"])) {
    $autores = Autor::obtenerTodos();

    $user = $_POST["user"];
    $password = $_POST["password"];
    foreach ($autores as $autor) {
        if ($autor->nombre==$user) {
            header("Location: index.php");
        }
    }
}
?>
