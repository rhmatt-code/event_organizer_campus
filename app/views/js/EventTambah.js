const modalTambah = document.getElementById("modalTambah");
   document.getElementById("openTambah").onclick = () => modalTambah.classList.remove("hidden");
   document.getElementById("closeTambah").onclick = () => modalTambah.classList.add("hidden");
   window.onclick = (e) => { if(e.target === modalTambah) modalTambah.classList.add("hidden"); }

const modalEdit = document.getElementById("modalEdit");
   document.getElementById("openEventEdit").onclick = () => modalTambah.classList.remove("hidden");
   document.getElementById("closeEventEdit").onclick = () => modalTambah.classList.add("hidden");
   window.onclick = (e) => { if(e.target === modalTambah) modalTambah.classList.add("hidden"); }