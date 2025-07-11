document.addEventListener('click', function (e){
    let button = e.target.closest('.btn-quit-project');
    if(!button) return;

    let project_id = button.getAttribute('data-project-id');

    let formData = new FormData;
    formData.append('project_id', project_id);

    fetch(`${projectRoutes.quit}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: formData,
    })
        .then(response => {
            if (!response.ok) throw new Error('Erreur lors de la mise à jour');
            return response.json();
        })
        .then(data => {
            reloadProjects();
            document.querySelector(".modal-close[data-modal='leaveProject']").click();
        })
        .catch(error => {
            console.log(error);
        })
})