<?php

require_once 'conexion.php'; //centralizamos la conexion puesto que es siempre la misma

$sql = "select * from persona";

$sentencia = $pdo -> prepare($sql);
//$sentencia -> setFetchMode(PDO::FETCH_ASSOC); //ya lo hemos declarado en la conexion
$sentencia -> execute();

//fila por fila
 /*while($fila = $sentencia -> fetch()){ //aqui se hace fila por fila
    print_r($fila);
    echo "<br />";
    echo "Id:" . $fila["id"] . "<br />";
    echo "Nombre:" . $fila["nombre"] . "<br />";
    echo "Apellidos:" . $fila["apellidos"] . "<br />";
    echo "Teléfono:" . $fila["telefono"] . "<br />";
        } */


$personas = $sentencia -> fetchAll(); //se guardan todas las personas como si fuera una matriz
print_r($personas);
foreach($personas as $persona){
    echo "Id:" . $persona["id"] . "<br />";
    echo "Nombre:" . $persona["nombre"] . "<br />";
    echo "Apellidos:" . $persona["apellidos"] . "<br />";
    echo "Teléfono:" . $persona["telefono"] . "<br />";
} 