<?php
require_once '../models/Task.php';

class TaskController {
    private $taskModel;

    public function __construct() {
        $this->taskModel = new Task();
    }

    public function getTasks() {
        return $this->taskModel->getAllTasks();
    }

    public function addTask($name) {
        return $this->taskModel->addTask($name);
    }

    public function updateTask($idTask, $name) {
        return $this->taskModel->updateTask($idTask, $name);
    }

    public function completeTask($idTask) {
        return $this->taskModel->completeTask($idTask);
    }

    public function deleteTask($idTask) {
        return $this->taskModel->deleteTask($idTask);
    }
}
?>
