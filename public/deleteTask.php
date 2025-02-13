<?php
require_once '../controllers/TaskController.php';

if (isset($_GET["idTask"])) {
    $idTask = $_GET["idTask"];

    $taskController = new TaskController();
    $taskController->deleteTask($idTask);

    header("Location: ../views/index.html");
}
?>
