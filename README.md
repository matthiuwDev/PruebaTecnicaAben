# Todo List (Prueba Técnica)

### Pre-requisitos 📋

_Herramientas necesarias para el correcto funcionamiento:_

```
Xampp
```

## Instalación ⚙️


1. Descargar Xampp 

2. Clonar proyecto en la carpeta C:\xampp\htdocs

3. Acceder al Panel de Control de Xampp Activar Apache y MySQL

4. Dirigirse a la url _http://localhost/phpmyadmin/_ en el navegador

5. Ejecutar Script SQL:

   ```
    -- -----------------------------------------------------
    -- Schema taskmanagerdb
    -- -----------------------------------------------------
    CREATE SCHEMA IF NOT EXISTS `taskmanagerdb` DEFAULT CHARACTER SET utf8mb4 ;
    USE `taskmanagerdb` ;
    
    -- -----------------------------------------------------
    -- Table `taskmanagerdb`.`tasks`
    -- -----------------------------------------------------
    CREATE TABLE IF NOT EXISTS `taskmanagerdb`.`tasks` (
      `idTask` INT(11) NOT NULL AUTO_INCREMENT,
      `name` VARCHAR(200) NOT NULL,
      `completed` TINYINT(1) NULL DEFAULT 0,
      PRIMARY KEY (`idTask`))
    ENGINE = InnoDB
    AUTO_INCREMENT = 16
    DEFAULT CHARACTER SET = utf8mb4;
    
    INSERT INTO tasks (idTask, name) VALUES (1, `Enviar Prueba Técnica`);
   ```

6. Finalmente, acceder a la URL: _http://localhost/PruebaTecnicaAben/index.html_ donde se encontrará en ToDoList

## Construido con 🛠️


* ![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)
* ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white) 
* ![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white) 


