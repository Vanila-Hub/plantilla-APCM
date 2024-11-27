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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Gill Sans', 'Calibri';
            background-color: #f9f9f9;
            margin: 0;
            padding: 10px;
        }
        table {
            width: 30%;
            margin: auto;
            border-collapse: collapse;
            font-size: 0.9rem;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 5px;
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
            max-width: 60px;
            height: auto;
            display: block;
        }
        .actions a {
            text-decoration: none;
            margin: 0 3px;
            font-size: 1rem;
        }
        .actions a.view {
            color: #0d6efd;
        }
        .actions a.edit {
            color: #ffc107;
        }
        .actions a.delete {
            color: #dc3545;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h1 class="text-center">Lista de Películas</h1>

    <?php if (!empty($peliculas)): ?>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Año</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($peliculas as $pelicula): ?>
                    <tr>
                        <td><?= htmlspecialchars($pelicula->titulo); ?></td>
                        <td><?= htmlspecialchars($pelicula->año); ?></td>
                        <td>
                            <img src="<?= htmlspecialchars($pelicula->imagen_url); ?>" alt="Poster de <?= htmlspecialchars($pelicula->titulo); ?>">
                        </td>
                        <td class="actions">
                            <a href="ver.php?id=<?= htmlspecialchars($pelicula->id); ?>" class="view" title="Ver detalles">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a href="editar.php?id=<?= htmlspecialchars($pelicula->id); ?>" class="edit" title="Editar">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <a href="eliminar.php?id=<?= htmlspecialchars($pelicula->id); ?>" class="delete" title="Eliminar">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">No hay películas para mostrar.</p>
    <?php endif; ?>

    <div class="btn-container">
        <a href="crear.php" class="btn btn-success">Añadir Nueva Película</a>
    </div>

</body>
</html>
