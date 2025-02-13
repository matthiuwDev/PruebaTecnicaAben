<?php
require_once '../controllers/TaskController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idTask = $_POST["idTask"];
    $name = $_POST["name"];

    $taskController = new TaskController();
    $taskController->updateTask($idTask, $name);

    header("Location: ../index.html");
}
?>
