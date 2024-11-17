<form method="POST">
    <br>
    <label>Titulo del libro:
        <select name="titulo">
            <?php foreach ($libros as $libro): ?>
                <option value="<?= $libro->titulo ?>"><?=
                    htmlspecialchars($libro->titulo) ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <br>
    <button type="submit">Eliminar Libro</button>
</form>
