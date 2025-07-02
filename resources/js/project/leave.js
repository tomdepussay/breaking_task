document.addEventListener('click', function(e) {
    e.stopPropagation();
    e.preventDefault();

    let button = e.target.closest('.btn-leave-project');
    if(!button) return;

    let projectId = button.getAttribute('data-project-id');

    fetch(`${projectRoutes.leave}?project_id=${projectId}`)
        .then(response => {
            if (!response.ok) throw new Error("Erreur lors de la récupération des données");
            return response.text();
        })
        .then(data => {
            let modal = document.getElementById('leaveProject');
            modal.innerHTML = data;
            modal.style.display = 'flex';
        })
        .catch(error => {
            console.log(error);
        })
});