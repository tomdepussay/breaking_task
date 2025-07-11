document.addEventListener('click', function (e){
    let button = e.target.closest('.btn-edit-category');
    if(!button) return;

    let category_id = button.getAttribute('data-category-id');

    fetch(`${categoriesRoutes.edit}?category_id=${category_id}`)
        .then(response => {
            if (!response.ok) throw new Error('Erreur lors du chargement du modal');
            return response.text();
        })
        .then(data => {
            let modal = document.getElementById('editCategory');
            modal.innerHTML = data;
            modal.style.display = "flex";
        })
        .catch(error => {
            console.log(error);
        })
})