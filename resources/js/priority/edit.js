document.addEventListener('click', function (e){
    let button = e.target.closest('.btn-edit-priority');
    if(!button) return;

    let priority_id = button.getAttribute('data-priority-id');

    fetch(`${prioritiesRoutes.edit}?priority_id=${priority_id}`)
        .then(response => {
            if (!response.ok) throw new Error('Erreur lors du chargement du modal');
            return response.text();
        })
        .then(data => {
            let modal = document.getElementById('editPriority');
            modal.innerHTML = data;
            modal.style.display = "flex";
        })
        .catch(error => {
            console.log(error);
        })
})