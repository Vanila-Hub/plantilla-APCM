<?php
// Datos de conexión a la base de datos
$host = 'localhost'; // O el nombre de tu host
$db   = 'nombre_de_bd'; // Nombre de la base de datos
$user = 'usuario'; // Usuario de la base de datos
$pass = 'contraseña'; // Contraseña
$charset = 'utf8mb4'; // Codificación

// DSN (Data Source Name) para PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opciones de PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Crear una instancia PDO
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Conexión exitosa.";
} catch (\PDOException $e) {
    // Manejo de errores
    echo "Error de conexión: " . $e->getMessage();
}
?>

<!-- Inserción de datos en la base de datos -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $nombre = $_GET["nombre"] ?? "Maria";
    $apellidos = $_GET["apellidos"] ?? "Lopez";
    $telefono = $_GET["telefono"] ?? "636123456";

    // SQL para insertar datos
    $sql = "INSERT INTO persona(nombre, apellidos, telefono) VALUES (:nombre, :apellidos, :telefono)";

    $sentencia = $pdo->prepare($sql);
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":apellidos", $apellidos);
    $sentencia->bindParam(":telefono", $telefono);

    // Ejecutar la sentencia
    $isOk = $sentencia->execute();

    // Obtener el último ID insertado
    $idGenerado = $pdo->lastInsertId();
    echo "ID generado: " . $idGenerado;
}
?>

<!-- Eliminación de datos de la base de datos -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = "Manuel"; // Nombre a eliminar

    $sql = "DELETE FROM persona WHERE nombre = :name";
    $sentencia = $pdo->prepare($sql);
    $sentencia->bindParam(":name", $nombre);

    // Ejecutar la eliminación
    $isOk = $sentencia->execute();

    // Obtener el número de filas afectadas
    $cantidadAfectada = $sentencia->rowCount();
    echo "Filas eliminadas: " . $cantidadAfectada;
}
?>

<!-- Actualización de datos en la base de datos -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"] ?? "Juan";
    $usuario = $_POST["usuario"] ?? "juan123";
    $password = $_POST["password"] ?? "1234";
    $maxAlquilerConcurrente = $_POST["maxAlquilerConcurrente"] ?? 3;
    $id = $_POST["id"] ?? 1;

    $sql = "UPDATE clientes SET nombre = :nombre, usuario = :usuario, password = :password, maxAlquilerConcurrente = :maxAlquilerConcurrente WHERE id = :id";
    $sentencia = $pdo->prepare($sql);

    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);
    $sentencia->bindParam(":maxAlquilerConcurrente", $maxAlquilerConcurrente);
    $sentencia->bindParam(":id", $id);

    // Ejecutar la actualización
    $isOk = $sentencia->execute();
}
?>

<!-- Selección de datos de la base de datos -->
<?php
$sql = "SELECT * FROM persona";
$sentencia = $pdo->prepare($sql);
$sentencia->setFetchMode(PDO::FETCH_CLASS, "Cliente"); // Devuelve los resultados como objetos de la clase Cliente
$sentencia->execute();

// Mostrar los resultados
while ($t = $sentencia->fetch()) {
    echo "Nombre: " . $t->nombre . "<br />";
    echo "Teléfono: " . $t->telefono . "<br />";
}
?>

<!-- Hashing y verificación de contraseñas -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['enviar'])) {
        $usuario = $_POST['inputUsuario'];
        $password = $_POST['inputPassword'];

        // Insertar usuario con la contraseña hasheada
        $sql = "INSERT INTO usuarios(usuario, password) VALUES (:usuario, :password)";
        $sentencia = $pdo->prepare($sql);

        // Hashear la contraseña antes de guardarla
        $isOk = $sentencia->execute([
            "usuario" => $usuario,
            "password" => password_hash($password, PASSWORD_DEFAULT) // Contraseña hasheada
        ]);

        if ($isOk) {
            echo "Usuario creado correctamente.";
        }
    }
}
?>

<!-- Verificación de contraseñas (Deshacer el Hash) -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['enviar'])) {
        $usuario = $_POST['inputUsuario'];
        $password = $_POST['inputPassword'];

        // Consultar el usuario desde la base de datos
        $sql = "SELECT * FROM usuarios WHERE usuario = ?";
        $sentencia = $pdo->prepare($sql);
        $sentencia->execute([$usuario]);

        // Obtener los datos del usuario
        $usuario = $sentencia->fetch();

        // Verificar si la contraseña es correcta
        if ($usuario && password_verify($password, $usuario['password'])) {
            echo "Inicio de sesión exitoso.";
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    }
}
?>

<!-- Manejo de sesiones -->
<?php
session_start(); // Inicia la sesión
session_destroy();
// Comprobar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php'); // Redirigir al login si no está logueado
    exit();
}
?>
