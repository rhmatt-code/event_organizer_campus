document.addEventListener("DOMContentLoaded", () => {

    const filterBtns = document.querySelectorAll(".filter-btn");

    filterBtns.forEach(btn => {
        btn.addEventListener("click", () => {

            activeFilter = btn.dataset.status || "all";

            filterBtns.forEach(b => {
                b.classList.remove("active");
                b.setAttribute("data-state", "inactive");
            });

            btn.classList.add("active");
            btn.setAttribute("data-state", "active");

            runFiltering();
        });
    });

});
