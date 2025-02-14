<?php
/**
 * Script PHP para actualizar una tarea a través de una solicitud POST.
 * Recibe datos JSON con el id y nombre de la tarea y los transmite al controlador.
 *
 * @return JSON Respuesta con el estado de la operación (success: true/false).
 */

require_once '../controllers/TaskController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        //Obtenemos los datos JSON del cuerpo de la solicitud.
        $json = file_get_contents("php://input");

        //Decodificamos el JSON a un array asociativo.
        $data = json_decode($json, true);

        //Validamos la existencia y formato de los datos.
        if (!isset($data["idTask"]) || !is_numeric($data["idTask"]) || $data["idTask"] <= 0) {
            http_response_code(400); 
            echo json_encode(["success" => false, "message" => "ID de tarea inválido"]);
            exit();
        }

        if (!isset($data["name"]) || empty($data["name"])) {
            http_response_code(400); 
            echo json_encode(["success" => false, "message" => "Nombre de tarea requerido"]);
            exit();
        }

        //Creamos instancia del Controlador de tareas y hacemos llamado del método 'updateTask'.
        $taskController = new TaskController();

        //Llamamos al método 'updateTask' y pasamos parámetros
        $success = $taskController->updateTask($data["idTask"], $data["name"]);

        //Respondemos con un JSON indicando el éxito o fallo de la operación.
        header('Content-Type: application/json');
        echo json_encode(["success" => $success]);
        exit();

    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => $e->getMessage()]); //Devolvemos un mensaje de error en formato JSON.
        exit;
    }
}
?>