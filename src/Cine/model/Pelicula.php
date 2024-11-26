<?php
require_once 'Databases.php';
class Pelicula {
    private $table = 'peliculas';

    public $id;
    public $titulo;
    public $director;
    public $año;
    public $genero;
    public $descripcion;
    public $imagen_url;

    // Constructor para inicializar la conexión
    public function __construct($id,$titulo,$director,$año,$genero,$descripcion,$imagen_url) {
        
    }
}