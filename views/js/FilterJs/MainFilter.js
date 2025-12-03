// GLOBAL STATE
let activeFilter = "all";
let ShowEventSaya = false;
let sortMode = "newest";

// Utility ambil semua card
function getEventCards() {
    return Array.from(document.querySelectorAll(".event-card"));
}

function runFiltering() {
    const searchText = (document.getElementById("searchInput")?.value || "").toLowerCase();
    const cards = getEventCards();
    const emptyMessage = document.getElementById("emptyMessage");

    let visibleCount = 0;

    // SORTING
    cards.sort((a, b) => {
        const dateA = new Date(a.dataset.date);
        const dateB = new Date(b.dataset.date);
        return sortMode === "newest" ? dateB - dateA : dateA - dateB;
    });

    const container = document.getElementById("eventContainer");
    cards.forEach(c => container.appendChild(c));

    // FILTERING
    cards.forEach(card => {
        const title = card.querySelector(".event-title").textContent.toLowerCase();
        const status = card.dataset.status;
        const user = card.dataset.user === "yes";

        const matchesSearch = title.includes(searchText);
        const matchesCategory = activeFilter === "all" || status === activeFilter;
        const matchesOwner = ShowEventSaya ? user : true;

        const shouldShow = matchesSearch && matchesCategory && matchesOwner;

        card.style.display = shouldShow ? "block" : "none";

        if (shouldShow) visibleCount++;
    });

    // SHOW / HIDE "Event tidak ada"
    emptyMessage.style.display = visibleCount === 0 ? "block" : "none";
}
