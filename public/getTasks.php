<?php
    /**
     * Script PHP para obtener las tareas a través de una solicitud GET.
     *
     * @return JSON Lista de tareas en formato JSON.
     *               Ejemplo:
     *               [
     *                   {"id": 1, "name": "Tarea 1", "completed": 0},
     *                   ...
     *               ]
    */

require_once '../controllers/TaskController.php';

$taskController = new TaskController();

try {
    $tasks = $taskController->getTasks();

    //Devolvemos la lista de tareas en formato JSON con un código de estado 200 (OK).
    http_response_code(200);
    echo json_encode($tasks);

} catch (Exception $e) {
    //En caso de error, devolvemos un código de estado 500 (Error interno del servidor)
    //y un mensaje de error en formato JSON.
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>