document.addEventListener('click', function (e){
    let button = e.target.closest('.btn-destroy-users');
    if(!button) return;

    let user_id = button.getAttribute('data-user-id');
    let project_id = document.getElementById('project_id').value;

    let formData = new FormData;
    formData.append('project_id', project_id);
    formData.append('user_id', user_id);

    fetch(`${usersRoutes.destroy}`, {
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
            document.querySelector(".modal-close[data-modal='deleteUsers']").click();
        })
        .catch(error => {
            console.log(error);
        })
})