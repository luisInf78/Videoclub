<?php
include_once "Videoclub.php";
include_once "CintaVideo.php";
include_once "Dvd.php";
include_once "Juego.php";
include_once "Cliente.php";

$vc = new Videoclub("Severo 8A");

// Incluir productos
$vc->incluirJuego("God of War", 19.99, "PS4", 1, 1);
$vc->incluirJuego("The Last of Us Part II", 49.99, "PS4", 1, 1);
$vc->incluirDvd("Torrente", 4.5, "es", "16:9");
$vc->incluirDvd("Origen", 4.5, "es,en,fr", "16:9");
$vc->incluirDvd("El Imperio Contraataca", 3, "es,en", "16:9");
$vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107);
$vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140);

// Listar productos
$vc->listarProductos();

// Crear socios
$vc->incluirSocio("Amancio Ortega");
$vc->incluirSocio("Pablo Picasso", 2);

// Realizar alquileres
$vc->alquilaSocioProducto(1, 2);
$vc->alquilaSocioProducto(1, 3);
$vc->alquilaSocioProducto(1, 2); // No debería permitir repetir
$vc->alquilaSocioProducto(1, 6); // No debería permitir por cupo

// Listar socios
$vc->listarSocios();
?>
