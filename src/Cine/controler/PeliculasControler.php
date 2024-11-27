<?php
require_once '../model/Databases.php';
require_once '../model/Pelicula.php';

function getPeliculas()
{
    $sql = "SELECT * FROM peliculas";
    $pdo = Database::getInstance();
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute();
    $resultset = $sentencia->fetchAll();
    $peliculas = [];
    foreach ($resultset as $row) {
        $pelicula = new Pelicula($row["id"], $row["titulo"], $row["director"], $row["ano"], $row["genero"], $row["descripcion"], $row["imagen_url"]);
        $peliculas[] = $pelicula;
    }
    return $peliculas;
}
// Crear Pelicula
function crearPelicula($datos)
{
    $pdo = Database::getInstance();
    $sql = "INSERT INTO peliculas (titulo, director, ano, genero, descripcion, imagen_url) VALUES (:titulo, :director, :ano, :genero, :descripcion, :imagen_url)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':titulo', $datos['titulo']);
    $stmt->bindParam(':director', $datos['director']);
    $stmt->bindParam(':ano', $datos['ano']);
    $stmt->bindParam(':genero', $datos['genero']);
    $stmt->bindParam(':descripcion', $datos['descripcion']);
    $stmt->bindParam(':imagen_url', $datos['imagen_url']);
    return $stmt->execute();
}
//Eliminar Pelicula
function eliminarPelicula($id)
{
    $pdo = Database::getInstance();
    $sql = "DELETE FROM peliculas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
    header("Location:index.php");
}
function modificarPelicula($datos)
{
    $pdo = Database::getInstance();
    $sql = "UPDATE `peliculas` 
            SET 
                `titulo` = :titulo,
                `director` = :director,
                `ano` = :ano,
                `genero` = :genero,
                `descripcion` = :descripcion,
                `imagen_url` = :imagen_url
            WHERE `id` = :id";
    $stmt = $pdo->prepare($sql);

    // Bind los valores del array a la consulta preparada
    $stmt->bindValue(':id', $datos['id']);
    $stmt->bindValue(':titulo', $datos['titulo']);
    $stmt->bindValue(':director', $datos['director']);
    $stmt->bindValue(':ano', $datos['ano']);
    $stmt->bindValue(':genero', $datos['genero']);
    $stmt->bindValue(':descripcion', $datos['descripcion']);
    $stmt->bindValue(':imagen_url', $datos['imagen_url']);

    $stmt->execute();
    $id = $datos['id'];
    header("Location:ver.php?id=$id");
}



//Seleccionar 1 pelicula
function getPeliculaById($id)
{
    $pdo = Database::getInstance();
    $sql = "SELECT * FROM peliculas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $resultset = $stmt->fetch();
    if ($resultset != null) {
        $pelicula = new Pelicula($resultset["id"], $resultset["titulo"], $resultset["director"], $resultset["ano"], $resultset["genero"], $resultset["descripcion"], $resultset["imagen_url"]);
        return $pelicula;
    } else {
        return null;
    }
}
