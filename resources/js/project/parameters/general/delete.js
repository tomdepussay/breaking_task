document.getElementById('btn-delete-project').addEventListener('click', function (e){
    let project_id = document.getElementById('project_id').value;

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