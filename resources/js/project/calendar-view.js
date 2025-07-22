document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".view-btn");
    const defaultView = "day";

    document
        .querySelectorAll(".calendar-view")
        .forEach((view) => view.classList.add("hidden"));

    const projectId =
        document.querySelector("[data-project-id]")?.dataset.projectId;
    if (!projectId) {
        console.error("Project ID not found in DOM");
        return;
    }

    /* Load default view */
    if (defaultView === "day") {
        loadDayView(projectId);
    } else if (defaultView === "threedays") {
        loadThreeDaysView(projectId);
    } else if (defaultView === "week") {
        loadWeekView(projectId);
    } else if (defaultView === "month") {
        loadMonthView(projectId);
    }

    buttons.forEach((btn) => {
        if (btn.getAttribute("data-view") === defaultView) {
            btn.classList.add("btn-active");
            btn.classList.remove("btn-inactive");
        } else {
            btn.classList.add("btn-inactive");
            btn.classList.remove("btn-active");
        }
    });

    buttons.forEach((button) => {
        button.addEventListener("click", () => {
            const view = button.getAttribute("data-view");

            document
                .querySelectorAll(".calendar-view")
                .forEach((v) => v.classList.add("hidden"));
            if (view === "month") {
                loadMonthView(projectId);
            } else if (view === "week") {
                loadWeekView(projectId);
            } else if (view === "threedays") {
                loadThreeDaysView(projectId);
            } else if (view === "day") {
                loadDayView(projectId);
            }

            buttons.forEach((btn) => {
                btn.classList.remove("btn-active");
                btn.classList.add("btn-inactive");
            });

            button.classList.add("btn-active");
            button.classList.remove("btn-inactive");
        });
    });
});

/* Load Day view */
function loadDayView(projectId, date = null) {
    const container = document.getElementById("dayCalendarContainer");
    if (!container) {
        console.error("Day calendar container not found");
        return;
    }

    const targetDate = date || new Date().toISOString().split("T")[0];

    fetch(`/calendar/day-view/${projectId}?date=${targetDate}`)
        .then((res) => {
            if (!res.ok)
                throw new Error("Erreur lors du chargement du calendrier jour");
            return res.text();
        })
        .then((html) => {
            container.innerHTML = html;
            container
                .querySelector('[data-calendar="day"]')
                ?.classList.remove("hidden");

            if (window.initDayCalendarNavigation) {
                window.initDayCalendarNavigation(projectId);
            }
        })
        .catch((error) => {
            console.error(error);
        });
}

/* Load Three Days view */
function loadThreeDaysView(projectId, date = null) {
    const container = document.getElementById("threeDaysCalendarContainer");
    if (!container) {
        console.error("Three days calendar container not found");
        return;
    }
    const targetDate = date || new Date().toISOString().split("T")[0];
    fetch(`/calendar/threedays-view/${projectId}?date=${targetDate}`)
        .then((res) => {
            if (!res.ok)
                throw new Error(
                    "Erreur lors du chargement du calendrier trois jours"
                );
            return res.text();
        })
        .then((html) => {
            container.innerHTML = html;
            container
                .querySelector('[data-calendar="threedays"]')
                ?.classList.remove("hidden");

            if (window.initThreeDaysCalendarNavigation) {
                window.initThreeDaysCalendarNavigation(projectId);
            }
        })
        .catch((error) => {
            console.error(error);
        });
}

/* Load Week view */
function loadWeekView(projectId, date = null) {
    const container = document.getElementById("weekCalendarContainer");
    if (!container) {
        console.error("Week calendar container not found");
        return;
    }

    const targetDate = date || new Date().toISOString().split("T")[0];

    fetch(`/calendar/week-view/${projectId}?date=${targetDate}`)
        .then((res) => {
            if (!res.ok)
                throw new Error(
                    "Erreur lors du chargement du calendrier semaine"
                );
            return res.text();
        })
        .then((html) => {
            container.innerHTML = html;
            container
                .querySelector('[data-calendar="week"]')
                ?.classList.remove("hidden");

            if (window.initWeekCalendarNavigation) {
                window.initWeekCalendarNavigation(projectId);
            }
        })
        .catch((error) => {
            console.error(error);
        });
}

/* Load Month view */
function loadMonthView(projectId, year = null, month = null) {
    const container = document.getElementById("monthCalendarContainer");
    if (!container) {
        console.error("Month calendar container not found");
        return;
    }

    const now = new Date();
    year = year || now.getFullYear();
    month = month || now.getMonth() + 1;

    fetch(`/calendar/month-view/${projectId}?year=${year}&month=${month}`)
        .then((res) => {
            if (!res.ok)
                throw new Error("Erreur lors du chargement du calendrier");
            return res.text();
        })
        .then((html) => {
            container.innerHTML = html;
            container
                .querySelector('[data-calendar="month"]')
                ?.classList.remove("hidden");

            if (window.initMonthCalendarNavigation) {
                window.initMonthCalendarNavigation(projectId);
            }
        })
        .catch((error) => {
            console.error(error);
        });
}
