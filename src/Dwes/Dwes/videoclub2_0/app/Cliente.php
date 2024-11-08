<?php
namespace Dwes\videoclub2_0\app;

use Dwes\videoclub2_0\app\Util\SoporteYaAlquiladoException;
use Dwes\videoclub2_0\app\Util\CupoSuperadoException;
use Dwes\videoclub2_0\app\Util\SoporteNoEncontradoException;

class Cliente {
    public $nombre; 
    private $numero; 
    private $user;
    private $password;
    private $soportesAlquilados = []; 
    private $numSoportesAlquilados = 0; 
    private $maxAlquilerConcurrente; 

    
    public function __construct($nombre, $numero, $user,$password, $maxAlquilerConcurrente = 3) {
        $this->nombre = $nombre;
        $this->numero = $numero;
        $this->user = $user;
        $this->password = $password;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setMaxAlquilerConcurrente($maxAlquilerConcurrente) {
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getNumSoportesAlquilados() {
        return $this->numSoportesAlquilados;
    }

    public function getMaxAlquilerConcurrente() {
        return $this->maxAlquilerConcurrente;
    }

    public function getAlquileres(): array {
        return $this->soportesAlquilados;
    }


// Convierte el objeto a un formato JSON
public function toJSON() {
    return json_encode([
        'nombre' => $this->nombre,
        'numero' => $this->numero,
        'user' => $this->user,
        'password' => $this->password,        
        'maxAlquilerConcurrente' => $this->maxAlquilerConcurrente,
        'soportesAlquilados' => $this->soportesAlquilados

    ]);
}

// Crea un objeto Cliente a partir de un JSON
public static function fromJSON($jsonData) {
    $data = json_decode($jsonData, true);  // Convertir el JSON en un array asociativo
        $cliente = new Cliente(
            $data['nombre'],
            $data['numero'],
            $data['user'],
            $data['password'],
            $data['maxAlquilerConcurrente']
        );
        $cliente->soportesAlquilados = $data['soportesAlquilados'];  // Restaurar los alquileres
        return $cliente;
}


    public function muestraResumen() {
        echo "Nombre: " . $this->nombre . "<br>";
        echo "Alquileres realizados: " . count($this->soportesAlquilados) . "<br>";
    }

    public function tieneAlquilado(Soporte $soporte): bool {
        foreach ($this->soportesAlquilados as $alquilado) {
            if ($alquilado === $soporte) {
                return true;
            }
        }
        return false;
    }

    public function alquilar(Soporte $soporte) {
        if ($this->tieneAlquilado($soporte)) {
            throw new SoporteYaAlquiladoException("El soporte ya ha sido alquilado previamente.<br>");
            return $this;

        }

        if (count($this->soportesAlquilados) >= $this->maxAlquilerConcurrente) {
            echo "No puedes alquilar más de " . $this->maxAlquilerConcurrente . " soportes a la vez.<br>";
            throw new CupoSuperadoException("El cliente ha superado el límite de alquileres permitidos.");
            return $this;

        }

        $this->soportesAlquilados[] = $soporte;
        $soporte->alquilado=true;
        $this->numSoportesAlquilados++;
        echo "Soporte alquilado con éxito.<br>";
        return $this;
    }

    public function devolver(int $numSoporte): bool {
        foreach ($this->soportesAlquilados as $key => $soporte) {
            if ($soporte->getNumero() == $numSoporte) {
                unset($this->soportesAlquilados[$key]); 
                $this->soportesAlquilados = array_values($this->soportesAlquilados); 
                $soporte->alquilado=false;
                $this->numSoportesAlquilados--; 
                echo "Soporte devuelto con éxito.<br>";
                return true;
            }
        }
        throw new SoporteNoEncontradoException("El cliente no tiene alquilado el soporte.");
        return false;
    }

    public function listarAlquileres() {
        $numAlquileres = count($this->soportesAlquilados);
        echo "El cliente " . $this->nombre . " tiene " . $numAlquileres . " soportes alquilados:<br>";
        if ($numAlquileres > 0) {
            foreach ($this->soportesAlquilados as $soporte) {
                echo "- " . $soporte->getTitulo() . " (Número: " . $soporte->getNumero() . ")<br>";
            }
        } else {
            echo "No tiene soportes alquilados.<br>";
        }
        return $this;
    }



}
?>
