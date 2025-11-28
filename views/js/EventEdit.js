document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("editModal");
  const modalBox = document.querySelector("#editModal .modal-box");
  const closeBtn = document.getElementById("closeEdit");

  const modalId = document.getElementById("edit-id")
  const modalTitle = document.getElementById("edit-title");
  const modalDate = document.getElementById("edit-date");
  const modalStart = document.getElementById("edit-start");
  const modalEnd = document.getElementById("edit-end");
  const modalLocation = document.getElementById("edit-location");
  const modalMax = document.getElementById("edit-max");
  const modalDescription = document.getElementById("edit-description");
  const modalPrice = document.getElementById("edit-price");

  document.querySelectorAll(".openEdit").forEach(btn => {
    btn.onclick = () => {
      modalId.value = btn.dataset.id;
      modalTitle.value = btn.dataset.title;
      modalDate.value = btn.dataset.date;
      modalStart.value = btn.dataset.start;
      modalEnd.value = btn.dataset.end;
      modalLocation.value = btn.dataset.location;
      modalMax.value = btn.dataset.max;
      modalDescription.value =  btn.dataset.description;
      modalPrice.value =  btn.dataset.price;

      modal.classList.remove("hidden");
      setTimeout(() => {
        modal.classList.replace("opacity-0", "opacity-100");
      }, 10);
    }
  });

  function closeModal() {
    modal.classList.add("hidden");
  }

  closeBtn.onclick = closeModal;
  window.onclick = e => { if(e.target === modal) closeModal(); };
});