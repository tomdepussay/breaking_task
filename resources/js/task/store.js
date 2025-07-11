document.getElementById('createTask').addEventListener('click', function (e) {
    let button = e.target.closest('.btn-store-task');
    if (!button) return;

    let form = document.getElementById("createTaskForm");
    let name = form.name.value;
    let description = form.description.value;
    let column_id = form.column_id.value;
    let category_id = form.category_id.value;
    let priority_id = form.priority_id.value;
    let due_date = form.due_date.value;

    let formData = new FormData();
    let project_id = document.querySelector('.project-name').id;

    formData.append('name', name);
    formData.append('description', description);
    formData.append('column_id', column_id);
    formData.append('category_id', category_id);
    formData.append('priority_id', priority_id);
    formData.append('deadline_at', due_date);
    formData.append('project_id', project_id);

    fetch(taskRoutes.store, {
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
            let modal = document.getElementById('createTask');
            modal.style.display = 'none';

            let column_id = data.column_id;
            
            reloadColumn(column_id);
            reloadDayCalendar(project_id);
            reloadWeekCalendar(project_id);
            reloadMonthCalendar(project_id);
        })
        .catch(error => {
            console.log(error);
        })
})