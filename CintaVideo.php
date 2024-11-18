<?php
namespace Dwes\ProyectoVideoclub;
include_once "Soporte.php";

class CintaVideo extends Soporte {
    private $duracion;

    public function __construct($titulo, $numero, $precio, $duracion) {
        parent::__construct($titulo, $numero, $precio);
        $this->duracion = $duracion;
    }

    public function muestraResumen() {
        echo "<strong>{$this->titulo}</strong><br>";
        echo "Duración: {$this->duracion} minutos<br>";
    }
}
?>
