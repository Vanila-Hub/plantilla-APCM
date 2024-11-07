
<?php
include "Soporte.php";
include "CintaVideo.php";
include "Dvd.php";
include "Juego.php";


$soporte1 = new Soporte("Tenet", 22, 3); 
echo "<strong>" . $soporte1->titulo . "</strong><br>"; 
echo "Precio: " . $soporte1->getPrecio() . " euros<br>"; 
echo "Precio IVA incluido: " . $soporte1->getPrecioConIVA() . " euros<br>";
$soporte1->muestraResumen();

$miCinta = new CintaVideo("Los cazafantasmas", 23, 3.5, 107); 
echo "<strong>" . $miCinta->titulo . "</strong>"; 
echo "<br>Precio: " . $miCinta->getPrecio() . " euros"; 
echo "<br>Precio IVA incluido: " . $miCinta->getPrecioConIva() . " euros<br>";
$miCinta->muestraResumen();

$miDvd = new Dvd("Origen", 24, 15, "es,en,fr", "16:9"); 
echo "<strong>" . $miDvd->titulo . "</strong>"; 
echo "<br>Precio: " . $miDvd->getPrecio() . " euros"; 
echo "<br>Precio IVA incluido: " . $miDvd->getPrecioConIva() . " euros<br>";
$miDvd->muestraResumen();


$miJuego = new Juego("The Last of Us Part II", 26, 49.99, "PS4", 1, 1); 
echo "<strong>" . $miJuego->titulo . "</strong>"; 
echo "<br>Precio: " . $miJuego->getPrecio() . " euros"; 
echo "<br>Precio IVA incluido: " . $miJuego->getPrecioConIva() . " euros<br>";
$miJuego->muestraResumen();


?>