<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Event Manager</title>
    <link rel="stylesheet" href="./views/src/output.css">
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    
    <style>
        [data-state=active] {
            background-color: white;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        }
        button[data-state=active] {
            background-image: linear-gradient(to right, var(--tw-gradient-stops));
            --tw-gradient-from: #ca8a04;
            --tw-gradient-to: #eab308;
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            color: white;
        }

        .event-wrapper {
            max-height: 500px;
            overflow-y: auto;
        }

        #popupContainer {
            display: none;
        }
        #popupContainer.show {
            display: flex;
        }

    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 via-stone-50 to-zinc-50">
<!-- Navbar -->
    <header class="bg-white/80 backdrop-blur-lg border-b border-slate-200 sticky top-0 z-40 shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="bg-gradient-to-br from-amber-600 via-yellow-600 to-amber-700 p-3 rounded-xl shadow-lg">
                        <span class="text-3xl">📅</span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-amber-700 via-yellow-700 to-amber-800">
                            Event Manager
                        </h1>
                        <p class="text-gray-600 text-sm">Platform Manajemen Event Premium</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                  <?php if(isset($_SESSION['name'])): ?>
                  <div class="bg-gradient-to-r from-slate-100 to-stone-100 px-4 py-2 rounded-xl border border-slate-200"> 
                        <div class="flex items-center gap-2">
                            <span class="text-xl">👤</span>
                            <span class="text-gray-700 font-medium"><?php echo $_SESSION['name'] ?>  </span>
                            <span class="px-2 py-1 text-xs rounded-md bg-gradient-to-r from-slate-600 to-gray-600 text-gray"><?= $_SESSION['role'] ?></span>
                            <?php if(isset($_SESSION['token'])): ?>
                                <span>Connected</span>
                            <?php else: ?>
                                <a href="">Connect</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <a href="index.php?page=logout"><button type="button" class="inline-flex items-center gap-2 px-4 py-2 border border-red-200 text-red-600 rounded-lg hover:bg-red-50 hover:border-red-300 text-sm font-medium">
                        <span>🔒</span>
                        Logout
                    </button></a>
                  <?php else: ?>
                    <button id="openLogin" class="inline-flex items-center gap-2 px-4 py-2 border border-red-200 text-red-600 rounded-lg hover:bg-red-50 hover:border-red-300 text-sm font-medium">
                        Login
                    </button>
                  <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
<!--  -->

<!-- Form Admin -->
<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'):?>
    <?php include "components/ListUsers.php"; ?>
<?php else: ?>
<!--  -->
<!-- Card Event Paling Diminati -->
    <?php include "components/PopularEvent.php" ?>
<!--  -->
<!-- Total Event -->
    <div class="container mx-auto px-4 py-8">
        <div id="popular-events-placeholder" class="mb-8">
        </div>

        <div id="stats-cards" class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl border-2 border-slate-200 shadow-lg">
                <p class="text-gray-600 mb-1">Total Event</p>
                <p class="text-gray-900 text-2xl font-bold">0</p>
            </div>
            <div class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl border-2 border-emerald-200 shadow-lg">
                <p class="text-gray-600 mb-1">Upcoming</p>
                <p class="text-gray-900 text-2xl font-bold">0</p>
            </div>
            <div class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl border-2 border-amber-200 shadow-lg">
                <p class="text-gray-600 mb-1">Ongoing</p>
                <p class="text-gray-900 text-2xl font-bold">0</p>
            </div>
            <div class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl border-2 border-slate-200 shadow-lg">
                <p class="text-gray-600 mb-1">Completed</p>
                <p class="text-gray-900 text-2xl font-bold">0</p>
            </div>
        </div>
<!--  -->
<!-- Chart Event -->
      <div class="mb-6">
        <?php require "components/EventChart.php" ?>
      </div>

