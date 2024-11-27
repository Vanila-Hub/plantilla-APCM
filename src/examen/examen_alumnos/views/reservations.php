<?php
// views/reservations.php
session_start();

require_once "../config/db.php";
require_once "../models/Reservation.php";



// Conectar a la base de datos
$database = new Database();
$db = $database->getConnection();
$reservation = new Reservation($db);

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Mis Reservas</title>
    <link rel='stylesheet' href='style.css'>
</head>
<body>
    <div class='container'>
        <h2>Reservas</h2>
        <a href='resources.php'>Volver a Recursos</a> | 
        <a href='logout.php'>Cerrar Sesión</a><br><br>";

// Obtener y mostrar reservas

//Maitane: si es admin puede ver todas las reservas
if ($_SESSION["role"]=="admin") {
    $reservations = $reservation->getAllReservations();
}else{
    $reservations = $reservation->getUserReservations($_SESSION['id']);
}
// Si es usuario solo puede ver sus reservas (mirar Reservation.php)
//Pista: mirar como se guarda la sesión


// Mostrar las reservas en una tabla
if (!empty($reservations)) {
    echo "<table border='1'>";
    echo "<tr>
            <th>ID Reserva</th>
            <th>Usuario</th>
            <th>Recurso</th>
            <th>Horario</th>
            <th>Fecha</th>
          </tr>";
    
    foreach ($reservations as $res) {
        echo "<tr>
                <td>{$res['id']}</td>
                <td>{$res['user_name']}</td>
                <td>{$res['resource_name']}</td>
                <td>{$res['start_time']} - {$res['end_time']}</td>
                <td>{$res['date']}</td>
                <td><a href='../controllers/eliminar.php?id_reserva={$res['id']}'>Eliminar</a><br><br></td>
                <td><a href='form_editar.php?id_reserva={$res['id']}'>Editar</a><br><br></td>
              </tr>";
    }
    
    echo "</table>";
} else {
    echo "<p>No hay reservas disponibles.</p>";
}

echo "</div></body></html>";
?>
