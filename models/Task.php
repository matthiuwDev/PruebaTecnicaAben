<?php
    /**
     * Modelo de Tareas. Este Modelo recibe los datos provenientes del Controlador 
     * y mediante la instancia creada de la base de datos, se encarga de interactuar
     * y hacer las respectivas consultas con los datos recibidos.
    */
require_once '../database/database.php';

class Task {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAllTasks() {
        $stmt = $this->db->prepare("SELECT * FROM tasks");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTask($name) {
        $stmt = $this->db->prepare("INSERT INTO tasks (name) VALUES (:name)");
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    public function updateTask($idTask, $name) {
        $stmt = $this->db->prepare("UPDATE tasks SET name = :name WHERE idTask = :idTask");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':idTask', $idTask);
        return $stmt->execute();
    }

    public function completeTask($idTask) {
        $stmt = $this->db->prepare("UPDATE tasks SET completed = 1 WHERE idTask = :idTask");
        $stmt->bindParam(':idTask', $idTask);
        return $stmt->execute();
    }

    public function deleteTask($idTask) {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE idTask = :idTask");
        $stmt->bindParam(':idTask', $idTask);
        return $stmt->execute();
    }
}
?>
