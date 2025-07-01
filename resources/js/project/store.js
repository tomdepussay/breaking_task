document.getElementById('btnStoreProject').addEventListener('click', function(){
    let form = document.getElementById("createProjectForm");
    let name = form.name.value;

    let formData = new FormData();
    formData.append('name', name);

    fetch(projectRoutes.store, {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: formData
    })
        .then(response => {
            if (!response.ok) throw new Error("Erreur lors de l'ajout du projet");
            return response.json();
        })
        .then(data => {
            reloadProjects();
            form.reset();
            document.querySelector(".modal-close[data-modal='createProject']").click();
        })
        .catch(error => {
            console.log(error);
        })
});