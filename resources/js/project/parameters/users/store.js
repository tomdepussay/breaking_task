document.addEventListener('click', function(e){
    let button = e.target.closest('.btn-store-users');
    if(!button) return;

    let project_id = document.getElementById('project_id').value;
    let user_id = button.getAttribute('data-user-id');

    let formData = new FormData;
    formData.append('project_id', project_id);
    formData.append('user_id', user_id);

    fetch(`${usersRoutes.store}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData,
    })
        .then(response => {
            if (!response.ok) throw new Error('Erreur lors du chargement du modal');
            return response.json();
        })
        .then(data => {
            reloadUsers();
            searchUsers();
        })
        .catch(error => {
            console.log(error);
        })
})