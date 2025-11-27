<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 transition duration-300 hidden" id="detailModal">
  <div class="bg-white/80 backdrop-blur-lg p-8 rounded-3xl shadow-2xl border-2 border-slate-200 modal-box bg-white p-6 rounded-lg shadow-lg transform transition duration-300 scale-75">
    <div class="flex items-center justify-between border-b pb-3 ">
      <h2 class="text-xl font-semibold text-gray-800">Detail Event</h2>
      <button id="closeModal" class="text-gray-500 hover:text-gray-800" title="Tutup">
        ✕
      </button>
    </div>

    <div class="space-y-6 mt-4">
      
      <div class="space-y-2">
        <div class="flex justify-between items-start">
          <h3 id="modalTitle" class="text-lg font-medium text-gray-900"></h3>
          <span class="px-3 py-1 rounded-md text-white text-sm bg-gradient-to-r from-emerald-600 to-teal-600">
            upcoming
          </span>
        </div>
        <span class="inline-block px-3 py-1 text-sm rounded-md text-white bg-gradient-to-r from-rose-600 to-pink-600">
          Workshop
        </span>
      </div>

      <div class="bg-gradient-to-br from-slate-50 to-stone-50 p-6 rounded-xl border-2 border-slate-200 grid grid-cols-2 gap-4">
        <div class="flex items-center gap-3">
          <div class="bg-white p-2 rounded-lg">
            📅
          </div>
          <div>
            <p  class="text-gray-500 text-sm">Tanggal</p>
            <p id="modalDate" class="text-gray-900 font-medium"></p>
          </div>
        </div>

        <div class="flex items-center gap-3">
          <div class="bg-white p-2 rounded-lg">
            ⏰
          </div>
          <div>
            <p class="text-gray-500 text-sm">Waktu</p>
            <p class="text-gray-900 font-medium"><span id="modalStart"></span> - <span id="modalEnd"></span></p>
          </div>
        </div>

        <div class="flex items-center gap-3">
          <div class="bg-white p-2 rounded-lg">
            📍
          </div>
          <div>
            <p class="text-gray-500 text-sm">Lokasi</p>
            <p id="modalLocation" class="text-gray-900 font-medium"></p>
          </div>
        </div>

        <div class="flex items-center gap-3">
          <div class="bg-white p-2 rounded-lg">
            👥
          </div>
          <div>
            <p class="text-gray-500 text-sm">Kapasitas</p>
            <p id="modalMax" class="text-gray-900 font-medium"> peserta</p>
          </div>
        </div>
      </div>

      <div>
        <h4 class="text-gray-900 mb-1 font-semibold">Deskripsi Event</h4>
        <p id="modalDescription" class="text-gray-600 text-sm leading-relaxed">
          
        </p>
      </div>

      <div class="bg-gradient-to-r from-amber-50 to-yellow-50 p-6 rounded-xl border-2 border-amber-200">
        <div class="flex items-center justify-between mb-4">
          <div class="flex items-center gap-3">
            <span class="text-emerald-600 text-xl">✅</span>
            <div>
              <p class="text-gray-600 text-sm">Pendaftar</p>
              <p class="text-gray-900 font-medium"><span id="modalCurrent"></span>/<span id="modalMax1"></span> terdaftar</p>
            </div>
          </div>
          <div class="text-right">
            <p class="text-gray-600 text-sm">Harga Tiket</p>
            <p class="text-amber-700 font-medium">Rp <span id="modalPrice"></span></p>
          </div>
        </div>
      </div>

      <div class="flex gap-3">
        <button id="closeDetailBtn" class="flex-1 border border-gray-300 rounded-lg py-2 hover:bg-gray-100">
          Tutup
        </button>
        <button id="joinEventBtn" class="flex-1 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white rounded-lg py-2 shadow-lg">
          Ikuti Acara
        </button>
      </div>
    </div>
  </div>
</div>