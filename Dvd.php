<?php
include_once "Soporte.php";

class Dvd extends Soporte {
    private $idiomas;
    private $formatoPantalla;

    public function __construct($titulo, $numero, $precio, $idiomas, $formatoPantalla) {
        parent::__construct($titulo, $numero, $precio);
        $this->idiomas = $idiomas;
        $this->formatoPantalla = $formatoPantalla;
    }

    public function muestraResumen() {
        echo "<strong>{$this->titulo}</strong><br>";
        echo "Idiomas: {$this->idiomas}<br>";
        echo "Formato de pantalla: {$this->formatoPantalla}<br>";
    }
}
?>
