window.initDayCalendarNavigation = function (projectId) {
    const container = document.getElementById("dayCalendarContainer");
    if (!container) return;

    const calendar = container.querySelector('[data-calendar="day"]');
    if (!calendar) return;

    const prevBtn = calendar.querySelector("#prevDay");
    const nextBtn = calendar.querySelector("#nextDay");

    if (!prevBtn || !nextBtn) return;

    function reload(date) {
        const year = date.getFullYear();
        const month = date.getMonth() + 1;
        const day = date.getDate();

        fetch(`/calendar/day-view/${projectId}?date=${year}-${String(month).padStart(2,'0')}-${String(day).padStart(2,'0')}`)
            .then((res) => {
                if (!res.ok) throw new Error("Erreur lors du chargement du calendrier jour");
                return res.text();
            })
            .then((html) => {
                container.innerHTML = html;

                // Rebind navigation after reload
                window.initDayCalendarNavigation(projectId);
            })
            .catch(console.error);
    }

    prevBtn.onclick = () => {
        const year = parseInt(calendar.dataset.year, 10);
        const month = parseInt(calendar.dataset.month, 10);
        const day = parseInt(calendar.dataset.day, 10);
        const currentDate = new Date(year, month - 1, day);

        currentDate.setDate(currentDate.getDate() - 1);
        reload(currentDate);
    };

    nextBtn.onclick = () => {
        const year = parseInt(calendar.dataset.year, 10);
        const month = parseInt(calendar.dataset.month, 10);
        const day = parseInt(calendar.dataset.day, 10);
        const currentDate = new Date(year, month - 1, day);

        currentDate.setDate(currentDate.getDate() + 1);
        reload(currentDate);
    };
};



window.initWeekCalendarNavigation = function (projectId) {
    const container = document.getElementById("weekCalendarContainer");
    if (!container) return;

    const calendar = container.querySelector('[data-calendar="week"]');
    if (!calendar) return;

    const prevBtn = calendar.querySelector('#prevWeek');
    const nextBtn = calendar.querySelector('#nextWeek');

    let year = parseInt(calendar.dataset.year);
    let month = parseInt(calendar.dataset.month);
    let day = parseInt(calendar.dataset.day);

    const currentDateStr = calendar.dataset.currentDate;
    const currentDate = new Date(currentDateStr);

    function reload(newDate) {
        const year = newDate.getFullYear();
        const month = newDate.getMonth() + 1;
        const day = newDate.getDate();

        fetch(`/calendar/week-view/${projectId}?year=${year}&month=${month}&day=${day}`)
            .then(res => {
                if (!res.ok) throw new Error("Erreur lors du chargement du calendrier semaine");
                return res.text();
            })
            .then(html => {
                container.innerHTML = html;

                const newCalendar = container.querySelector('[data-calendar="week"]');
                if (newCalendar) newCalendar.classList.remove("hidden");

                window.initWeekCalendarNavigation(projectId);
            })
            .catch(console.error);
    }


    prevBtn.onclick = () => {
        const newDate = new Date(currentDate);
        newDate.setDate(newDate.getDate() - 7);
        reload(newDate);
    };

    nextBtn.onclick = () => {
        const newDate = new Date(currentDate);
        newDate.setDate(newDate.getDate() + 7);
        reload(newDate);
    };
};

window.initMonthCalendarNavigation = function (projectId) {
    const container = document.getElementById("monthCalendarContainer");
    if (!container) return;

    const calendar = container.querySelector('[data-calendar="month"]');
    if (!calendar) return;

    const prevBtn = calendar.querySelector('#prevMonth');
    const nextBtn = calendar.querySelector('#nextMonth');

    function reload(year, month) {
        fetch(`/calendar/month-view/${projectId}?year=${year}&month=${month}`)
            .then(res => {
                if (!res.ok) throw new Error('Erreur lors du chargement du calendrier');
                return res.text();
            })
            .then(html => {
                container.innerHTML = html;
                window.initMonthCalendarNavigation(projectId);
            })
            .catch(console.error);
    }

    prevBtn.onclick = () => {
        let year = parseInt(calendar.dataset.year);
        let month = parseInt(calendar.dataset.month);
        month--;
        if (month < 1) {
            month = 12;
            year--;
        }
        reload(year, month);
    };

    nextBtn.onclick = () => {
        let year = parseInt(calendar.dataset.year);
        let month = parseInt(calendar.dataset.month);
        month++;
        if (month > 12) {
            month = 1;
            year++;
        }
        reload(year, month);
    };
};
