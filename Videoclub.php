<?php
namespace Dwes\ProyectoVideoclub;

use Dwes\ProyectoVideoclub\Util\ClienteNoEncontradoException;
use Dwes\ProyectoVideoclub\Util\SoporteNoEncontradoException;

include_once "Soporte.php";
include_once "Cliente.php";

class Videoclub {
    private $nombre;
    private $productos = [];
    private $socios = [];
    private $ultimoProductoId = 0;
    private $ultimoSocioId = 0;
    private $numProductosAlquilados = 0;
    private $numTotalAlquileres = 0;

    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    public function getNumProductosAlquilados() {
        return $this->numProductosAlquilados;
    }
    
    public function getNumTotalAlquileres() {
        return $this->numTotalAlquileres;
    }

    private function incluirProducto(Soporte $producto) {
        $this->productos[++$this->ultimoProductoId] = $producto;
    }

    public function incluirCintaVideo($titulo, $precio, $duracion) {
        $this->incluirProducto(new CintaVideo($titulo, $this->ultimoProductoId + 1, $precio, $duracion));
    }

    public function incluirDvd($titulo, $precio, $idiomas, $formatoPantalla) {
        $this->incluirProducto(new Dvd($titulo, $this->ultimoProductoId + 1, $precio, $idiomas, $formatoPantalla));
    }

    public function incluirJuego($titulo, $precio, $consola, $minJugadores, $maxJugadores) {
        $this->incluirProducto(new Juego($titulo, $this->ultimoProductoId + 1, $precio, $consola, $minJugadores, $maxJugadores));
    }

    public function listarProductos() {
        echo "Productos disponibles en el videoclub:<br>";
        foreach ($this->productos as $id => $producto) {
            echo "{$id}. {$producto->titulo} - Precio: {$producto->getPrecio()} euros<br>";
        }
    }

    public function incluirSocio($nombre, $maxAlquileres = 3) {
        $this->socios[++$this->ultimoSocioId] = new Cliente($nombre, $this->ultimoSocioId, $maxAlquileres);
    }

    public function alquilaSocioProducto(int $idSocio, int $idProducto) {
        try {
            $cliente = $this->socios[$idSocio] ?? throw new ClienteNoEncontradoException("Cliente no encontrado.");
            $producto = $this->productos[$idProducto] ?? throw new SoporteNoEncontradoException("Producto no encontrado.");
            $cliente->alquilar($producto);
            $this->numProductosAlquilados++;
            $this->numTotalAlquileres++;
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        }
        return $this; // Encadenamiento
    }

    public function alquilarSocioProductos(int $idSocio, array $productosIds) {
        foreach ($productosIds as $idProducto) {
            if ($this->productos[$idProducto]->alquilado) {
                echo "El producto $idProducto ya está alquilado.<br>";
                return $this; // No alquilamos nada si uno no está disponible
            }
        }
        foreach ($productosIds as $idProducto) {
            $this->alquilaSocioProducto($idSocio, $idProducto);
        }
        return $this;
    }
    
    public function devolverSocioProducto(int $idSocio, int $idProducto) {
        $this->socios[$idSocio]->devolver($idProducto);
        $this->productos[$idProducto]->alquilado = false;
        return $this;
    }
    
    public function devolverSocioProductos(int $idSocio, array $productosIds) {
        foreach ($productosIds as $idProducto) {
            $this->devolverSocioProducto($idSocio, $idProducto);
        }
        return $this;
    }
    

    public function listarSocios() {
        echo "Listado de socios del videoclub:<br>";
        foreach ($this->socios as $id => $socio) {
            echo "ID: {$id} - Nombre: {$socio->nombre}<br>";
            $socio->listaAlquileres();
        }
    }

}
?>
