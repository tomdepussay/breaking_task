window.reloadColumn = function(column_id) {
    fetch(`${columnRoutes.show}?id=${column_id}`)
        .then(response => {
            if (!response.ok) throw new Error('Erreur lors de la récupération des données');
            return response.text();
        })
        .then(data => {
            let column = document.querySelector(`li[data-column="${column_id}"]`);
            column.innerHTML = data;
        })
        .catch(error => {
            console.log(error);
        })
}