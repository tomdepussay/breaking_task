window.reloadMonthCalendar = function(projectId) {
    const calendarContainer = document.querySelector('[data-calendar="month"]');

    if (!calendarContainer) return;

    fetch(`/project/${projectId}/calendar/month`)
        .then(response => {
            if (!response.ok) throw new Error('Erreur lors du chargement du calendrier');
            return response.text();
        })
        .then(html => {
            const temp = document.createElement('div');
            temp.innerHTML = html;

            const newContent = temp.querySelector('[data-calendar="month"]');

            if (newContent) {
                calendarContainer.innerHTML = newContent.innerHTML;
            }
        })
        .catch(error => {
            console.error('Erreur :', error);
        });
};
