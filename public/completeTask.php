<?php
require_once '../controllers/TaskController.php';

if (isset($_GET["idTask"])) {
    $idTask = $_GET["idTask"];

    $taskController = new TaskController();
    $taskController->completeTask($idTask);

    header("Location: ../index.html");
}
?>

