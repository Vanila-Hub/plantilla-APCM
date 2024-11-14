<form method="POST">
    <br>
    <label>Autor:
        <select name="id_autor">
            <?php foreach ($autores as $autor): ?>
                <option value="<?= $autor->id ?>"><?=
                                                    htmlspecialchars($autor->nombre) ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Género:
        <select name="id_genero">
            <?php foreach ($generos as $genero): ?>
                <option value="<?= $genero->id ?>"><?=
                                                    htmlspecialchars($genero->nombre) ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <br>
    <button type="submit">buscar Libro</button>
</form>

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
</table>