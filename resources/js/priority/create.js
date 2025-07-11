document.addEventListener('click', function (e){
    let button = e.target.closest('.btn-create-priority');
    if(!button) return;

    let project_id = button.getAttribute('data-project-id');

    fetch(`${prioritiesRoutes.create}?project_id=${project_id}`)
        .then(response => {
            if (!response.ok) throw new Error('Erreur lors du chargement du modal');
            return response.text();
        })
        .then(data => {
            let modal = document.getElementById('createPriority');
            modal.innerHTML = data;
            modal.style.display = "flex";
        })
        .catch(error => {
            console.log(error);
        })
})