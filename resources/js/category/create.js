document.addEventListener('click', function (e){
    let button = e.target.closest('.btn-create-category');
    if(!button) return;

    let project_id = button.getAttribute('data-project-id');

    fetch(`${categoriesRoutes.create}?project_id=${project_id}`)
        .then(response => {
            if (!response.ok) throw new Error('Erreur lors du chargement du modal');
            return response.text();
        })
        .then(data => {
            let modal = document.getElementById('createCategory');
            modal.innerHTML = data;
            modal.style.display = "flex";
        })
        .catch(error => {
            console.log(error);
        })
})