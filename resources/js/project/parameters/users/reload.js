window.reloadUsers = function(){
    let project_id = document.getElementById('project_id').value;

    fetch(`${usersRoutes.index}?project_id=${project_id}`)
        .then(response => {
            if (!response.ok) throw new Error('Erreur lors de la récupération des données');
            return response.text();
        })
        .then(data => {
            let container = document.getElementById('users-container');
            container.innerHTML = data;
        })
        .catch(error => {
            console.log(error);
        })
}