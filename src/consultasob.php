<?php

require_once 'conexion.php'; //centralizamos la conexion puesto que es siempre la misma

$sql = "select * from persona";

$sentencia = $pdo -> prepare($sql);
$sentencia -> setFetchMode(PDO::FETCH_OBJ);
$sentencia -> execute();

    while($t = $sentencia -> fetch()) {
        echo"Id:" . $t -> id . "<br />";
        echo"Nombre:" . $t -> nombre . "<br />";
        echo"Apellidos:" . $t -> apellidos . "<br />";
        echo"Teléfono:" . $t -> telefono . "<br />";
    }