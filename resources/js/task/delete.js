document.addEventListener('click', function (e){
    let button = e.target.closest('.btn-delete-task');
    if(!button) return;

    let task_id = button.getAttribute('data-task-id');

    fetch(`${taskRoutes.delete}?task_id=${task_id}`)
        .then(response => {
            if (!response.ok) throw new Error('Erreur lors du chargement du modal task delete');
            return response.text();
        })
        .then(data => {
            let modal = document.getElementById('deleteTask');
            modal.innerHTML = data;
            modal.style.display = "flex";
        })
        .catch(error => {
            console.log(error);
        })
})