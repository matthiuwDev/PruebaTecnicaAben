<?php
    /*Clase para acceder y ejecutar Consultas*/
    class Queries extends dbConnection{
        public function selectTasks(){
            /*Consulta para OBTENER todas las tareas*/
            $sqlt = dbConnection::connection()->prepare("SELECT * FROM tasks");

            $sqlt -> execute();

            /*Traemos Info de tareas desde la DB*/
            return $array = $sqlt -> fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>