<!--  -->
<!-- List Event -->
        <div class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl shadow-lg border-2 border-slate-200 mb-8">
            <div class="flex flex-col md:flex-row gap-2 items-start justify-between">
                <div class="flex-1 w-full">
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">🔍</span>
                        <input
                            type="text"
                            id="searchInput"
                            placeholder="Cari event..."
                            class="pl-10 w-full rounded-md border-slate-200 focus:border-amber-400 focus:ring-amber-400 shadow-sm"
                        />
                    </div>
                </div>

                <div class="flex flex-wrap gap-2 items-center">
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'student'){ ?>
                    <div class="w-auto">
                        <div class="p-1 rounded-lg bg-slate-100">
                            <button data-state="inactive" id="EventSaya" class="px-4 py-1.5 rounded-md text-sm font-medium text-gray-600 inline-flex items-center gap-2">
                                <span>🎟️</span> Event Saya
                            </button>
                        </div>
                    </div>
                    <div class="w-auto">
                        <div class="p-1 rounded-lg bg-slate-100">
                            <button data-state="active" class="sort-btn px-3 py-1.5 rounded-md text-sm font-medium" data-sort="newest">Newest</button>
                            <button data-state="inactive" class="sort-btn px-3 py-1.5 rounded-md text-sm font-medium text-gray-600" data-sort="oldest">Oldest</button>
                        </div>
                    </div>
                    <?php }elseif(isset($_SESSION['role']) && $_SESSION['role'] === 'organizer'){ ?>
                    <div class="w-auto">
                        <div class="p-1 rounded-lg bg-slate-100">
                            <button data-state="active" class="filter-btn px-3 py-1.5 rounded-md text-sm font-medium" data-status="all">Semua</button>
                            <button data-state="inactive" class="filter-btn px-3 py-1.5 rounded-md text-sm font-medium text-gray-600" data-status="published">Published</button>
                            <button data-state="inactive" class="filter-btn px-3 py-1.5 rounded-md text-sm font-medium text-gray-600" data-status="cancelled">Cancelled</button>
                            <button data-state="inactive" class="filter-btn px-3 py-1.5 rounded-md text-sm font-medium text-gray-600" data-status="completed">Completed</button>
                        </div>
                    </div>
                     <button id="openTambah" type="button" class="text-white font-medium py-2.5 px-4 rounded-lg shadow-lg hover:shadow-xl transition-all bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700">
                        <span class="mr-2">➕</span>
                        Tambah Event
                    </button>
                    
                    <script src="views/js/EventTambah.js"></script>
                    <?php }; ?>
                </div>
            </div>
        </div>
        <!-- Card Event -->
         <?php if(!empty($data)) :?>
        <div id="eventCard">
          <?php require "components/EventCard.php" ?>
        </div>
        <?php else: ?>
        <!--  -->
        <div id="emptyMessage" class="text-center py-12 bg-white/80 backdrop-blur-sm rounded-2xl border-2 border-slate-200">
            <span class="text-7xl">🗓️</span>
            <h3 class="text-gray-900 text-xl font-semibold mt-4 mb-2">Tidak ada event</h3>
            <p class="text-gray-600">Saat ini belum ada Event Baru</p>
        </div>
        <?php endif; ?>
    </div>

<?php include "components/Login.php"; ?> 
<?php include "components/EventEdit.php"; ?>
<?php include "components/EventDialog.html" ?>; 

<script src="views/js/EventDetail.js"></script>
<script src="views/js/EventEdit.js"></script>
<script src="views/js/FilterJs/MainFilter.js"></script>
<script src="views/js/FilterJs/SearchInput.js"></script>
<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'organizer'): ?>
    <script src="views/js/FilterJs/ButtonFilter.js"></script>
<?php elseif(isset($_SESSION['role']) && $_SESSION['role'] == 'student'): ;?>
    <script src="views/js/FilterJs/ButtonEventSaya.js"></script>
    <script src="views/js/FilterJs/ButtonNewest.js"></script>
<?php else: ?>
    <script src="views/js/Login.js"></script>
<?php endif;?>
<?php endif; ?></body>
</html>