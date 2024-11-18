<?php
namespace Dwes\ProyectoVideoclub;

include_once "Soporte.php";

class Juego extends Soporte {
    private $consola;
    private $minNumJugadores;
    private $maxNumJugadores;

    public function __construct($titulo, $numero, $precio, $consola, $minNumJugadores, $maxNumJugadores) {
        parent::__construct($titulo, $numero, $precio);
        $this->consola = $consola;
        $this->minNumJugadores = $minNumJugadores;
        $this->maxNumJugadores = $maxNumJugadores;
    }

    public function muestraJugadoresPosibles() {
        if ($this->minNumJugadores === $this->maxNumJugadores) {
            echo "Para {$this->minNumJugadores} jugador(es)<br>";
        } else {
            echo "De {$this->minNumJugadores} a {$this->maxNumJugadores} jugadores<br>";
        }
    }

    public function muestraResumen() {
        echo "<strong>{$this->titulo}</strong><br>";
        echo "Consola: {$this->consola}<br>";
        $this->muestraJugadoresPosibles();
    }
}
?>
