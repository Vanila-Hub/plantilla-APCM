<?php
require_once '../controler/PeliculasControler.php';
require_once '../model/Pelicula.php';

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario y almacenarlos en un array
    $datos = [
        'titulo' => $_POST['titulo'],
        'director' => $_POST['director'],
        'ano' => $_POST['año'],
        'genero' => $_POST['genero'],
        'descripcion' => $_POST['descripcion'],
        'imagen_url' => $_POST['imagen_url']
    ];

    // Llamar a la función para crear la nueva película
    if (crearPelicula($datos)) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Error al crear la película.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Nueva Película</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-4">Añadir Nueva Película</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="crear.php" method="POST" class="row g-3">
            <div class="col-md-6">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" name="titulo" id="titulo" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="director" class="form-label">Director</label>
                <input type="text" name="director" id="director" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="año" class="form-label">Año</label>
                <input type="number" name="año" id="año" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="genero" class="form-label">Género</label>
                <input type="text" name="genero" id="genero" class="form-control" required>
            </div>
            <div class="col-md-12">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="4" class="form-control" required></textarea>
            </div>
            <div class="col-md-12">
                <label for="imagen_url" class="form-label">URL de la Imagen</label>
                <input type="url" name="imagen_url" id="imagen_url" class="form-control" required>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Añadir Película</button>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
