document.addEventListener('click', function (e){
    let button = e.target.closest('.btn-update-priority');
    if(!button) return;

    let priority_id = button.getAttribute('data-priority-id');

    let form = document.getElementById('editPriorityForm');
    let name = form.name.value;

    let formData = new FormData;
    formData.append('priority_id', priority_id);
    formData.append('name', name);

    fetch(`${prioritiesRoutes.update}`, {
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
            document.querySelector(".modal-close[data-modal='updatePriority']").click();
        })
        .catch(error => {
            console.log(error);
        })
})