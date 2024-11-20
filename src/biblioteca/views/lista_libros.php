

<table border="1">
    <tr>
        <th>Título</th>
        <th>Autor</th>
        <th>Género</th>
        <th>Fecha de Publicación</th>
    </tr>
    <?php foreach ($libros as $libro): ?>
        <tr>
            <td><?php echo htmlspecialchars($libro->titulo)?></td>
            <td><?php echo htmlspecialchars($libro->autor->nombre)?></td>
            <td><?php echo htmlspecialchars($libro->genero->nombre)?></td>
            <td><?php echo htmlspecialchars($libro->fecha_publicacion)?></td>
        </tr>
    <?php endforeach;?>
    <?php foreach ($listaUsuarios as $user): ?>
        <?
        var_dump($user["nombre"]);
        ?>
    <?php endforeach;?>

</table>