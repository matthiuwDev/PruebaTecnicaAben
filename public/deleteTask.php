<?php
/**
 * Script PHP para eliminar una tarea a través de una solicitud GET.
 * Recibe el ID de la tarea y la elimina.
 *
 * @return JSON Respuesta con el estado de la operación (success: true/false).
 */

require_once '../controllers/TaskController.php';

if (isset($_GET["idTask"])) {
    try {
        $idTask = $_GET["idTask"];

        //Validamos el ID de la tarea
        if (!is_numeric($idTask) || $idTask <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'ID de tarea inválido']);
            exit();
        }

        //Instanciamos controlador y posteriormente llamamos su método y pasamos parámetro
        $taskController = new TaskController();
        $success = $taskController->deleteTask($idTask);

        //Configuramos el encabezado para devolver JSON e indicamos éxito o fallo de la operación
        header('Content-Type: application/json');
        echo json_encode(["success" => $success]);
        exit();

    } catch (Exception $e) {
        //Manejamos error del servidor
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        exit();
    }
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'ID de tarea requerido']);
    exit();
}
?>