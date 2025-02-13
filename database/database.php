<?php 
        const SERVER="localhost";
        const DB="TASKMANAGERDB";
        const USER="root";
        const PASS="";
        const UTF8="utf8";
        const SGBD= "mysql:host=".SERVER.";dbname=".DB.";charset=".UTF8;
        class dbConnection{
            
            protected function connection()
            {
                $con = new PDO(SGBD,USER,PASS);
                return $con;
            }
        }
    
    ?>