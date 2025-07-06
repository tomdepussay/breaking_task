console.log("Calendar view script loaded");

document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".view-btn");
    const defaultView = "day";

    document
        .querySelectorAll(".calendar-view")
        .forEach((view) => view.classList.add("hidden"));
    document
        .querySelector(`[data-calendar="${defaultView}"]`)
        ?.classList.remove("hidden");

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
                .forEach((view) => view.classList.add("hidden"));
            document
                .querySelector(`[data-calendar="${view}"]`)
                ?.classList.remove("hidden");

            buttons.forEach((btn) => {
                btn.classList.remove("btn-active");
                btn.classList.add("btn-inactive");
            });

            button.classList.add("btn-active");
            button.classList.remove("btn-inactive");
        });
    });
});
