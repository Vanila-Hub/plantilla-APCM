<?
session_start();
require_once '../clases/Usuario.php';
require_once '../clases/Libro.php';
$row = $_SESSION['usuario'];
$libros = Libro::obtenerTodos();
$usuario = new Usuario($row["id"], $row["user"], $row["password"], $row["nombre"], $row["apellidos"], $row["id_libro_alquilado"], $row["fecha"]);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USUARio</title>
</head>

<body>

    <h1> <?php echo "Bienvenido   " . $usuario->nombre ?></h1>
    <?php
    $alquileres = $usuario->getAlquilados($usuario->id);
    foreach ($alquileres as $alquiler) {
        echo "<h1>$alquiler->titulo</h1>";
    }
    echo "<h1>ALQUILAR LIBROS</h1>";
    foreach ($libros as $libro) {
        echo "<a href='alquilar.php?id_libro=$libro->id&id_usuario=$usuario->id&fecha=2024-01-01'><h1>$libro->titulo</h1></a>";
    }
    ?>
</body>

</html>