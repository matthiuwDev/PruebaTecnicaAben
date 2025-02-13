<?php
require_once '../controllers/TaskController.php';

$taskController = new TaskController();
$tasks = $taskController->getTasks();

echo json_encode($tasks);
?>
