<?php
require_once "config/db.php";

// Crear conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Generar hashes de contraseñas con password_hash
$admin_password = password_hash('admin123', PASSWORD_DEFAULT);
$user1_password = password_hash('user123', PASSWORD_DEFAULT);
$user2_password = password_hash('user456', PASSWORD_DEFAULT);

// Insertar usuarios
$db->exec("INSERT INTO Users (username, password, role) VALUES
    ('admin', '$admin_password', 'admin'),
    ('user1', '$user1_password', 'user'),
    ('user2', '$user2_password', 'user')
");

// Insertar recursos
$db->exec("INSERT INTO Resources (name, type, location) VALUES
    ('Proyector 1', 'Proyector', 'Sala A'),
    ('Proyector 2', 'Proyector', 'Sala B'),
    ('Ordenador 1', 'Ordenador', 'Sala C'),
    ('Sala de Reunión 1', 'Sala', 'Edificio 1'),
    ('Sala de Reunión 2', 'Sala', 'Edificio 2')
");

// Insertar horarios
$db->exec("INSERT INTO TimeSlots (start_time, end_time) VALUES
    ('09:00:00', '10:00:00'),
    ('10:00:00', '11:00:00'),
    ('11:00:00', '12:00:00'),
    ('14:00:00', '15:00:00'),
    ('15:00:00', '16:00:00')
");

// Insertar reservas de prueba
$db->exec("INSERT INTO Reservations (user_id, resource_id, timeslot_id, date) VALUES
    (2, 1, 1, '2024-11-07'), -- user1 reserva Proyector 1 de 09:00 a 10:00
    (3, 2, 2, '2024-11-07'), -- user2 reserva Proyector 2 de 10:00 a 11:00
    (2, 3, 3, '2024-11-08'), -- user1 reserva Ordenador 1 de 11:00 a 12:00
    (3, 4, 4, '2024-11-08')  -- user2 reserva Sala de Reunión 1 de 14:00 a 15:00
");

echo "Datos de prueba insertados correctamente.";
?>
