<?php
// views/resources.php
session_start();

require_once "../config/db.php";
require_once "../models/Resource.php";
require_once "../models/TimeSlot.php";



// Conectar a la base de datos
$database = new Database();
$db = $database->getConnection();

// Instanciar modelos
$resource = new Resource($db);
$timeslot = new TimeSlot($db);

// Obtener todos los recursos y horarios disponibles
$resources = $resource->getAll();
// Maitane: AÑADIR para obetener todos los recursos y horarios, 
$timeslots = $timeslot->getAll();
//Hay que fijarse en el formulario de abajo para ver cómo obtener los datos

echo "<h2>Reservar Recursos</h2>";
echo "<a href='reservations.php'>Mis Reservas</a> | ";
echo "<a href='logout.php'>Cerrar Sesión</a><br><br>";

if ($_SERVER["REQUEST_METHOD"]=="GET") {
    $message = isset($_GET['message'])?$_GET['message']:"";
    $error = isset($_GET['error'])?$_GET['error']:"";
}
// Formulario para hacer una nueva reserva
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reservar Recursos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php echo "<h1 style:'red'>$error</h1>"?>
<?php echo "<h1 style:'red'>$message</h1>"?>
<!-- Maitane: CAMBIAR la pagina a la que se redirige para procesar el form -->
<form action="../controllers/reservation.php" method="POST"> 
    <label for="resource_id">Recurso:</label>
    <select name="resource_id" id="resource_id" required>
        <option value="">Seleccione un recurso</option>
        <?php foreach ($resources as $res) { ?>
            <option value="<?php echo $res['id']; ?>"><?php echo $res['name'] . " - " . $res['type'] . " (" . $res['location'] . ")"; ?></option>
        <?php } ?>
    </select><br><br>

    <label for="timeslot_id">Horario:</label>
    <select name="timeslot_id" id="timeslot_id" required>
        <option value="">Seleccione un horario</option>
        <?php foreach ($timeslots as $slot) { ?>
            <option value="<?php echo $slot['id']; ?>"><?php echo $slot['start_time'] . " - " . $slot['end_time']; ?></option>
        <?php } ?>
    </select><br><br>

    <label for="date">Fecha:</label>
    <input type="date" name="date" id="date" required><br><br>

    <button type="submit">Reservar</button>
</form>
</body>
</html>

