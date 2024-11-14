<?php
require_once("../public/index.php");
var_dump($libros);
foreach ($libros as $libro) {
    var_dump($libro::titulo);
    $row =  "<tr>";
    $row +=  "<td>".$libro::titulo."</td>";
    $row +=  "<td>".$libro::autor::nombre."</td>";
    $row +=  "<td>".$libro::genero::nombre."</td>";
    $row +=  "<td>".$libro::fecha_publicacion."</td></tr>";
}
?>

<table border="1">
    <tr>
        <th>Título</th>
        <th>Autor</th>
        <th>Género</th>
        <th>Fecha de Publicación</th>
    </tr>

</table>