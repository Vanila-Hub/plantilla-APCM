<?php
require_once '../controler/PeliculasControler.php';
require_once '../model/Pelicula.php';

// Obtener todas las películas
$peliculas = getPeliculas();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Películas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #4CAF50;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table tr:hover {
            background-color: #ddd;
        }
        img {
            max-width: 100px;
            height: auto;
            display: block;
        }
    </style>
</head>
<body>

    <h1>Lista de Películas</h1>

    <?php if (!empty($peliculas)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Director</th>
                    <th>Año</th>
                    <th>Género</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($peliculas as $pelicula): ?>
                    <tr>
                        <td><?= htmlspecialchars($pelicula->id); ?></td>
                        <td><?= htmlspecialchars($pelicula->titulo); ?></td>
                        <td><?= htmlspecialchars($pelicula->director); ?></td>
                        <td><?= htmlspecialchars($pelicula->año); ?></td>
                        <td><?= htmlspecialchars($pelicula->genero); ?></td>
                        <td><?= htmlspecialchars($pelicula->descripcion); ?></td>
                        <td>
                            <img src="<?= htmlspecialchars($pelicula->imagen_url); ?>" alt="Poster de <?= htmlspecialchars($pelicula->titulo); ?>">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay películas para mostrar.</p>
    <?php endif; ?>

</body>
</html>
