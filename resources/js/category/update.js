document.addEventListener('click', function (e){
    let button = e.target.closest('.btn-update-category');
    if(!button) return;

    let category_id = button.getAttribute('data-category-id');

    let form = document.getElementById('editCategoryForm');
    let name = form.name.value;

    let formData = new FormData;
    formData.append('category_id', category_id);
    formData.append('name', name);

    fetch(`${categoriesRoutes.update}`, {
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
            document.querySelector(".modal-close[data-modal='updateCategory']").click();
        })
        .catch(error => {
            console.log(error);
        })
})