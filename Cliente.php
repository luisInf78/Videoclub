<?php

namespace Dwes\ProyectoVideoclub;

use Dwes\ProyectoVideoclub\Util\SoporteYaAlquiladoException;
use Dwes\ProyectoVideoclub\Util\CupoSuperadoException;
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
            throw new SoporteYaAlquiladoException("El soporte ya está alquilado.");
        }
        if (count($this->soportesAlquilados) >= $this->maxAlquilerConcurrente) {
            throw new CupoSuperadoException("No se puede alquilar más soportes.");
        }
        $this->soportesAlquilados[] = $soporte;
        $soporte->alquilado = true;
        return $this; // Encadenamiento
    }

    public function devolver(int $numero) {
        foreach ($this->soportesAlquilados as $key => $soporte) {
            if ($soporte->numero == $numero) {
                unset($this->soportesAlquilados[$key]);
                $soporte->alquilado = false;
                return $this; // Encadenamiento
            }
        }
        throw new SoporteNoEncontradoException("El soporte no estaba alquilado.");
    }

    public function listaAlquileres() {
        echo "Soportes alquilados:<br>";
        foreach ($this->soportesAlquilados as $soporte) {
            echo "- {$soporte->titulo}<br>";
        }
    }
}
?>
