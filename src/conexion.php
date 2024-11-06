<?php
$host = 'plantilla-apcm-db-1'; //php y mysql están en contenedores separados entonces se usa el nombre del contenedor donde esta mysql
$db   = 'pruebadb'; //poner el nombre de la BD que esta en phpmyadmin
$user = 'usuario'; 
$pass = '1234';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //se lanzan excepciones si algo sale mal
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //los resultados de las consultas se devuelven como arrays asociativos, las claves de los arrays son los nombre de las columnas
    PDO::ATTR_EMULATE_PREPARES   => false, //las consultas preparadas se envían directamente a MySQL sin ser emuladas por PHP
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options); //se crea la conexion con los datos
    echo "Conexión exitosa.";

} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

?>