<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-sm">
    <h2 class="text-2xl font-bold text-gray-800">Selamat Datang!</h2>
    <p class="text-xs mb-5">Masuk untuk melanjutkan ke Event Manager</p>
    <form action="#" method="POST" class="space-y-5">
      <!-- Email -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" name="email" placeholder="masukkan email" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Password -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" name="password" placeholder="masukkan password" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Button -->
      <button type="submit"
              class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
        Login
      </button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-5">
      Belum punya akun? <a href="#" class="text-blue-600 hover:underline">Daftar</a>
    </p>
  </div>
</body>
</html>