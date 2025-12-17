const modal = document.getElementById('pesertaModal');
const modalContent = document.getElementById('modalContent');

document.querySelectorAll('.openPeserta').forEach(btn => {
  btn.addEventListener('click', () => {
    const eventId = btn.dataset.eventId;

    modal.classList.remove('hidden');
    modalContent.innerHTML = '<p class="text-gray-500">Memuat data...</p>';

    fetch(`?page=peserta_event&event_id=${eventId}`)
      .then(res => res.text())
      .then(html => modalContent.innerHTML = html);
  });
});

document.getElementById('closePeserta').onclick = () => {
  modal.classList.add('hidden');
};
