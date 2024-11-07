<?php
class Persona{
    private int $id;
    private string $nombre;
    private string $apellidos;
    private string $telefono;

    public function getId(){return $this->id;}
    public function getNombre(){return $this->nombre;}
    public function getApellidos(){return $this->apellidos;}
    public function getTelefono(){return $this->telefono;}
}
?>