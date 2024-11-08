<?php
include("Persona.php");

require_once 'conexion.php'; //centralizamos la conexion puesto que es siempre la misma

  $sql = "select * from persona";

$sentencia = $pdo -> prepare($sql);
$sentencia -> setFetchMode(PDO::FETCH_CLASS,"Persona");
$sentencia -> execute();

while($t = $sentencia -> fetch()) {
    echo "<br />Id: " . $t -> getId() . "<br />";
    echo "Nombre: " . $t -> getNombre() . "<br />";
    echo "Apellidos: " . $t -> getApellidos() . "<br />";
    echo "Teléfono: " . $t -> getTelefono() . "<br />";
    print_r($t);
}