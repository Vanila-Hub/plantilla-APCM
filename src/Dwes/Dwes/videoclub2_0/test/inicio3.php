<?php
require_once __DIR__ . '/../autoload.php';


use Dwes\videoclub2_0\Videoclub;
use Dwes\videoclub2_0\Cliente;


$vc = new Videoclub("Clase 2DAW3"); 

//voy a incluir unos cuantos soportes de prueba 
$vc->incluirJuego("God of War III",1, 19.99, "PS4", 1, 1); 
$vc->incluirJuego("The Last of Us Part II",2, 49.99, "PS4", 1, 1);
$vc->incluirDvd("Torrente",3, 4.5, "es","16:9"); 
$vc->incluirDvd("Origen",4, 4.5, "es,en,fr", "16:9"); 
$vc->incluirDvd("El Imperio Contraataca",5, 3, "es,en","16:9"); 
$vc->incluirCintaVideo("Los cazafantasmas",6, 3.5, 107); 
$vc->incluirCintaVideo("El nombre de la Rosa",7, 1.5, 140); 

//listo los productos 
$vc->listarProductos(); 

//voy a crear algunos socios 
$vc->incluirSocio("Amancio Ortega",1); 
$vc->incluirSocio("Pablo Picasso", 1,2); 

$vc->alquilarSocioProducto(1,2)->alquilarSocioProducto(1,3); 
//alquilo otra vez el soporte 2 al socio 1. 
// no debe dejarme porque ya lo tiene alquilado 
$vc->alquilarSocioProducto(1,2); 
//alquilo el soporte 6 al socio 1. 
//no se puede porque el socio 1 tiene 2 alquileres como máximo 
$vc->alquilarSocioProducto(1,6); 

//listo los socios 
$vc->listarSocios();

