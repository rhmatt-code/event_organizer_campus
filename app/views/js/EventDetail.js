document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("detailModal");
  const modalBox = document.querySelector("#detailModal .modal-box");
  const closeBtn = document.getElementById("closeModal");

  const modalTitle = document.getElementById("modalTitle");
  const modalDate = document.getElementById("modalDate");
  const modalStart = document.getElementById("modalStart");
  const modalEnd = document.getElementById("modalEnd");
  const modalLocation = document.getElementById("modalLocation");
  const modalMax = document.getElementById("modalMax");
  const modalMax1 = document.getElementById("modalMax1");
  const modalDescription = document.getElementById("modalDescription");
  const modalCurrent = document.getElementById("modalCurrent");
  const modalPrice = document.getElementById("modalPrice");

  document.querySelectorAll(".openModal").forEach(btn => {
    btn.onclick = () => {
      modalTitle.innerText = btn.dataset.title;
      modalDate.innerText = btn.dataset.date;
      modalStart.innerText = btn.dataset.start;
      modalEnd.innerText = btn.dataset.end;
      modalLocation.innerText = btn.dataset.location;
      modalMax.innerText = btn.dataset.max;
      modalMax1.innerText = btn.dataset.max;
      modalDescription.innerText =  btn.dataset.description;
      modalCurrent.innerText =  btn.dataset.current;
      modalPrice.innerText =  btn.dataset.price;

      modal.classList.remove("hidden");
      setTimeout(() => {
        modal.classList.replace("opacity-0", "opacity-100");
        modalBox.classList.replace("scale-75", "scale-100");
      }, 10);
    }
  });

  function closeModal() {
    modal.classList.replace("opacity-100", "opacity-0");
    modalBox.classList.replace("scale-100", "scale-75");
    setTimeout(() => modal.classList.add("hidden"), 200);
  }

  closeBtn.onclick = closeModal;
  modal.onclick = e => { if(e.target === modal) closeModal(); };
});

