<div class="container px-4 py-8 mb-8 max-w-7xl mx-auto mt-12">
      <h1 class="text-lg font-bold flex items-center gap-2 mb-1">
        <span class="text-orange-500 text-xl">📊</span>
        Category Paling Diminati
      </h1>
      <p class="text-gray-600 mb-6">Kategori event dengan pendaftar terbanyak</p>


      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <?php foreach($top as $index => $c): ?>
      <!-- Card 1 -->
      <div class="p-5 rounded-xl shadow-sm border relative border-4 border-solid" style="border-color: <?= $c['color_name']; ?>">
        <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-sm font-semibold" style="background-color: <?= $c['color_name']; ?>;">#<?= $index + 1 ?></span>
        <span class="absolute top-4 right-4 bg-white shadow px-3 py-1 rounded-full text-sm">👥 <?= $c['total_peserta'] ?> Peserta </span>
        
        <div class="mt-10 flex items-center gap-3">
          
        <div>
        <h2 class="font-bold text-gray-800"><?= $c['category_name']; ?></h2>
        <p class="text-gray-500 text-sm"><?= $c['description']; ?></p>
        </div>
      </div>
      <p class="text-sm text-gray-600 mt-4"><?= $c['total_event']; ?> event tersedia</p>
      <p class="text-green-600 bg-green-100 inline-block px-2 py-1 rounded text-xs"><?= $c['percent'];?>% terisi</p>
        <div class="w-full bg-gray-200 h-2 rounded mt-3">
          <div class="bg-green-500 h-2 rounded" style="width: <?= $c['percent'];?>%"></div>
        </div>
      <p class="text-sm text-gray-700 mt-2"> <?= $c['total_peserta'];?>/<?= $c['total_kapasitas'];?> kapasitas</p>
      </div>
    <?php endforeach; ?>
</div>
</div>