<?php

class Reservation
{
    private $conn;
    private $table_name = "Reservations";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function addReservation($user_id, $resource_id, $timeslot_id, $date)
    {
        try {
            //code...
            //Maitane: añadir reservas a la base de datos
            $sql = "INSERT INTO `Reservations`(`user_id`, `resource_id`, `timeslot_id`, `date`) VALUES (:user_id,:resource_id,:timeslot_id,:date)";
            //fijarse en el método siguiente getAllReservations
            $stmt = $this->conn->prepare($sql);
            $stmt->bindparam(":user_id", $user_id);
            $stmt->bindparam(":resource_id", $resource_id);
            $stmt->bindparam(":timeslot_id", $timeslot_id);
            $stmt->bindparam(":date", $date);
            $stmt->execute();
            return true;
            
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function getUserReservations($user_id)
    {
        //Maitane: obtener de la base de datos las reservas de un usuario en concreto 
        $sql = "SELECT r.id, u.username AS user_name, res.name AS resource_name, ts.start_time, ts.end_time, r.date
                  FROM Reservations r
                  JOIN Users u ON r.user_id = u.id
                  JOIN Resources res ON r.resource_id = res.id
                  JOIN TimeSlots ts ON r.timeslot_id = ts.id WHERE r.user_id = :user_id
                  ORDER BY r.date, ts.start_time";
        //fijarse en el método siguiente getAllReservations
        $stmt = $this->conn->prepare($sql);
        $stmt->bindparam("user_id", $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllReservations()
    {
        $query = "SELECT r.id, u.username AS user_name, res.name AS resource_name, ts.start_time, ts.end_time, r.date
                  FROM " . $this->table_name . " r
                  JOIN Users u ON r.user_id = u.id
                  JOIN Resources res ON r.resource_id = res.id
                  JOIN TimeSlots ts ON r.timeslot_id = ts.id
                  ORDER BY r.date, ts.start_time";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Eliminar($id_reserva)
    {
        $query = "DELETE FROM $this->table_name WHERE id=?";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id_reserva]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReservaById($id_reserva) {
                //Maitane: obtener de la base de datos las reservas de un usuario en concreto 
                $sql = "SELECT r.id, u.username AS user_name, res.name AS resource_name, ts.start_time, ts.end_time, r.date
                FROM Reservations r
                JOIN Users u ON r.user_id = u.id
                JOIN Resources res ON r.resource_id = res.id
                JOIN TimeSlots ts ON r.timeslot_id = ts.id WHERE r.id = :reserva_id
                ORDER BY r.date, ts.start_time";
      //fijarse en el método siguiente getAllReservations
      $stmt = $this->conn->prepare($sql);
      $stmt->bindparam("user_id", $id_reserva);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatereserva($user_id, $resource_id, $timeslot_id, $date,$id){
        $query = "UPDATE $this->table_name SET `user_id`=:user_id,`resource_id`=resource_id,`timeslot_id`=:timeslot_id,`date`=:date WHERE id = id:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(":user_id", $user_id);
        $stmt->bindparam(":resource_id", $resource_id);
        $stmt->bindparam(":timeslot_id", $timeslot_id);
        $stmt->bindparam(":date", $date);
        $stmt->bindparam(":id", $id);
        $stmt->execute();

    }
}
