<?php
namespace Dwes\videoclub2_0\app;

class Soporte {
    public $titulo;
    protected $numero;
    private $precio;
    private static $IVA = 0.21;
    public $alquilado=false;

  
    public function __construct($titulo, $numero, $precio) {
        $this->titulo = $titulo;
        $this->numero = $numero;
        $this->precio = $precio;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getPrecioConIva() {
        return $this->precio * (1 + self::$IVA); 
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getTitulo() {
        return $this->titulo;        
    }

    public function muestraResumen() {
        echo "Título: " . $this->titulo . "<br>";
        echo "Número: " . $this->numero . "<br>";
        echo "Precio: " . $this->getPrecio() . " €<br>";
        echo "Precio con IVA: " . $this->getPrecioConIva() . " €<br>";
    }
}
?>
