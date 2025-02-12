<?php

    /*Configuración Base de datos*/
    const SERVER = "localhost";
    const DB = "taskmanagerdb";
    const USER = "root";
    const PASS = "";
    const UTF8 = "utf8";

    const SGBD = "mysql:host=".SERVER.";dbname=".DB.";charset=".UTF8;

    class dbConnection{
        protected function connection(){
            $con = new PDO(SGBD, USER, PASS);

            return $con;
        }
    }
?>