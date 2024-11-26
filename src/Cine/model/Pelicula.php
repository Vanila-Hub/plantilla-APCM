<?php
require_once 'Databases.php';
class Pelicula {
    public $id;
    public $titulo;
    public $director;
    public $año;
    public $genero;
    public $descripcion;
    public $imagen_url;

    // Constructor para inicializar la conexión
    public function __construct($id,$titulo,$director,$año,$genero,$descripcion,$imagen_url) {
        $this->año = $año;
        $this->descripcion=$descripcion;
        $this->director=$director;
        $this->genero=$genero;
        $this->id=$id;
        $this->imagen_url=$imagen_url;
        $this->titulo=$titulo;
    }

}