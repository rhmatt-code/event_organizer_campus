document.addEventListener("DOMContentLoaded", () => {
    const btnSaya = document.getElementById("EventSaya");

    btnSaya.addEventListener("click", () => {

        ShowEventSaya = !ShowEventSaya; // toggle ON/OFF

        if (ShowEventSaya) {
            btnSaya.classList.remove("btn-outline-success");
            btnSaya.classList.add("btn-success");
            btnSaya.setAttribute("data-state", "active");
        } else {
            btnSaya.classList.add("btn-outline-success");
            btnSaya.classList.remove("btn-success");
            btnSaya.setAttribute("data-state", "inactive");
        }

        runFiltering();
    });
});
