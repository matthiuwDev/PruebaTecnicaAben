<?php
    /**
     * Script PHP para Agregar una nueva tarea a través de una solicitud POST.
     * Recibe datos JSON con el nombre de la tarea y los transmite al controlador.
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

        //Validamos que 'name' existe y no está vacío para asegurar que se reciba un nombre válido
        if (!isset($data["name"]) || empty($data["name"])) {
            throw new Exception("Nombre de tarea requerido");
        }

        //Creamos instancia del Controlador de tareas
        $taskController = new TaskController();

        //Llamamos al método 'addTask' del controlador para guardar la tarea.
        $success = $taskController->addTask($data["name"]);

        //Respondemos con un JSON indicando el éxito o fallo de la operación.
        //"success": true si la tarea se agregó correctamente, false en caso contrario.
        echo json_encode(["success" => $success]);
        exit;

    } catch (Exception $e) {
        //Capturamos cualquier excepción que ocurra durante el proceso.
        http_response_code(500);
        echo json_encode(["success" => false, "message" => $e->getMessage()]); //Devolvemos un mensaje de error en formato JSON.
        exit;
    }
}
?>