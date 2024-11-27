<?php
require_once '../controler/PeliculasControler.php';
require_once '../model/Pelicula.php';

if ($_SERVER['REQUEST_METHOD']=="GET") {
    $id_pelicula = isset($_GET['id'])?$_GET['id']:"";
    eliminarPelicula($id_pelicula);
    header("Location: index.php");
}
?>