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
                    <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 'organizer' || $_SESSION['role'] == 'student')): ?>
                            <?php if(isset($_SESSION['token'])): ?>
                                <span class="flex items-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-2 rounded-md">
                                    <svg class="h-4 w-4 mr-2 " viewBox="0 0 24 24" style="width:20px">
                                        <path fill="currentColor"d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                        <path fill="currentColor"d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                        <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                    </svg>
                                    Connected
                                </span>
                            <?php else: ?>
                                <a href="index.php?page=connect" class="flex items-center px-4 py-2 rounded-md border border-blue-300 text-blue-700 hover:bg-blue-50 transition">
                                    <svg class="h-4 w-4 mr-2 " viewBox="0 0 24 24" style="width:20px">
                                        <path fill="currentColor"d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                        <path fill="currentColor"d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                        <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                    </svg>
                                    Connect
                                </a>
                            <?php endif; ?>
                        <?php endif;?>
                  <div class="bg-gradient-to-r from-slate-100 to-stone-100 px-4 py-2 rounded-xl border border-slate-200"> 
                        <div class="flex items-center gap-2">
                            <span class="text-xl">👤</span>
                            <span class="text-gray-700 font-medium"><?php echo $_SESSION['name'] ?>  </span>
                            <span class="px-2 py-1 text-xs font-semibold rounded-md bg-gradient-to-r from-emerald-600 to-teal-600 text-white to-gray-600 text-gray"><?= ucfirst($_SESSION['role']) ?></span>
                            
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
                <p class="text-gray-900 text-2xl font-bold"><?php echo count($data) ?></p>
            </div>
            <div class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl border-2 border-emerald-200 shadow-lg">
                <p class="text-gray-600 mb-1">Upcoming</p>
                <p class="text-gray-900 text-2xl font-bold"><?php echo count(array_column($data, 'status', 'published')) ?></p>
            </div>
            <div class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl border-2 border-amber-200 shadow-lg">
                <p class="text-gray-600 mb-1">Ongoing</p>
                <p class="text-gray-900 text-2xl font-bold"><?php echo count(array_column($data, 'status', 'cancelled')) ?></p>
            </div>
            <div class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl border-2 border-slate-200 shadow-lg">
                <p class="text-gray-600 mb-1">Completed</p>
                <p class="text-gray-900 text-2xl font-bold"><?php echo count(array_column($data, 'status', 'completed')) ?></p>
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
<?php require "components/EventDialog.php"; ?>

<?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'organizer' ): ?>
<script src="views/js/EventTambah.js"></script>

<script src="views/js/EventEdit.js"></script>
<?php endif; ?>

<script src="views/js/EventDetail.js"></script>
<script src="views/js/FilterJs/MainFilter.js"></script>
<script src="views/js/FilterJs/SearchInput.js"></script>


<script>
    const chartData = <?= json_encode($data); ?>;
    const labels = chartData.map(r =>  r.title).slice(0,5);
    const data = chartData.map(r => r.max_participants).slice(0,5);
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="views/js/Chart.js"></script>
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