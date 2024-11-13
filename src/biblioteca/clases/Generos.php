<?php
// classes/Genero.php
require_once 'Database.php';
class Genero
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
        $sql = "SELECT * FROM generos";
        $sentencia = $pdo->prepare($sql);
        $sentencia->execute();

        $resultado = $sentencia->fetchAll();
        $generos = [];
        foreach ($resultado as $row) {
            $generos[]= new Genero($row["id"],$row["nombre"]);
        }
        return $generos;
    }
}
