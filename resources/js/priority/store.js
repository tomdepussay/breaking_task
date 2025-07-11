document.addEventListener('click', function (e){
    let button = e.target.closest('.btn-store-priority');
    if(!button) return;

    let project_id = button.getAttribute('data-project-id');

    let form = document.getElementById('createPriorityForm');
    let name = form.name.value;

    let formData = new FormData;
    formData.append('project_id', project_id);
    formData.append('name', name);

    fetch(`${prioritiesRoutes.store}`, {
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
            window.location.reload();
            document.querySelector(".modal-close[data-modal='createPriority']").click();
        })
        .catch(error => {
            console.log(error);
        })
})