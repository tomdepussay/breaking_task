document.getElementById('projects-container').addEventListener('click', function (e){
    let button = e.target.closest('.btn-delete-project');
    if (!button) return;

    e.stopPropagation();
    e.preventDefault();

    let project_id = button.dataset.projectId;

    fetch(`${projectRoutes.delete}?id=${project_id}`)
        .then(response => {
            if (!response.ok) throw new Error('Erreur lors du chargement du modal');
            return response.text();
        })
        .then(data => {
            let modal = document.getElementById('deleteProject');
            modal.innerHTML = data;
            modal.style.display = "flex";
        })
        .catch(error => {
            console.log(error);
        })
})