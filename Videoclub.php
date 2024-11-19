<?php
include_once "Soporte.php";
include_once "Cliente.php";

class Videoclub {
    private $nombre;
    private $productos = [];
    private $socios = [];
    private $ultimoProductoId = 0;
    private $ultimoSocioId = 0;

    public function __construct($nombre) {
        $this->nombre = $nombre;
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

    public function alquilaSocioProducto($idSocio, $idProducto) {
        if (!isset($this->socios[$idSocio])) {
            echo "El socio con ID {$idSocio} no existe.<br>";
            return;
        }

        if (!isset($this->productos[$idProducto])) {
            echo "El producto con ID {$idProducto} no existe.<br>";
            return;
        }

        $this->socios[$idSocio]->alquilar($this->productos[$idProducto]);
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
