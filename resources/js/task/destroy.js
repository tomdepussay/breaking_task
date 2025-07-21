document.addEventListener('click', function (e){
    let button = e.target.closest('.btn-destroy-task');
    if(!button) return;

    let task_id = button.getAttribute('data-task-id');

    let formData = new FormData;
    formData.append('task_id', task_id);

    fetch(`${taskRoutes.destroy}`, {
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
            document.querySelector(".modal-close[data-modal='destroyTask']").click();
        })
        .catch(error => {
            console.log(error);
        })
})