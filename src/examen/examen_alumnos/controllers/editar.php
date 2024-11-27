<?php
session_start();
require_once "../config/db.php";
require_once "../models/Reservation.php";
$database = new Database();
$db = $database->getConnection();
$reservation = new Reservation($db);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = (int) $_GET["id_reserva"];
    $user_id = (int) $_GET["user_id"];
    $timeslot_id = (int) $_GET["timeslot_id"];
    $resource_id = (int) $_GET["resource_id"];
    $date = $_GET["date"];

    $reservation->updatereserva($user_id, $resource_id, $timeslot_id, $date,$id);
    header("Location: ../views/resources.php");
}
