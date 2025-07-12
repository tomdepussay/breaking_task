document.getElementById('deleteProject').addEventListener('click', function(e){
    let button = e.target.closest('.btn-destroy-project');
    if (!button) return;
    e.stopPropagation();
    e.preventDefault();

    let formData = new FormData();
    let project_id = document.getElementById('project_id').value;
    formData.append('id', project_id);

    fetch(projectRoutes.destroy, {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: formData
    })
        .then(response => {
            if (!response.ok) throw new Error("Erreur lors de la modification du projet");
            return response.json();
        })
        .then(data => {
            window.location.href = dashboard;
        })
        .catch(error => {
            console.log(error);
        })
})