document.getElementById('columns-container').addEventListener('click', function(e){
    let button = e.target.closest('.btn-create-task');
    if (!button) return;
    e.stopPropagation();
    e.preventDefault();
    
    let column_id = button.dataset.columnId;
    
    fetch(`${taskRoutes.create}?column_id=${column_id}`)
        .then(response => {
            if (!response.ok) throw new Error('Erreur lors du chargement du modal');
            return response.text();
        })
       .then(data => {
            let modal = document.getElementById('createTask');
            modal.innerHTML = data;
            modal.style.display = "flex";
        })
       .catch(error => {
            console.log(error);
        })
})