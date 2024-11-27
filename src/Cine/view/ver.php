<?php
require_once '../controler/PeliculasControler.php';
require_once '../model/Pelicula.php';

$id_pelicula = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($id_pelicula === null) {
    echo "No se especificó una película.";
    exit;
}

$pelicula = getPeliculaById($id_pelicula);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pelicula->titulo); ?> - Detalles</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4"><?= htmlspecialchars($pelicula->titulo); ?></h1>
            </div>
        </div>
        <div class="row g-4">
            <!-- Imagen -->
            <div class="col-md-4">
                <img src="<?= htmlspecialchars($pelicula->imagen_url); ?>" alt="Poster de <?= htmlspecialchars($pelicula->titulo); ?>" class="img-fluid rounded shadow">
            </div>
            <!-- Información -->
            <div class="col-md-8">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Título:</strong> <?= htmlspecialchars($pelicula->titulo); ?></li>
                    <li class="list-group-item"><strong>Director:</strong> <?= htmlspecialchars($pelicula->director); ?></li>
                    <li class="list-group-item"><strong>Año:</strong> <?= htmlspecialchars($pelicula->año); ?></li>
                    <li class="list-group-item"><strong>Género:</strong> <?= htmlspecialchars($pelicula->genero); ?></li>
                    <li class="list-group-item"><strong>Descripción:</strong> <?= htmlspecialchars($pelicula->descripcion); ?></li>
                </ul>
            </div>
        </div>
        <!-- Botones de acción -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="index.php" class="btn btn-secondary">Volver</a>
                <a href="editar.php?id=<?= $pelicula->id; ?>" class="btn btn-primary">Editar</a>
                <a href="eliminar.php?id=<?= $pelicula->id; ?>" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta película?');">Eliminar</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
