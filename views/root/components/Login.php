
  <div class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 transition duration-300" id="LoginCard">
    <div class="bg-white/80 backdrop-blur-lg p-8 rounded-3xl shadow-2xl border-2 border-slate-200 modal-box bg-white p-6 rounded-lg shadow-lg transform transition duration-300 scale-75" >
      <div class="flex flex-1">
        <div class="mb-8 text-center md:text-left">
          <h2 class="text-2xl font-semibold text-gray-900 mb-2">Selamat Datang! 👋</h2>
          <p class="text-gray-600">Masuk untuk melanjutkan ke Event Manager</p>
        </div>

        <button id="closeLogin" class="text-gray-500 hover:text-black flex-none">
          ✕
        </button>
      </div>
      <form id="loginForm" action="index.php?page=login" method="POST" class="space-y-6">
        <div class="space-y-2">
          <label for="email" class="block text-gray-700 font-medium">Email</label>
          <div class="relative">
            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">👤</span>
            <input type="text" id="email" name="email" placeholder="Masukkan email"
              class="w-full pl-10 border border-slate-200 rounded-lg py-2 focus:border-amber-400 focus:ring-amber-400 outline-none" required>
          </div>
        </div>

        <div class="space-y-2">
          <label for="password" class="block text-gray-700 font-medium">Password</label>
          <div class="relative">
            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">🔒</span>
            <input type="password" id="password" name="password" placeholder="Masukkan password"
              class="w-full pl-10 border border-slate-200 rounded-lg py-2 focus:border-amber-400 focus:ring-amber-400 outline-none" required>
          </div>
        </div>

        <div id="errorMsg" class="hidden p-3 bg-red-50 border border-red-200 rounded-lg">
          <p class="text-red-600 text-sm">Username atau password salah!</p>
        </div>

        <button type="submit"
          class="w-full py-2 rounded-lg text-white font-medium bg-gradient-to-r from-amber-600 via-yellow-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 shadow-lg hover:shadow-xl transition-all">
          Masuk
        </button>
      </form>

      <div class="mt-6 text-center">
        <p class="text-gray-600">
          Belum punya akun?
          <a href="index.php?page=register" class="text-transparent bg-clip-text bg-gradient-to-r from-amber-700 to-yellow-700 underline">
            Daftar disini
          </a>
        </p>
      </div>
    </div>

  </div>
</div>
  

