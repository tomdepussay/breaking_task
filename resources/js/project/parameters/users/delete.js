document.addEventListener('click', function (e){
    let button = e.target.closest('.btn-delete-users');
    if(!button) return;

    let user_id = button.getAttribute('data-user-id');
    let project_id = document.getElementById('project_id').value;

    fetch(`${usersRoutes.delete}?project_id=${project_id}&user_id=${user_id}`)
        .then(response => {
            if (!response.ok) throw new Error('Erreur lors du chargement du modal');
            return response.text();
        })
        .then(data => {
            let modal = document.getElementById('deleteUsers');
            modal.innerHTML = data;
            modal.style.display = "flex";
        })
        .catch(error => {
            console.log(error);
        })
})