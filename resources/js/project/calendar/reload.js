/* Reload Day view */
window.reloadDayCalendar = function (projectId, date = null) {
    const calendar = document.querySelector('[data-calendar="day"]');
    if (!calendar) return;

    const targetDate = date || new Date().toISOString().split('T')[0];

    fetch(`/calendar/day-view/${projectId}?date=${targetDate}`)
        .then(res => {
            if (!res.ok) throw new Error('Erreur lors du chargement du calendrier jour');
            return res.text();
        })
        .then(html => {
            const temp = document.createElement('div');
            temp.innerHTML = html;

            const newDay = temp.querySelector('[data-calendar="day"]');
            if (newDay) {
                calendar.replaceWith(newDay);
                if (window.initDayCalendarNavigation) window.initDayCalendarNavigation(projectId);
            }
        })
        .catch(console.error);
};

/* Reload Week view */
window.reloadWeekCalendar = function (projectId, year = null, month = null, day = null) {
    const calendar = document.querySelector('[data-calendar="week"]');
    if (!calendar) return;

    const now = new Date();
    year = year || now.getFullYear();
    month = month || (now.getMonth() + 1);
    day = day || now.getDate();

    fetch(`/calendar/week-view/${projectId}?year=${year}&month=${month}&day=${day}`)
        .then(res => {
            if (!res.ok) throw new Error('Erreur lors du chargement du calendrier semaine');
            return res.text();
        })
        .then(html => {
            const temp = document.createElement('div');
            temp.innerHTML = html;

            const newWeek = temp.querySelector('[data-calendar="week"]');
            if (newWeek) {
                calendar.replaceWith(newWeek);
                if (window.initWeekCalendarNavigation) window.initWeekCalendarNavigation(projectId);
            }
        })
        .catch(console.error);
};

/* Reload Month view */
window.reloadMonthCalendar = function (projectId, year = null, month = null) {
    const calendar = document.querySelector('[data-calendar="month"]');
    if (!calendar) return;

    const now = new Date();
    year = year || parseInt(calendar.dataset.year, 10) || now.getFullYear();
    month = month || parseInt(calendar.dataset.month, 10) || (now.getMonth() + 1);

    fetch(`/calendar/month-view/${projectId}?year=${year}&month=${month}`)
        .then(res => {
            if (!res.ok) throw new Error('Erreur lors du chargement du calendrier mois');
            return res.text();
        })
        .then(html => {
            const temp = document.createElement('div');
            temp.innerHTML = html;

            const newMonth = temp.querySelector('[data-calendar="month"]');
            if (newMonth) {
                calendar.replaceWith(newMonth);
                if (window.initMonthCalendarNavigation) window.initMonthCalendarNavigation(projectId);
            }
        })
        .catch(console.error);
};
