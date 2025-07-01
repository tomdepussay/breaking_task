document.getElementById('projects-container').addEventListener('click', function (e){
    let button = e.target.closest('.btn-edit-project');
    if (!button) return;

    e.stopPropagation();
    e.preventDefault();

    let project_id = button.dataset.projectId;

    fetch(`${projectRoutes.edit}?id=${project_id}`)
        .then(response => {
            if (!response.ok) throw new Error('Erreur lors du chargement du modal');
            return response.text();
        })
        .then(data => {
            let modal = document.getElementById('editProject');
            modal.innerHTML = data;
            modal.style.display = "flex";
        })
        .catch(error => {
            console.log(error);
        })
})