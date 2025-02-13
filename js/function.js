taskForm = document.querySelector("#form"); 

/* Hacemos el envío de los datos */
taskForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const data = new FormData(document.getElementById('form'));

    const url = "./models/Task.php";

    fetch(url, {
        method: 'post',
        body: data
    })
    .then(async response => {
        if (!response.ok) {
            const text = await response.text();
            throw new Error(text);
        }
        return response.json(); //Parseamos la respuesta como un JSON
    })
    .then(data => {
        console.log('Success', data);

        showDataInTable(data);
        taskForm.reset();
    })
    .catch(function(error){
        console.log('error', error);
    });
});

//Función para mostrar los datos en la tabla
const showDataInTable = (data) => {
    let dataTable = document.querySelector("#tasksTable");

    dataTable.innerHTML = "";
    for(let item of data){
        dataTable.innerHTML += `
            <tr>
                <td>${item.name}</td>


                <td class='text-center'>
                    <button class='btn btn-primary btn-sm'>Editar</button>

                    <button class='btn btn-danger  btn-sm'>Eliminar</button>
                </td>
            </tr>
        `;
    }
}

