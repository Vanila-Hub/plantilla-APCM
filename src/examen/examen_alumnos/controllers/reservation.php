<?php
session_start();
require_once "../config/db.php";
require_once "../models/Reservation.php";



$database = new Database();
$db = $database->getConnection();
$reservation = new Reservation($db);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['id'];
    $resource_id = $_POST['resource_id'];
    $timeslot_id = $_POST['timeslot_id'];
    $date = $_POST['date'];

    // hacer la reserva y mostrar mensaje correspondiente
    if ($reservation->addReservation($user_id, $resource_id, $timeslot_id, $date)) {
        header("Location: ../views/resources.php?message=Reserva realizada con éxito.");
    } else {
        header("Location: ../views/resources.php?error=Error al realizar la reserva. Puede que el recurso ya esté reservado en ese horario.");
    }
}
?>
