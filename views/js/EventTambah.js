const modalTambah = document.getElementById("modalTambah");
   document.getElementById("openTambah").onclick = () => modalTambah.classList.remove("hidden");
   document.getElementById("closeTambah").onclick = () => modalTambah.classList.add("hidden");
   window.onclick = (e) => { if(e.target === modalTambah) modalTambah.classList.add("hidden"); }
