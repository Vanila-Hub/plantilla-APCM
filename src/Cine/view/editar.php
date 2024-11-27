<?php
require_once '../controler/PeliculasControler.php';
require_once '../model/Pelicula.php';

$id_pelicula = isset($_GET['id']) ? intval($_GET['id']) : null;

if (!$id_pelicula) {
    die("No se especificó una película válida.");
}

$pelicula = getPeliculaById($id_pelicula);


// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Obtener los datos del formulario y almacenarlos en un array
// Recibir los datos del formulario
$datos = [
    'id' => (int) $_GET['id'],
    'titulo' => $_POST['titulo'],
    'director' => $_POST['director'],
    'ano' => $_POST['año'],
    'genero' => $_POST['genero'],
    'descripcion' => $_POST['descripcion'],
    'imagen_url' => $_POST['imagen_url']
];

// Llamar a la función para actualizar la película
modificarPelicula($datos);

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar <?= htmlspecialchars($pelicula->titulo); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-4">Editar Película</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="" method="POST" class="row g-3">
            <div class="col-md-6">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" name="titulo" id="titulo" class="form-control" value="<?= htmlspecialchars($pelicula->titulo); ?>" required>
            </div>
            <div class="col-md-6">
                <label for="director" class="form-label">Director</label>
                <input type="text" name="director" id="director" class="form-control" value="<?= htmlspecialchars($pelicula->director); ?>" required>
            </div>
            <div class="col-md-4">
                <label for="año" class="form-label">Año</label>
                <input type="number" name="año" id="año" class="form-control" value="<?= htmlspecialchars($pelicula->año); ?>" required>
            </div>
            <div class="col-md-4">
                <label for="genero" class="form-label">Género</label>
                <input type="text" name="genero" id="genero" class="form-control" value="<?= htmlspecialchars($pelicula->genero); ?>" required>
            </div>
            <div class="col-md-12">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="4" class="form-control"><?= htmlspecialchars($pelicula->descripcion); ?></textarea>
            </div>
            <div class="col-md-12">
                <label for="imagen_url" class="form-label">URL de la Imagen</label>
                <input type="url" name="imagen_url" id="imagen_url" class="form-control" value="<?= htmlspecialchars($pelicula->imagen_url); ?>" required>
                <div class="text-center mt-3">
                    <img src="<?= htmlspecialchars($pelicula->imagen_url); ?>" alt="Imagen actual de <?= htmlspecialchars($pelicula->titulo); ?>" class="img-thumbnail" style="max-width: 200px;">
                </div>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
