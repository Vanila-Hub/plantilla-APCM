<?php
namespace Dwes\videoclub2_0\app;

use Dwes\videoclub2_0\app\Util\ClienteNoEncontradoException;
use Dwes\videoclub2_0\app\Util\SoporteNoEncontradoException;
use Dwes\videoclub2_0\app\Util\SoporteYaAlquiladoException;
use Dwes\videoclub2_0\app\Util\CupoSuperadoException;

class Videoclub {
    private $nombre;
    private $productos = [];
    private $numProductos = 0;
    private $socios = [];
    private $numSocios = 0;
    private $numProductosAlquilados=0;
    private $numTotalAlquileres=0;


    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    private function incluirProducto(Soporte $producto) {
        $this->productos[] = $producto;
        $this->numProductos++;
    }

    public function incluirCintaVideo($titulo, $numero, $precio, $duracion) {
        $cinta = new CintaVideo($titulo, $numero, $precio, $duracion);
        $this->incluirProducto($cinta);
    }

    public function incluirDvd($titulo, $numero, $precio, $idiomas, $formatoPantalla) {
        $dvd = new Dvd($titulo, $numero, $precio, $idiomas, $formatoPantalla);
        $this->incluirProducto($dvd);
    }

    public function incluirJuego($titulo, $numero, $precio, $consola, $minNumJugadores, $maxNumJugadores) {
        $juego = new Juego($titulo, $numero, $precio, $consola, $minNumJugadores, $maxNumJugadores);
        $this->incluirProducto($juego);
    }

    public function incluirSocio($nombre, $numero, $maxAlquilerConcurrente = 3) {
        $socio = new Cliente($nombre, $numero, $maxAlquilerConcurrente);
        $this->socios[] = $socio;
        $this->numSocios++;
    }

    public function listarProductos() {
        foreach ($this->productos as $producto) {
            $producto->muestraResumen();
        }
    }

    public function listarSocios() {
        foreach ($this->socios as $socio) {
            $socio->muestraResumen();
        }
    }

    public function alquilarSocioProducto($numeroCliente, $numeroSoporte) {
       try{
         if (!isset($this->socios[$numeroCliente])) {
            throw new ClienteNoEncontradoException("Cliente no encontrado.");
        }

        if (!isset($this->productos[$numeroSoporte])) {
            throw new SoporteNoEncontradoException("Soporte no encontrado.");
        }
        $cliente = $this->socios[$numeroCliente];
        $soporte = $this->productos[$numeroSoporte];
        $cliente->alquilar($soporte);

        $this->numProductosAlquilados++;
        $this->numTotalAlquileres++;

        return $this;


    }catch (ClienteNoEncontradoException $e) {
        echo "Error: " . $e->getMessage() . "<br>";

    } catch (SoporteNoEncontradoException $e) {
        echo "Error: " . $e->getMessage() . "<br>";

    } catch (SoporteYaAlquiladoException $e) {
        echo "Error: " . $e->getMessage() . "<br>";

    } catch (CupoSuperadoException $e) {
        echo "Error: " . $e->getMessage() . "<br>";
    }

    return $this;

    }

    public function devolverSocioProducto($numeroCliente, $numeroSoporte) {
        try {
            if (!isset($this->socios[$numeroCliente])) {
                throw new ClienteNoEncontradoException("Cliente no encontrado.");
            }

            if (!isset($this->productos[$numeroSoporte])) {
                throw new SoporteNoEncontradoException("Soporte no encontrado.");
            }

            $cliente = $this->socios[$numeroCliente];
            $soporte = $this->productos[$numeroSoporte];
            $cliente->devolver($numeroSoporte);
            
            $this->numProductosAlquilados--;
            
            return $this;
            
        } catch (ClienteNoEncontradoException $e) {
            echo "Error: " . $e->getMessage() . "\n";
            
        } catch (SoporteNoEncontradoException $e) {
            echo "Error: " . $e->getMessage() . "\n";
            
        } catch (SoporteYaAlquiladoException $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
        
        return $this;
    }

    public function getNumProductosAlquilados() {
        return $this->numProductosAlquilados;
    }

    public function getNumTotalAlquileres() {
        return $this->numTotalAlquileres;
    }

    public function alquilarSocioProductos(int $numSocio, array $numerosProductos) {
        try {
            if (!isset($this->socios[$numSocio])) {
                throw new ClienteNoEncontradoException("Cliente no encontrado.");
            }

            foreach ($numerosProductos as $numProducto) {
                if (!isset($this->productos[$numProducto])) {
                    throw new SoporteNoEncontradoException("El soporte con número $numProducto no existe.");
                }
                if ($this->productos[$numProducto]->alquilado) {
                    throw new SoporteYaAlquiladoException("El soporte con número $numProducto ya está alquilado.");
                }
            }

            $cliente = $this->socios[$numSocio];
            foreach ($numerosProductos as $numProducto) {
                $soporte = $this->productos[$numProducto];
                $cliente->alquilar($soporte);
                $this->numProductosAlquilados++;
                $this->numTotalAlquileres++;
            }
            
            echo "Alquiler completado exitosamente para el cliente $numSocio.\n";
            return $this;

        } catch (ClienteNoEncontradoException $e) {
            echo "Error: " . $e->getMessage() . "\n";

        } catch (SoporteNoEncontradoException $e) {
            echo "Error: " . $e->getMessage() . "\n";

        } catch (SoporteYaAlquiladoException $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }

        return $this;
    }

    public function devolverSocioProductos(int $numSocio, array $numerosProductos) {
        try {
            if (!isset($this->socios[$numSocio])) {
                throw new ClienteNoEncontradoException("Cliente no encontrado.");
            }

            foreach ($numerosProductos as $numeroProducto) {
                if (!isset($this->productos[$numeroProducto])) {
                    throw new SoporteNoEncontradoException("Soporte con número $numeroProducto no encontrado.");
                }

                $soporte = $this->productos[$numeroProducto];
                $cliente = $this->socios[$numSocio];
                $cliente->devolver($numeroProducto);

                if ($soporte->alquilado) {
                    $soporte->alquilado = false;
                    $this->numProductosAlquilados--;
                    echo "Producto devuelto: " . $soporte->getNumero() . " por el cliente $numSocio.\n";
                }
            }

            return $this;

        } catch (ClienteNoEncontradoException $e) {
            echo "Error: " . $e->getMessage() . "\n";

        } catch (SoporteNoEncontradoException $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }

        return $this;
    }





}
?>
