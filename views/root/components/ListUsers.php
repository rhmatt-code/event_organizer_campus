
<div class="container mx-auto px-4 py-4">
  <div class="bg-white shadow-sm rounded-xl p-6 mb-6">
    <h1 class="text-xl font-semibold text-gray-800">Manajemen Akun Pengguna</h1>
    <p class="text-gray-500 mt-1">Kelola seluruh akun pengguna dan ubah role peserta menjadi panitia</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">


      <div class="p-4 rounded-xl border border-purple-200 bg-purple-50 flex items-center gap-4">
        <div>
          <p class="text-sm text-gray-600">Panitia</p>
          <p class="text-lg font-semibold text-purple-600"><?= count(array_filter($list, fn($r) => $r['role'] === 'organizer')) ?> akun</p>
        </div>
      </div>

      
      <div class="p-4 rounded-xl border border-emerald-200 bg-emerald-50 flex items-center gap-4">
        <div>
          <p class="text-sm text-gray-600">Peserta</p>
          <p class="text-lg font-semibold text-emerald-600"><?= count(array_filter($list, fn($r) => $r['role'] === 'student')) ?> akun</p>
        </div>
      </div>

      
      <div class="p-4 rounded-xl border border-yellow-200 bg-yellow-50 flex items-center gap-4">
        <div>
          <p class="text-sm text-gray-600">Total Akun</p>
          <p class="text-lg font-semibold text-yellow-600"><?= count($list) - 1; ?> akun</p>
        </div>
      </div>

    </div>
  </div>

  
  <div class="bg-white shadow-sm p-4 rounded-xl mb-6">
    <input id="searchInput" type="text" placeholder="Cari nama atau email pengguna..."
      class="w-full p-3 border rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none">
  </div>

  
  <div id="eventContainer" class=" bg-white p-6 rounded-xl shadow-sm mb-6">

    <?php foreach($list as $data): ?>
        <?php if($data['role'] === 'organizer'): ?>
    
    <div class="event-card border border-purple-200 rounded-xl p-4 mb-4 flex items-center justify-between bg-purple-50">
      <div class="flex items-center gap-4">
        <div>
          <p class="event-title font-semibold text-gray-700"><?= $data['name']; ?> | <span class="font-bold"><?= ucfirst($data['role']) ?> </span></p>
          <p class="text-sm text-gray-500"><?= $data['email']; ?></p>
          <p class="text-xs text-gray-400 mt-1">Terdaftar: <?= $data['created_at']; ?></p>
        </div>
      </div>
      <a class="px-4 py-2 border border-red-200 text-red-600 rounded-lg hover:bg-red-50 hover:border-red-300 rounded-lg" href="index.php?page=editakun&id=<?= $data['id'] ?>&role=student">
        Jadikan Mahasiswa
        </a>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>


  

  
     <?php foreach($list as $data ): ?>
        <?php if($data['role'] === 'student'): ?>
    <div class="event-card flex items-center justify-between p-4 bg-gray-50 rounded-xl border mb-3">
      <div class="flex items-center gap-4">
        <div>
          <p class="event-title font-semibold"><?= $data['name']; ?> | <span class="font-bold"><?= ucfirst($data['role']) ?></p>
          <p class="text-sm text-gray-500"><?= $data['email']; ?></p>
          <p class="text-xs text-gray-400 mt-1">Terdaftar: <?= $data['created_at']; ?></p>
        </div>
      </div>

      <a class="px-4 py-2 border border-red-200 text-red-600 rounded-lg hover:bg-red-50 hover:border-red-300 rounded-lg" href="index.php?page=editakun&id=<?= $data['id'] ?>&role=organizer">
        Jadikan Panitia
        </a>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
  </div>
  <div id="emptyMessage" class=" text-center py-12 bg-white/80 backdrop-blur-sm rounded-2xl border-2 border-slate-200" style="height:500px; display:none;">
                <span class="text-7xl">🗓️</span>
                <h3 class="text-gray-900 text-xl font-semibold mt-4 mb-2">Tidak ada event</h3>
                <p class="text-gray-600">Event akan muncul di sini</p>
        </div>
  <script src="views/js/FilterJs/SearchInput.js"></script>
  <script src="views/js/FilterJs/MainFilter.js"></script>
