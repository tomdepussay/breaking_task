document.addEventListener('click', function (e){
    let button = e.target.closest('.btn-destroy-priority');
    if(!button) return;

    let priority_id = button.getAttribute('data-priority-id');

    let formData = new FormData;
    formData.append('priority_id', priority_id);

    fetch(`${prioritiesRoutes.destroy}`, {
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
            if(!data.success){
                alert(data.message);
                return;
            }
            window.location.reload();
            document.querySelector(".modal-close[data-modal='deletePriority']").click();
        })
        .catch(error => {
            console.log(error);
        })
})