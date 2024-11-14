<form method="POST">
    <label>Título: <input type="text" name="titulo"
            required></label><br>
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
    <label>Fecha de Publicación: <input type="date"
            name="fecha_publicacion" required></label><br>
    <button type="submit">Agregar Libro</button>
</form>