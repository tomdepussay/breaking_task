document.addEventListener('click', function (e){
    let button = e.target.closest('.btn-sort-column');
    if(!button) return;

    let direction = button.getAttribute('data-sort');
    let column_id = button.getAttribute('data-column-id');

    let formData = new FormData;
    formData.append('column_id', column_id);
    formData.append('direction', direction);

    fetch(`${columnRoutes.sort}`, {
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
        })
        .catch(error => {
            console.log(error);
        })
})