<?php

require_once "../database/database.php";
require_once "../controllers/TaskController.php";

$queryType = $_POST["operation"];

switch ($queryType) {
    case 'create':
        $name = $_POST['name'];
        $query = new TaskController();
        $execute = $query->createTask($name); 
        echo json_encode($execute);

        break;

    default:
        break;
}

?>