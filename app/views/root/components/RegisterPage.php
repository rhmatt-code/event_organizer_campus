<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Event Manager</title>
    <link rel="stylesheet" href="./app/views/src/output.css">
</head>
<body>

    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center ">
        <div class="w-full max-w-2xl gap-8 items-start">

            <div class="bg-white/80 backdrop-blur-lg p-8 shadow-2xl border-2 border-slate-200 rounded-2xl">
                <a href="index.php" type="button" id="backButton" class="mb-6 text-amber-700 hover:text-amber-800 hover:bg-amber-50 font-medium rounded-lg text-sm px-4 py-2 inline-flex items-center gap-2">
                    <span>←</span>
                    Kembali ke Login
                </a>

                <div class="mb-8">
                    <h2 class="text-gray-900 text-2xl font-bold mb-2">Buat Akun Baru 🎉</h2>
                    <p class="text-gray-600">Pilih jenis akun yang sesuai dengan kebutuhan Anda</p>
                </div>

                <div role="tabpanel" id="content-peserta">
                    <form id="pesertaForm" method="POST" class="space-y-4">
                        <div class="space-y-2">
                            <label for="fullname" class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                            <input id="fullname" name="fullname" type="text" placeholder="Masukkan nama lengkap" required class="block w-full rounded-md border-blue-200 focus:border-blue-400 focus:ring-blue-400 shadow-sm">
                        </div>
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                            <input id="email" name="email" type="email" placeholder="nama@email.com" required class="block w-full rounded-md border-blue-200 focus:border-blue-400 focus:ring-blue-400 shadow-sm">
                        </div>
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password *</label>
                            <input id="password" name="password" type="password" placeholder="Minimal 6 karakter" required minlength="6" class="block w-full rounded-md border-blue-200 focus:border-blue-400 focus:ring-blue-400 shadow-sm">
                        </div>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                            <p class="text-blue-800 text-sm">✅ Akun Peserta akan langsung aktif setelah pendaftaran</p>
                        </div>
                        <button type="submit" class="w-full text-white font-medium py-2.5 px-4 rounded-lg shadow-lg hover:shadow-xl transition-all bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700">
                            Daftar sebagai Peserta
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- <div id="toast" class="toast-hidden">
        <p id="toast-message">Pesan notifikasi</p>
    </div> -->

    <script src="/js/RegisterPage.js" defer></script>
</body>
</html>