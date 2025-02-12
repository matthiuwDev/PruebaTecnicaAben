<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <main>
        <div class="container">
            <section class="mt-4">
                <h1>Lista de Tareas</h1>
                <form action="">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Ingresa el nombre de la tarea">
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-info btn-block">Agregar</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>

        <div class="container mt-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr></tr>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>