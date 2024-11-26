<?php

class Resource
{
    private $conn;
    private $table_name = "Resources";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        // Maitane: coger todos los datos de la table de la base datos
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOne($id_reserva)
    {
        // Maitane: coger todos los datos de la table de la base datos
        $query = "SELECT * FROM " . $this->table_name. "WHERE id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
