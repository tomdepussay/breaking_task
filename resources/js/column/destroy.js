document.addEventListener('click', function (e){
    let button = e.target.closest('.btn-destroy-column');
    if(!button) return;

    let column_id = button.getAttribute('data-column-id');

    let formData = new FormData;
    formData.append('column_id', column_id);

    fetch(`${columnRoutes.destroy}`, {
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
            document.querySelector(".modal-close[data-modal='deleteColumn']").click();
        })
        .catch(error => {
            console.log(error);
        })
})