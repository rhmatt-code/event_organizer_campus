
    <div class="w-full max-w-4xl bg-white/80 backdrop-blur-sm p-6 rounded-2xl shadow-lg border-2 border-slate-200">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6 gap-4">
            <div class="flex items-center gap-3">
                <div class="bg-gradient-to-br from-indigo-100 to-purple-100 p-3 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                        <polyline points="17 6 23 6 23 12"></polyline>
                    </svg>
                </div>
                <div>
                    <h3 class="text-gray-900 font-bold text-lg">Grafik Jumlah Peserta per Event</h3>
                    <p class="text-gray-600 text-sm">Visualisasi pendaftaran event</p>
                </div>
            </div>

            <div class="flex items-center gap-2 bg-gradient-to-r from-slate-100 to-stone-100 px-4 py-2 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <span id="total-participants" class="text-gray-700 font-medium text-sm">
                    Total: 0 Peserta
                </span>
            </div>
        </div>

        <div class="bg-gradient-to-br from-slate-50 to-stone-50 p-4 rounded-xl border border-slate-100">
            <div class="relative h-[350px] w-full">
                <canvas id="eventChart"></canvas>
            </div>
        </div>

        <div class="mt-6 flex flex-wrap gap-4 justify-center text-sm">
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 rounded bg-emerald-600"></div>
                <span class="text-gray-700">≥80% Terisi</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 rounded bg-amber-600"></div>
                <span class="text-gray-700">50-79% Terisi</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 rounded bg-yellow-500"></div>
                <span class="text-gray-700">20-49% Terisi</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 rounded bg-[#6366f1]"></div> <!-- Indigo -->
                <span class="text-gray-700">&lt;20% Terisi</span>
            </div>
        </div>
    </div>

    <script src="/js/Chart.js"></script>
