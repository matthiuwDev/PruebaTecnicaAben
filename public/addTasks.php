<?php
require_once '../controllers/TaskController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];

    $taskController = new TaskController();
    $taskController->addTask($name);

    header("Location: ../index.html");
}
?>
