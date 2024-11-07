<?php

require_once __DIR__ . '/../autoload.php';

use Dwes\videoclub2_0\app\Videoclub;

$videoclub = new Videoclub("Mi Videoclub");

$videoclub ->incluirCintaVideo("Star Wars",0, 10, 120);
$videoclub ->incluirDvd("Matrix",1, 15, "Inglés, Español", "16:9");
$videoclub ->incluirJuego("FIFA 2022",2, 60, "PS5", 1, 4);
$videoclub ->incluirSocio("Juan Pérez",0);
$videoclub ->incluirSocio("María López",1);

// Intentar alquilar múltiples productos
$videoclub->alquilarSocioProductos(0, [0, 1, 2]); // Juan Pérez intenta alquilar Star Wars, Matrix, y FIFA 2022

// Alquilar productos de nuevo, pero uno ya estará alquilado
$videoclub->alquilarSocioProductos(1, [1, 2]); // María López intenta alquilar Matrix y FIFA 2022 (Matrix ya estará alquilado)

$videoclub->devolverSocioProducto(0, 0); // Juan Pérez devuelve Star Wars

$videoclub->devolverSocioProductos(0, [1, 2]); // Juan Pérez intenta devolver Matrix y FIFA 2022


?>
