document.addEventListener('click', function (e){
    let button = e.target.closest('.btn-store-column');
    if(!button) return;

    let project_id = button.getAttribute('data-project-id');

    let form = document.getElementById('createColumnForm');
    let name = form.name.value;
    let begin_end = form.begin_end.value;
    let begin_column = 0;
    let end_column = 0;

    if(begin_end == 'begin_column'){
        begin_column = 1;
    } else if(begin_end == 'end_column'){
        end_column = 1;
    }

    let formData = new FormData;
    formData.append('project_id', project_id);
    formData.append('name', name);
    formData.append('begin_column', begin_column);
    formData.append('end_column', end_column);

    fetch(`${columnRoutes.store}`, {
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
            document.querySelector(".modal-close[data-modal='createColumn']").click();
        })
        .catch(error => {
            console.log(error);
        })
})