document.addEventListener('click', function(e){
    if(e.target.id != 'btn-search') return;

    searchUsers();
})

window.searchUsers = function() {
    let search = document.getElementById('search').value;
    let project_id = document.getElementById('project_id').value;
    
    fetch(`${usersRoutes.search}?project_id=${project_id}&search=${search}`)
        .then(response => {
            if (!response.ok) throw new Error('Erreur lors du chargement du modal');
            return response.text();
        })
        .then(data => {
            let search_container = document.getElementById('search-container');
            search_container.innerHTML = data;
        })
        .catch(error => {
            console.log(error);
        })
}