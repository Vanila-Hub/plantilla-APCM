<?php

$file = "miarchivo.txt";
$fp = fopen($file, "r");

// filesize() nos devuelve el tamaño del archivo en cuestión
$contents = fread($fp, filesize($file)); //se pone el archivo al que se accede y cuanto queremos leer


// Cerramos la conexión con el archivo
fclose($fp);

echo $contents;