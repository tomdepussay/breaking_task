document.addEventListener('click', function (e){
    let button = e.target.closest('.btn-edit-column');
    if(!button) return;

    let column_id = button.getAttribute('data-column-id');

    fetch(`${columnRoutes.edit}?column_id=${column_id}`)
        .then(response => {
            if (!response.ok) throw new Error('Erreur lors du chargement du modal');
            return response.text();
        })
        .then(data => {
            let modal = document.getElementById('editColumn');
            modal.innerHTML = data;
            modal.style.display = "flex";
        })
        .catch(error => {
            console.log(error);
        })
})