<?php
require_once '../model/Databases.php';
require_once '../model/Pelicula.php';

 function getPeliculas(){
    $sql = "SELECT * FROM peliculas";
    $pdo = Database::getInstance();
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    $resultset = $sentencia->fetchAll();
    $peliculas = [];
    foreach ($resultset as $row) {
        $pelicula = new Pelicula($row["id"],$row["titulo"],$row["director"],$row["año"],$row["genero"],$row["descripcion"],$row["imagen_url"]);
        $peliculas[]=$pelicula;
    }
    return $peliculas;
} 
?>