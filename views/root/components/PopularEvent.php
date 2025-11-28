<div class="mb-8 max-w-7xl mx-auto mt-12">
      <div class="flex items-center gap-3 mb-4">
        <div class="bg-gradient-to-r from-amber-600 to-yellow-600 p-3 rounded-xl shadow-lg">
          <span class="text-white text-2xl">📈</span>
        </div>
        <div>
          <h2 class="text-gray-900 font-semibold text-xl">Event Paling Diminati</h2>
          <p class="text-gray-600">Event dengan pendaftar terbanyak</p>
        </div>
      </div>

      <div id="popular-events-container" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        
        <div class="relative overflow-hidden bg-gradient-to-br from-amber-50 to-yellow-50 border-2 rounded-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
          <div class="absolute top-0 right-0 w-32 h-32 opacity-20">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-600 to-yellow-600 rounded-full blur-3xl"></div>
          </div>
          <div class="relative p-6">
            <div class="flex items-start justify-between mb-4">
              <div class="bg-gradient-to-r from-amber-600 to-yellow-600 text-white px-4 py-2 rounded-xl flex items-center gap-2 shadow-lg">
                <span>⭐</span> <span class="font-medium">#1</span>
              </div>
              <div class="flex items-center gap-2 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-xl border border-slate-200 shadow-md">
                <span>👥</span><?= $top[0]['current_participants'] ?> Terdaftar <span class="text-gray-900 font-medium"></span>
              </div>
            </div>
            <h3 class="text-gray-900 font-semibold text-lg mb-2 line-clamp-1"><?= $top[0]['title'] ?></h3>
            <p class="text-gray-600 mb-4 line-clamp-2 text-sm"><?= $top[0]['description'] ?></p>
            <div class="flex items-center gap-2 flex-wrap text-sm">
              <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-lg text-gray-700 border border-slate-200"><?= $top[0]['name'] ?></span>
              <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-lg text-gray-700 border border-slate-200"><?= $top[0]['event_date'] ?></span>
            </div>
          </div>
        </div>

        <div class="relative overflow-hidden bg-gradient-to-br from-indigo-50 to-purple-50 border-2 rounded-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
          <div class="absolute top-0 right-0 w-32 h-32 opacity-20">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-full blur-3xl"></div>
          </div>
          <div class="relative p-6">
            <div class="flex items-start justify-between mb-4">
              <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-4 py-2 rounded-xl flex items-center gap-2 shadow-lg">
                <span>⭐</span> <span class="font-medium">#2</span>
              </div>
              <div class="flex items-center gap-2 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-xl border border-slate-200 shadow-md">
                <span>👥</span><?= $top[1]['current_participants'] ?> Terdaftar<span class="text-gray-900 font-medium"></span>
              </div>
            </div>
            <h3 class="text-gray-900 font-semibold text-lg mb-2 line-clamp-1"><?= $top[1]['title'] ?></h3>
            <p class="text-gray-600 mb-4 line-clamp-2 text-sm"><?= $top[1]['description'] ?></p>
            <div class="flex items-center gap-2 flex-wrap text-sm">
              <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-lg text-gray-700 border border-slate-200"><?= $top[1]['name'] ?></span>
              <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-lg text-gray-700 border border-slate-200"><?= $top[1]['event_date'] ?></span>
            </div>
          </div>
        </div>
        
        <div class="relative overflow-hidden bg-gradient-to-br from-emerald-50 to-teal-50 border-2 rounded-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
          <div class="absolute top-0 right-0 w-32 h-32 opacity-20">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-full blur-3xl"></div>
          </div>
          <div class="relative p-6">
            <div class="flex items-start justify-between mb-4">
              <div class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white px-4 py-2 rounded-xl flex items-center gap-2 shadow-lg">
                <span>⭐</span> <span class="font-medium">#3</span>
              </div>
              <div class="flex items-center gap-2 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-xl border border-slate-200 shadow-md">
                <span>👥</span><?= $top[2]['current_participants'] ?> Terdaftar<span class="text-gray-900 font-medium"></span>
              </div>
            </div>
            <h3 class="text-gray-900 font-semibold text-lg mb-2 line-clamp-1"><?= $top[2]['title'] ?></h3>
            <p class="text-gray-600 mb-4 line-clamp-2 text-sm"><?= $top[2]['description'] ?></p>
            <div class="flex items-center gap-2 flex-wrap text-sm">
              <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-lg text-gray-700 border border-slate-200"><?= $top[2]['name'] ?></span>
              <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-lg text-gray-700 border border-slate-200"><?= $top[0]['event_date'] ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>