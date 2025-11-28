
<div class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 2xl:grid-cols-3">
        <?php foreach ($data as $event): ?>
        <div class="p-6 bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border-l-4 border-l-emerald-500">
            <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-2">
                    <h3 class="text-gray-900 font-semibold text-lg"><?= $event['title']; ?></h3>
                    <span class="px-2 py-1 text-xs rounded-md bg-gradient-to-r from-emerald-600 to-teal-600 text-white">
                        <?= $event['status']; ?>
                    </span>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-md bg-gradient-to-r from-blue-600 to-cyan-600 text-white">
                    Seminar
                    </span>
                </div>

                <div class="text-gray-500">
                    <?php if(isset($_SESSION['role']) && ($_SESSION['role'] === 'organizer')): ?> 
                    <button id="openEdit" class="openEdit mr-2" data-id="<?= $event['id'] ?>" data-title="<?= $event['title'] ?>" data-status="<?= $event['status'] ?>" data-description="<?= $event['description'] ?>" data-price="<?= $event['price']; ?>"  data-max="<?= $event['max_participants'] ?>" data-location="<?= $event['location'] ?>" data-date="<?= $event['event_date'] ?>" data-start="<?= date("H:i", strtotime($event['event_time'])); ?>" data-end="<?= date("H:i", strtotime($event['event_end_time'])); ?>">✏️</button>
                    
                    <a href="index.php?page=delete&id=<?= $event['id'] ?>" title="Hapus" class="hover:text-red-600">🗑️</a>
                    <?php endif; ?> 
                </div>
                </div>

                    <p class="text-gray-600 mb-4">
                    <?= $event['description']; ?>
                    </p>

                <div class="grid grid-cols-2 gap-3 mb-4 text-sm text-gray-600">
                <div class="flex items-center gap-2">
                    📅 <span><?= $event['event_date']; ?></span>
                </div>
                <div class="flex items-center gap-2">
                    ⏰ <span><?= date("H:i", strtotime($event['event_time'])); ?> - <?= date("H:i", strtotime($event['event_end_time'])); ?></span>
                </div>
                <div class="flex items-center gap-2">
                    📍 <span><?= $event['location']; ?></span>
                </div>
                <div class="flex items-center gap-2">
                    👥 <span><?= $event['max_participants']; ?> kapasitas</span>
                </div>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                <div class="flex flex-col text-sm text-gray-700">
                    <div class="flex items-center gap-2 mb-1">
                    ✅ <span><?= $event['current_participants']; ?>/<?= $event['max_participants']; ?> terdaftar</span>
                    </div>
                    <div class="flex items-center gap-2">
                    <?php if ($event['price'] == 0.00) : ?>
                    💳 <span class="font-medium text-gray-900">Gratis!</span>
                    <?php else: ?>
                    💳 <span class="font-medium text-gray-900">Rp<?= number_format($event['price'], 0, ',','.'); ?></span>
                    <?php endif; ?>
                    </div>
                </div>

                <?php if(!empty($_SESSION['name'])): ?>
                    <?php if($_SESSION['role'] == 'student') :?> 
                        <button id="openDetail" class="openModal px-4 py-2 text-sm font-medium rounded-lg bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-lg hover:shadow-xl transition-all" data-title="<?= $event['title'] ?>" data-status="<?= $event['status'] ?>" data-description="<?= $event['short_description'] ?>" data-price="<?= number_format($event['price'], 0, ',','.'); ?>" data-current="<?= $event['current_participants'] ?>" data-max="<?= $event['max_participants'] ?>" data-location="<?= $event['location'] ?>" data-date="<?= $event['event_date'] ?>" data-start="<?= date("H:i", strtotime($event['event_time'])); ?>" data-end="<?= date("H:i", strtotime($event['event_end_time'])); ?>">
                            Daftar Sekarang
                        </button>
                    <?php endif; ?>
                <?php endif; ?> 
            </div>
        </div>
        
        <?php endforeach; ?>
        <div id="popupContainer" class="fixed top-0 left-0 w-full h-full bg-black/60 z-[1000] justify-center items-center p-4">
            <div id="popup-content-wrapper" class="bg-white p-6 md:p-8 rounded-lg shadow-xl w-full max-w-2xl relative max-h-[90vh] overflow-y-auto">
                <span id="tutup-popup" class="absolute top-3 right-5 text-3xl text-gray-400 hover:text-gray-800 cursor-pointer" title="Tutup">&times;</span>

                <div id="popup-body">
                    <p class="text-center text-gray-500">Memuat...</p>
                </div>
            </div>
        </div>
        <?php include "EventDialogDetail.php"; ?>
</div>

