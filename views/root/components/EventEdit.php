<div id="editModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between border-b pb-3 mb-4">
            <h2 class="text-xl font-semibold text-gray-800" >Edit Event</h2>
            <button id="closeEdit" class="text-gray-500 hover:text-gray-800 text-xl">✕</button>
        </div>

        <form action="index.php?page=editevent" method="POST" class="space-y-6">
            <input type="text" class="hidden" id="edit-id" name="id">

            <div class="grid gap-2">
                <label for="title" class="font-medium text-gray-700">Nama Event</label>
                <input type="text" id="edit-title" name="title" class="border rounded-lg p-2 w-full focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div class="grid gap-2">
                <label for="date" class="font-medium text-gray-700">Tanggal</label>
                    <input type="date" id="edit-date" name="date" class="border rounded-lg p-2 w-full focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="grid gap-2">
                    <label for="date" class="font-medium text-gray-700">Waktu Mulai</label>
                    <input type="time" id="edit-start" name="time_start" class="border rounded-lg p-2 w-full focus:ring-2 focus:ring-indigo-500" required>
                </div>
                <div class="grid gap-2">
                    <label for="edit-end" class="font-medium text-gray-700">Waktu Akhir</label>
                    <input type="time" id="edit-end" name="time_end" class="border rounded-lg p-2 w-full focus:ring-2 focus:ring-indigo-500" required>
                </div>
                
            </div>
            <span id="errorMessage" style="color: red; display: none;">
                Waktu mulai tidak boleh lebih dari waktu selesai!
            </span>

            <div class="grid gap-2">
                <label for="location" class="font-medium text-gray-700">Lokasi</label>
                <input type="text" id="edit-location" name="location" class="border rounded-lg p-2 w-full focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div class="grid gap-2">
                <div class="grid gap-2">
                    <label for="category" class="font-medium text-gray-700">Kategori</label>
                    <select id="edit-category" name="category" class="border rounded-lg p-2 w-full focus:ring-2 focus:ring-indigo-500" required>
                        <option value="">Pilih kategori</option>
                        <option value="1">Teknologi</option>
                        <option value="2">Bisnis</option>
                        <option value="3">Pendidikan</option>
                        <option value="4">Seni & Budaya</option>
                        <option value="5">Olahraga</option>
                        <option value="6">Sosial</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="grid gap-2">
                    <label for="edit-max" class="font-medium text-gray-700">Kapasitas Peserta</label>
                    <input type="number" id="edit-max" min="1" name="max" class="border rounded-lg p-2 w-full focus:ring-2 focus:ring-indigo-500" required>
                </div>
                <div class="grid gap-2">
                    <label for="price" class="font-medium text-gray-700">Harga (IDR)</label>
                    <input type="number" id="edit-price" name="price" min="0" placeholder="0" class="border rounded-lg p-2 w-full focus:ring-2 focus:ring-indigo-500" required>
                </div>
            </div>
            

            <div class="grid gap-2">
                <la
                el for="description" class="font-medium text-gray-700">Deskripsi</label>
                <textarea id="edit-description" name="deskripsi" rows="4" class="border rounded-lg p-2 w-full focus:ring-2 focus:ring-indigo-500" required></textarea>
            </div>
            

            <div class="flex justify-end gap-3 pt-4 border-t">
                <button onclick="validate()" type="submit" class="px-4 py-2 rounded-lg text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700">Edit Event</button>
            </div>
        </form>
    </div>
</div>
<script>
        document.getElementById('editModal').addEventListener('submit', function(e) {
            const startTime = document.getElementById('edit-start').value;
            const endTime = document.getElementById('edit-end').value;
            const errorMessage = document.getElementById('errorMessage');
            
            if (startTime && endTime) {
                if (startTime >= endTime) {
                    e.preventDefault();
                    errorMessage.style.display = 'inline';
                    return false;
                } else {
                    errorMessage.style.display = 'none';
                }
            }
        });

        // Validasi real-time saat input berubah
        document.getElementById('edit-start').addEventListener('change', validateTime);
        document.getElementById('edit-end').addEventListener('change', validateTime);
        
        function validateTime() {
            const startTime = document.getElementById('edit-start').value;
            const endTime = document.getElementById('edit-end').value;
            const errorMessage = document.getElementById('errorMessage');
            
            if (startTime && endTime && startTime >= endTime) {
                errorMessage.style.display = 'inline';
                document.getElementById('time_end').value = '';
            } else {
                errorMessage.style.display = 'none';
            }
        }
    </script>