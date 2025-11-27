const modal = document.getElementById("LoginCard");
   document.getElementById("openLogin").onclick = () => modal.classList.remove("hidden");
   document.getElementById("closeLogin").onclick = () => modal.classList.add("hidden");
   window.onclick = (e) => { if(e.target === modal) modal.classList.add("hidden"); }

