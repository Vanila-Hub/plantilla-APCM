<?php
// classes/Database.php
require_once 'db.php';
class Database
{
    private static $instance = null;
    private $pdo;
    private function __construct()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host=" . "plantilla-apcm-db-1" . ";dbname=" . "peliculas_favoritas" .
                    ";charset=utf8",
                "root",
                "1234"
            );
            $this->pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $e) {
            die("Error en la conexión: " . $e->getMessage());
        }
    }
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}
