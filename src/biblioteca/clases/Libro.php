<?php
// classes/Libro.php
require_once 'Databases.php';
require_once 'Autor.php';
require_once 'Generos.php';
class Libro
{
    //agregar atributos de la clase, mirar la tabla

    public $id;
    public $titulo;
    public $autor;
    public $genero;
    public $fecha_publicacion;
    //agregar el constructor
    function __construct($id,$titulo,$autor,$genero,$fecha_publicacion)
    {
        $this->id=$id;
        $this->titulo=$titulo;
        $this->autor=$autor;
        $this->genero=$genero;
        $this->fecha_publicacion=$fecha_publicacion;
    }

    public static function obtenerTodos()
    {
        //funcion para obtener todos los libros de la base de datos (mirar las
        //otras clases)
        // la instruccion SQL es la siguiente:
        $sql = "SELECT libros.id, libros.titulo, autores.id AS autor_id,
        autores.nombre AS autor_nombre,
        generos.id AS genero_id, generos.nombre AS
        genero_nombre, libros.fecha_publicacion
        FROM libros
        JOIN autores ON libros.id_autor = autores.id
        JOIN generos ON libros.id_genero = generos.id";
        $pdo = Database::getInstance();
        $sentencia = $pdo->prepare($sql);
        $sentencia->execute();
        $resulset = $sentencia->fetchAll();
        $libros = [];
        foreach ($resulset as $row) {
            $autor = new Autor((int)$row["autor_id"],$row["autor_nombre"]);
            $genero = new Genero((int)$row["genero_id"],$row["genero_nombre"]);
            $libro = new Libro($row["id"],$row["titulo"],$autor,$genero,$row["fecha_publicacion"]);
            $libros[]=$libro;
        }
        return $libros;
    }
    //cuidado! el libro tiene objetos de clase autor y género, habrá que
    //capturar esos objetos y meterlos dentro del libro
    public static function agregar(
        $titulo,
        $id_autor,
        $id_genero,
        $fecha_publicacion
    ) { 
        //función para agregar un libro a la base de datos, usar prepare y execute de sentencias sql
       $sql = "INSERT INTO `libros`(`titulo`, `id_autor`, `id_genero`, `fecha_publicacion`) VALUES (:titulo,:id_autor,:id_genero,:fecha_publicacion)";
        $pdo = Database::getInstance();
        $sentencia = $pdo->prepare($sql);
        $sentencia->bindParam(":titulo",$titulo);
        $sentencia->bindParam(":id_autor",$id_autor);
        $sentencia->bindParam(":id_genero",$id_genero);
        $fecha_nueva = Date("Y-m-d",strtotime($fecha_publicacion));
        $sentencia->bindParam(":fecha_publicacion",$fecha_nueva);
        $sentencia->execute();
    }
    public static function eliminar($titulo){
        $sql = "DELETE FROM `libros` WHERE titulo = :titulo ";
        $pdo = Database::getInstance();
        $sentencia = $pdo->prepare($sql);
        $sentencia->bindParam(":titulo",$titulo);
        $isOk = $sentencia->execute();
    }
    public static function buscar($id_autor = null, $id_genero = null)
    {
        //funcion para buscar libros por id de autor e id de genero
        //la sentencia sql es la siguiente
        $sql = "SELECT libros.id, libros.titulo, autores.id AS
        autor_id, autores.nombre AS autor_nombre,
        generos.id AS genero_id, generos.nombre AS
        genero_nombre, libros.fecha_publicacion
        FROM libros
        JOIN autores ON libros.id_autor = autores.id
        JOIN generos ON libros.id_genero = generos.id
        WHERE (:id_autor IS NULL OR libros.id_autor =
        :id_autor)
        AND (:id_genero IS NULL OR libros.id_genero =
        :id_genero)";
        //utilizar prepare y execute de la sentencia
        $pdo = Database::getInstance();
        $sentencia = $pdo->prepare($sql);
        $sentencia->bindParam(":id_autor",$id_autor);
        $sentencia->bindParam(":id_genero",$id_genero);
        //cuidado! hay que volver a capturar y generar objetos autor y genero y
        //ponerlos en el libro como atributos
        $sentencia->execute();
        $resulset = $sentencia->fetchAll();
        $libros = [];
        foreach ($resulset as $row) {
            $autor = new Autor((int)$row["autor_id"],$row["autor_nombre"]);
            $genero = new Genero((int)$row["genero_id"],$row["genero_nombre"]);
            $libro = new Libro($row["id"],$row["titulo"],$autor,$genero,$row["fecha_publicacion"]);
            $libros[]=$libro;
        }
        return $libros;

    }
}
