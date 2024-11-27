<?php
session_start();
require_once "../config/db.php";
require_once "../models/Reservation.php";
$database = new Database();
$db = $database->getConnection();
$reservation = new Reservation($db);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id_reserva = (int) $_GET["id_reserva"];
    $reservation->Eliminar($id_reserva);
   header("Location: ../views/resources.php?message=Reserva Eliminada con éxito.");
}
