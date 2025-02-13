document.addEventListener('DOMContentLoaded', function() {
    fetchTasks();

    const form = document.getElementById('task-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();  
        addTask();
    });
});

function fetchTasks() {
    fetch('public/getTasks.php')
        .then(response => response.json())
        .then(tasks => {
            const taskList = document.getElementById('task-list');
            taskList.innerHTML = '';
            tasks.forEach(task => {
                const tr = document.createElement('tr');

                const tdName = document.createElement('td');
                tdName.textContent = task.name;
                tr.appendChild(tdName);

                const tdActions = document.createElement('td');

                const updateButton = document.createElement('button');
                updateButton.textContent = 'Actualizar';
                updateButton.classList.add('btn', 'btn-warning', 'me-2');
                updateButton.addEventListener('click', () => updateTask(task.idTask));
                tdActions.appendChild(updateButton);

                const completeButton = document.createElement('button');
                completeButton.textContent = 'Completar';
                completeButton.classList.add('btn', 'btn-success', 'me-2');
                completeButton.addEventListener('click', () => completeTask(task.idTask));
                tdActions.appendChild(completeButton);

                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Eliminar';
                deleteButton.classList.add('btn', 'btn-danger');
                deleteButton.addEventListener('click', () => deleteTask(task.idTask));
                tdActions.appendChild(deleteButton);

                tr.appendChild(tdActions);
                taskList.appendChild(tr);
            });
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}

function addTask() {
    const taskInput = document.getElementById('task');
    const task = taskInput.value;

    fetch('public/addTasks.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `name=${task}`,
    })
    .then(() => {   
        taskInput.value = '';
        fetchTasks();  
    })
} 

function updateTask(idTask) {
    const newTask = prompt('Ingrese la nueva tarea:');
    if (newTask) {
        fetch('public/updateTask.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `idTask=${idTask}&name=${newTask}`,
        })
        .then(() => {
            fetchTasks();
        });
    }
}


function completeTask(idTask) {
    fetch(`public/completeTask.php?idTask=${idTask}`, {
        method: 'GET',
    })
    .then(() => {
        fetchTasks();
    });
}

function deleteTask(idTask) {
    fetch(`public/deleteTask.php?idTask=${idTask}`, {
        method: 'GET',
    })
    .then(() => {
        fetchTasks();
    });
}
