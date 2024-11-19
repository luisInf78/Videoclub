<?php
include_once "Soporte.php";

class Cliente {
    private $nombre;
    private $numero;
    private $maxAlquilerConcurrente;
    private $soportesAlquilados = [];

    public function __construct($nombre, $numero, $maxAlquilerConcurrente = 3) {
        $this->nombre = $nombre;
        $this->numero = $numero;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
    }

    public function alquilar(Soporte $soporte) {
        if (in_array($soporte, $this->soportesAlquilados)) {
            echo "El soporte ya está alquilado.<br>";
            return false;
        }
        if (count($this->soportesAlquilados) >= $this->maxAlquilerConcurrente) {
            echo "No puede alquilar más soportes.<br>";
            return false;
        }
        $this->soportesAlquilados[] = $soporte;
        echo "Soporte alquilado: {$soporte->titulo}<br>";
        return true;
    }

    public function devolver($numero) {
        foreach ($this->soportesAlquilados as $key => $soporte) {
            if ($soporte->numero == $numero) {
                unset($this->soportesAlquilados[$key]);
                echo "Soporte devuelto.<br>";
                return true;
            }
        }
        echo "El soporte no estaba alquilado.<br>";
        return false;
    }

    public function listaAlquileres() {
        echo "Soportes alquilados:<br>";
        foreach ($this->soportesAlquilados as $soporte) {
            echo "- {$soporte->titulo}<br>";
        }
    }
}
?>
