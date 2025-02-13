<?php
require_once '../controllers/TaskController.php';

if (isset($_GET["idTask"])) {
    $idTask = $_GET["idTask"];

    $taskController = new TaskController();
    $success = $taskController->completeTask($idTask);

    // Configurar el encabezado para devolver JSON
    header('Content-Type: application/json');

    // Devolver la respuesta JSON
    echo json_encode(['success' => $success, 'completed' => 1]);
}
?>
