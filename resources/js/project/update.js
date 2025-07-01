document.getElementById('editProject').addEventListener('click', function(e){
    let button = e.target.closest('.btn-update-project');
    if (!button) return;
    e.stopPropagation();
    e.preventDefault();

    let form = document.getElementById("editProjectForm");
    let project_id = form.project_id.value;
    let name = form.name.value;

    let formData = new FormData();
    formData.append('id', project_id);
    formData.append('name', name);

    fetch(projectRoutes.update, {
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
            reloadProjects();
            form.reset();
            document.querySelector(".modal-close[data-modal='editProject']").click();
        })
        .catch(error => {
            console.log(error);
        })
})