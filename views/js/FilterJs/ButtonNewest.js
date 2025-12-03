document.addEventListener("DOMContentLoaded", () => {
    const sortBtns = document.querySelectorAll(".sort-btn");

    sortBtns.forEach(btn => {
        btn.addEventListener("click", () => {

            sortMode = btn.dataset.sort; // newest / oldest

            sortBtns.forEach(b => {
                b.classList.remove("active");
                b.setAttribute("data-state", "inactive");
            });
            btn.classList.add("active");
            btn.setAttribute("data-state", "active");

            runFiltering();
        });
    });
});
