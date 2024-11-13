<?php
// classes/Autor.php
require_once 'Database.php';
class Autor
{
    public $id;
    public $nombre;
    public function __construct($id, $nombre)
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }
    public static function obtenerTodos()
    {
        $pdo = Database::getInstance();
        //funcion para obtener todos los autores de la base de datos
        $sql = "SELECT * FROM autores";
        $sentencia = $pdo->prepare($sql);
        $sentencia->execute();

        $resultado = $sentencia->fetchAll();
        $autores = [];
        foreach ($resultado as $row) {
            $autores[]= new Autor($row["id"],$row["nombre"]);
        }
        return $autores;
    }
}
