//  function openModal() {
//     const modal = document.getElementById("modal");
//     const box = document.getElementById("LoginCard");

//     modal.classList.remove("hidden");
    
//     setTimeout(() => {
//       modal.classList.remove("opacity-0");
//       modal.classList.add("opacity-100");
//       box.classList.remove("scale-75", "opacity-0");
//       box.classList.add("scale-100", "opacity-100");
//     }, 10);
//   }

//   function closeModal() {
//     const modal = document.getElementById("modal");
//     const box = document.getElementById("LoginCard");

//     modal.classList.add("opacity-0");
//     modal.classList.remove("opacity-100");

//     box.classList.add("scale-75", "opacity-0");
//     box.classList.remove("scale-100", "opacity-100");

//     setTimeout(() => {
//       modal.classList.add("hidden");
//     }, 300);
//   }

//   // Optional: klik area hitam untuk close
//   document.getElementById("modal").addEventListener("click", function (e) {
//     if (e.target === this) closeModal();
//   });
 
//  const modal = document.getElementById("LoginCard");
//   document.getElementById("openLogin").onclick = () => modal.classList.remove("hidden");
//   document.getElementById("closeLogin").onclick = () => modal.classList.add("hidden");
//   window.onclick = (e) => { if(e.target === modal) modal.classList.add("hidden"); }

document.addEventListener("DOMContentLoaded", () => {

  const modal = document.getElementById("LoginCard");
  const openBtn = document.getElementById("openLogin");
  const closeBtn = document.getElementById("closeLogin");
  const modalBox = document.querySelector("#LoginCard .modal-box"); // tambahkan class ini di div modal nya

  if (!modal || !openBtn || !closeBtn) return; // biar gak error

  // Open Modal
  openBtn.onclick = () => {
    modal.classList.remove("hidden");

    // Delay agar animasi jalan
    setTimeout(() => {
      modal.classList.replace("opacity-0", "opacity-100");
      modalBox.classList.replace("scale-75", "scale-100");
    }, 10);
  };

  // Close Modal
  closeBtn.onclick = () => closeModal();

  function closeModal() {
    modal.classList.replace("opacity-100", "opacity-0");
    modalBox.classList.replace("scale-100", "scale-75");

    setTimeout(() => modal.classList.add("hidden"), 250);
  }

  // Click outside close
  window.onclick = (e) => { if (e.target === modal) closeModal(); };

});