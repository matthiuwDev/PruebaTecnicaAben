<?php
//Configuración de la base de datos
class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $this->conn = new PDO("mysql:host=localhost;dbname=taskmanagerdb", "root", "");
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
}
?>