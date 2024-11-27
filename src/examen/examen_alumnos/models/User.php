<?php

class User
{
    private $conn;
    private $table_name = "Users";

    public $id;
    public $username;
    public $role;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Verifica si las credenciales son correctas, devuelve true or false, guarda en $this los atributos
    public function login($username, $password)
    {
        $pdo = $this->conn;
        //verificamos si las credenciales son correctas
        // if ($username == null || $password == null) {
        //     return -1;
        // }

        $sql = "SELECT `id`, `username`, `password`, `role` FROM $this->table_name WHERE username = :username";
        // hay que acceder a la tabla correspondiente y verificar el usuario y su contraseña
        $sentencia = $pdo->prepare($sql);
        $sentencia->bindparam("username", $username);
        $sentencia->execute();
        $resulset = $sentencia->fetch(PDO::FETCH_ASSOC);
        // CUIDADO! La contraseña está codificada, hay que utilizar password_verify()
        if ($resulset && password_verify($password, $resulset["password"])) {
            $this->id=$resulset["id"];
            $this->username=$resulset["username"];
            $this->role=$resulset["role"];
            return true;
        } else {
            return false;
        }
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
