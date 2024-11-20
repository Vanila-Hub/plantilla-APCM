<?php
require_once 'Databases.php';
require_once 'Libro.php';
require_once 'Autor.php';
require_once 'Generos.php';

class Usuario
{
    public $id;
    public $user;
    public $password;
    public $nombre;
    public $apellidos;
    public $libro_alquilados;
    public $fecha;

    // Constructor
    public function __construct($id, $user, $password, $nombre, $apellidos, $libro_alquilados, $fecha)
    {
        $this->id = $id;
        $this->user = $user;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->libro_alquilados = $libro_alquilados;
        $this->fecha = $fecha;
    }
    public static function getAlquilados($id_usuario)
    {
        $sql = "SELECT 
        libros.id, 
        libros.titulo, 
        autores.id AS autor_id,
        autores.nombre AS autor_nombre,
        generos.id AS genero_id, 
        generos.nombre AS genero_nombre, 
        libros.fecha_publicacion
        FROM 
            libros
        JOIN 
            autores ON libros.id_autor = autores.id
        JOIN 
            generos ON libros.id_genero = generos.id
        LEFT JOIN 
            usuarios ON libros.id = usuarios.id_libro_alquilado
        WHERE 
            usuarios.id = :id; 
        ";

        $pdo = Database::getInstance();
        $sentencia = $pdo->prepare($sql);
        $sentencia->bindParam("id", $id_usuario);
        $sentencia->execute();
        $resulset = $sentencia->fetchAll();
        $librosAlquilados = [];
        foreach ($resulset as $row) {
            $autor = new Autor((int)$row["autor_id"], $row["autor_nombre"]);
            $genero = new Genero((int)$row["genero_id"], $row["genero_nombre"]);
            $libro = new Libro($row["id"], $row["titulo"], $autor, $genero, $row["fecha_publicacion"]);
            $librosAlquilados[] = $libro;
        }
        return $librosAlquilados;
    }

    public static function alquilar($id_libro, $id_usuario, $fecha)
    {
        $sql = "UPDATE `usuarios` SET id_libro_alquilado = :id_libro, fecha = :fecha  WHERE id = :id_usuario;";

        $pdo = Database::getInstance();
        $sentencia = $pdo->prepare($sql);
        $sentencia->bindParam("id_libro", $id_libro);
        $sentencia->bindParam("fecha", $fecha);
        $sentencia->bindParam("id_usuario", $id_usuario);
        $sentencia->execute();
        $isOk = $sentencia->rowCount();
    }

    public static function obtenerTodos()
    {
        $sql = "SELECT * FROM `usuarios`";
        $pdo = Database::getInstance();
        $sentencia = $pdo->prepare($sql);
        $sentencia->execute();
        $resulset = $sentencia->fetchAll();
        return $resulset;
    }
}
