document.addEventListener('click', function (e){
    let button = e.target.closest('.btn-delete-column');
    if(!button) return;

    let column_id = button.getAttribute('data-column-id');

    fetch(`${columnRoutes.delete}?column_id=${column_id}`)
        .then(response => {
            if (!response.ok) throw new Error('Erreur lors du chargement du modal');
            return response.text();
        })
        .then(data => {
            let modal = document.getElementById('deleteColumn');
            modal.innerHTML = data;
            modal.style.display = "flex";
        })
        .catch(error => {
            console.log(error);
        })
})