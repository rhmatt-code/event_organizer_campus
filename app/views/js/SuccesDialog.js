document.addEventListener("DOMContentLoaded", () => {
  const dialog = document.getElementById("successDialog");
  const closeBtn = document.getElementById("closeDialog");
  const titleEl = document.getElementById("eventTitle");

  function showSuccessDialog(eventName) {
    titleEl.textContent = `"${eventName}"`;
    dialog.classList.remove("hidden");
    dialog.classList.add("flex");
  }

  function hideSuccessDialog() {
    dialog.classList.remove("flex");
    dialog.classList.add("hidden");
  }

  closeBtn.addEventListener("click", hideSuccessDialog);

  dialog.addEventListener("click", (e) => {
    if (e.target === dialog) hideSuccessDialog();
  });

});
