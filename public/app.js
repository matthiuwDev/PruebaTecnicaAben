document.addEventListener('DOMContentLoaded', async() => {
    try {
        await fetchTasks();
    } catch (error) {
        console.error('Error al cargar las tareas:', error);
        Swal.fire('Error', 'No se pudieron cargar las tareas.', 'error');
    }

    document.getElementById('task-form').addEventListener('submit', async (event) => {
        event.preventDefault();
        await addTask();
    });
});

//Función genérica para peticiones fetch. Esta función es llamada desde las funciones CRUD, las cuales envían parámetros como la URL, Formato HTTP y Cuerpo. Usando estos parámetros se hace la solicitud, se procesa y devuelve la respuesta.
async function request(url, method = 'GET', body = null) {
    const options = {
        method,
        headers: { 'Content-Type': 'application/json' }
    };

    if (body) {
        options.body = JSON.stringify(body);
    }

    try {
        const response = await fetch(url, options);
        const data = await response.json();

        if (!response.ok) {
            throw new Error(`Error ${response.status}: ${data.message || 'Error desconocido'}`);
        }

        return data;
    } catch (error) {
        console.error(`Error en la solicitud a ${url}:`, error.message);
        Swal.fire('Error', `No se pudo completar la acción: ${error.message}`, 'error');
        return null;
    }
}


//Función asíncrona para Obtener las tareas y mostrarlas en el index.HTML
async function fetchTasks() {
    const tasks = await request('public/getTasks.php');
    if (!tasks || tasks.length === 0) {
        document.getElementById('task-list').innerHTML = `<tr><td colspan="2" class="text-center">No hay tareas disponibles</td></tr>`;
        return;
    }

    document.getElementById('task-list').innerHTML = tasks.map(task => `
        <tr>

        <!-- Verificamos si el atributo es true (1), y en caso de serlo asignamos la clase 'completed' -->
        <!-- Así mismo, este atributo determina la interactividad de los botones -->
        <!-- Si el atributo es true, deshabilitamos los botones ya que la tarea ya está completada -->

            <td class="${task.completed ? 'completed' : ''}">${task.name}</td>
            <td>
                <button class="btn btn-warning me-2" onclick="${task.completed ? '' : `updateTask(${task.idTask}, '${task.name.replace(/'/g, "\\'")}')`}" ${task.completed ? 'disabled' : ''}>Actualizar</button>
                
                <button class="btn btn-success me-2" onclick="${task.completed ? '' : `completeTask(${task.idTask})`}" ${task.completed ? 'disabled' : ''}>Completar</button>
                <button class="btn btn-danger" onclick="deleteTask(${task.idTask})">Eliminar</button>
            </td>
        </tr>
    `).join('');
}



//Función para Crear una tarea
//Al presionar el botón "Agregar", se desactiva el comportamiento por defecto del navegador y se hace...
//un llamado a esta función
async function addTask() {
    const taskInput = document.getElementById('task');
    const task = taskInput.value.trim();

    if (!task) return alert('Ingresa una tarea válida.');

    const result = await request('public/addTasks.php', 'POST', { name: task });

    if (result?.success) {
        Swal.fire({
            title: 'Tarea Agregada',
            text: '¡Bien hecho!',
            icon: 'success',
            timer: 1500,
            showConfirmButton: false
        });
        fetchTasks();
    } else {
        Swal.fire('Error', 'No se pudo completar la tarea.', 'error');
    }
}




//Función para Actualizar una tarea
async function updateTask(idTask, currentName) {
    const { value: newName } = await Swal.fire({
        title: 'Editar tarea',
        input: 'text',
        inputLabel: 'Nombre de la tarea',
        inputValue: currentName,
        showCancelButton: true,
        confirmButtonColor: "#ffc107",
        confirmButtonText: 'Actualizar',
        cancelButtonText: 'Cancelar',
        inputValidator: (value) => {
            if (!value.trim()) {
                return 'El nombre no puede estar vacío';
            }
        }
    });

    if (!newName) return;

    const result = await request('public/updateTask.php', 'POST', { idTask, name: newName });

    if (result?.success) {
        Swal.fire('Éxito', `Tarea actualizada a: "${newName}"`, 'success');
        fetchTasks();
    } else {
        Swal.fire('Error', 'No se pudo actualizar la tarea', 'error');
    }
}




//Función para Completar una tarea
async function completeTask(idTask) {
    const result = await request(`public/completeTask.php?idTask=${idTask}`);
    if (result?.success) {
        Swal.fire({
            title: 'Tarea completada',
            text: '¡Bien hecho!',
            icon: 'success',
            timer: 1500,
            showConfirmButton: false
        });
        fetchTasks();
    }
}


//Función para Eliminar tarea
async function deleteTask(idTask) {
    const confirmDelete = await Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6e7881',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    });

    if (!confirmDelete.isConfirmed) return;

    const result = await request(`public/deleteTask.php?idTask=${idTask}`, 'GET');

    if (result?.success) {
        Swal.fire('Eliminado', 'La tarea fue eliminada correctamente.', 'success');
        fetchTasks();
    }
}
