<?php
    /*Clase para acceder y ejecutar Consultas*/
    class TaskController extends dbConnection{
        //Método para Obtener todas las tareas
        public function selectTasks(){
            $sqlRead = dbConnection::connection()->prepare("SELECT * FROM tasks");

            $sqlRead -> execute();

            //Traemos Info de tareas desde la DB
            return $array = $sqlRead -> fetchAll(PDO::FETCH_ASSOC);
        }

        //Método para Crear una tarea
        public function createTask($name){
            $sqlCreate = dbConnection::connection()->prepare( "INSERT INTO  tasks(name) VALUES ('$name') ");

            if($sqlCreate -> execute()){
                //Si '$sqlCreate' se ejecuta con exito llamamos al método 'selectTask'
                $result = self::selectTasks();

                return $result;
            }
        }
    }
?> 