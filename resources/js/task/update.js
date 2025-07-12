document.addEventListener('click', function (e) {
    console.log('start update task');

    let button = e.target.closest('.btn-update-task');
    if (!button) return;

    let task_id = button.getAttribute('data-task-id');

    let form = document.getElementById("editTaskForm");
    let name = form.name.value;
    let description = form.description.value;
    let column_id = form.column_id.value;
    let category_id = form.category_id.value;
    let priority_id = form.priority_id.value;
    let deadline_at = form.deadline_at.value;

    let formData = new FormData();

    formData.append('task_id', task_id);
    formData.append('name', name);
    formData.append('description', description);
    formData.append('column_id', column_id);
    formData.append('category_id', category_id);
    formData.append('priority_id', priority_id);
    formData.append('deadline_at', deadline_at);

    console.log('formData', formData);

    fetch(`${taskRoutes.update}`, {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: formData
    })
        .then(response => {
            if (!response.ok) throw new Error("Erreur lors de la mise à jour de la tâche");
            return response.json();
        })
        .then(data => {
            window.location.reload();
            document.querySelector(".modal-close[data-modal='updateTask']").click();
        })
        .catch(error => {
            console.log(error);
        });
});

    