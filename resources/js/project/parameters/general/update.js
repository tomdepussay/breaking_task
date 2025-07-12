document.getElementById('btn-update-project').addEventListener('click', function() {
    let project_id = document.getElementById('project_id').value;
    let project_name = document.getElementById('input_project_name').value;

    let formData = new FormData;
    formData.append('id', project_id);
    formData.append('name', project_name);

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
            document.getElementById('project_name').innerText = data.project.name;
            document.getElementById('input_project_name').value = data.project.name;
        })
        .catch(error => {
            console.log(error);
        })
});