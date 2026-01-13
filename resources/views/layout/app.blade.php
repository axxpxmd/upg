<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="UPG - Unit Pengendali Gratifikasi Kota Tangerang Selatan. Sistem manajemen dan pengelolaan data gratifikasi">
    <meta name="keywords" content="UPG, Unit Pengendali Gratifikasi, Tangerang Selatan, Gratifikasi">
    <meta name="author" content="Pemerintah Kota Tangerang Selatan">
    <title>@yield('title', 'Dashboard') - UPG Tangerang Selatan</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo/tangsel.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo/tangsel.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/tangsel.png') }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>

    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-200">

    <div class="flex h-screen overflow-hidden">

        <!-- Mobile Overlay -->
        <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-10 lg:hidden hidden transition-opacity duration-300"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-[#0063CB] fixed h-full overflow-y-auto z-20 -translate-x-full">
            <div class="p-4">
                <!-- Logo -->
                <div class="bg-white/10 p-4 rounded-lg mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center p-1">
                            <img src="{{ asset('images/logo/tangsel.png') }}" alt="Logo Tangsel" class="w-full h-full object-contain">
                        </div>
                        <div>
                            <p class="text-white font-box`ld text-base">UPG</p>
                            <p class="text-white/80 text-xs">Unit Pengendali Gratifikasi</p>
                        </div>
                    </div>
                </div>

                <!-- Menu Label -->
                <p class="text-white/60 text-xs font-medium px-3 mb-3">Menu</p>

                <!-- Navigation -->
                <nav class="space-y-1">
                    <!-- Beranda - Active -->
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-[#0093FF] bg-white rounded-lg">
                        <i data-lucide="home" class="w-5 h-5"></i>
                        <span>Beranda</span>
                    </a>

                    <!-- Dashboard -->
                    <div>
                        <a href="#" class="menu-item flex items-center justify-between px-3 py-2.5 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition-all group" data-submenu="dashboard-submenu">
                            <div class="flex items-center gap-3">
                                <i data-lucide="layout-grid" class="w-5 h-5"></i>
                                <span>Dashboard</span>
                            </div>
                            <i data-lucide="chevron-down" class="w-4 h-4 chevron-icon transition-transform duration-200"></i>
                        </a>
                        <div id="dashboard-submenu" class="submenu hidden ml-8 mt-1 space-y-1 overflow-hidden transition-all duration-200">
                            <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm text-white/90 hover:bg-white/10 rounded-lg transition-all">
                                <i data-lucide="layout" class="w-4 h-4"></i>
                                <span>Overview</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm text-white/90 hover:bg-white/10 rounded-lg transition-all">
                                <i data-lucide="activity" class="w-4 h-4"></i>
                                <span>Aktivitas</span>
                            </a>
                        </div>
                    </div>

                    <!-- Laporan -->
                    <div>
                        <a href="#" class="menu-item flex items-center justify-between px-3 py-2.5 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition-all group" data-submenu="laporan-submenu">
                            <div class="flex items-center gap-3">
                                <i data-lucide="file-text" class="w-5 h-5"></i>
                                <span>Laporan</span>
                            </div>
                            <i data-lucide="chevron-down" class="w-4 h-4 chevron-icon transition-transform duration-200"></i>
                        </a>
                        <div id="laporan-submenu" class="submenu hidden ml-8 mt-1 space-y-1 overflow-hidden transition-all duration-200">
                            <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm text-white/90 hover:bg-white/10 rounded-lg transition-all">
                                <i data-lucide="file-spreadsheet" class="w-4 h-4"></i>
                                <span>Laporan Bulanan</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm text-white/90 hover:bg-white/10 rounded-lg transition-all">
                                <i data-lucide="file-chart-column" class="w-4 h-4"></i>
                                <span>Laporan Tahunan</span>
                            </a>
                        </div>
                    </div>

                    <!-- Analitik -->
                    <div>
                        <a href="#" class="menu-item flex items-center justify-between px-3 py-2.5 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition-all group" data-submenu="analitik-submenu">
                            <div class="flex items-center gap-3">
                                <i data-lucide="bar-chart-2" class="w-5 h-5"></i>
                                <span>Analitik</span>
                            </div>
                            <i data-lucide="chevron-down" class="w-4 h-4 chevron-icon transition-transform duration-200 rotate-180"></i>
                        </a>

                        <!-- Submenu -->
                        <div id="analitik-submenu" class="submenu ml-8 mt-1 space-y-1 overflow-hidden transition-all duration-200">
                            <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm text-white/90 hover:bg-white/10 rounded-lg transition-all">
                                <i data-lucide="file-bar-chart" class="w-4 h-4"></i>
                                <span>Profil Data</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm text-white/90 hover:bg-white/10 rounded-lg transition-all">
                                <i data-lucide="trending-up" class="w-4 h-4"></i>
                                <span>Realisasi</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm text-white/90 hover:bg-white/10 rounded-lg transition-all">
                                <i data-lucide="share-2" class="w-4 h-4"></i>
                                <span>Diseminasi</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm text-white/90 hover:bg-white/10 rounded-lg transition-all">
                                <i data-lucide="target" class="w-4 h-4"></i>
                                <span>Kegiatan Utama</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm text-white/90 hover:bg-white/10 rounded-lg transition-all">
                                <i data-lucide="alert-triangle" class="w-4 h-4"></i>
                                <span>Identifikasi Risiko</span>
                            </a>
                        </div>
                    </div>

                    <!-- Transaksi -->
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition-all group">
                        <i data-lucide="wallet" class="w-5 h-5"></i>
                        <span>Transaksi</span>
                    </a>

                    <!-- Pengguna -->
                    <a href="{{ route('pengguna.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition-all group">
                        <i data-lucide="users" class="w-5 h-5"></i>
                        <span>Pengguna</span>
                    </a>

                    <!-- OPD -->
                    <a href="{{ route('opd.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition-all group">
                        <i data-lucide="building-2" class="w-5 h-5"></i>
                        <span>OPD</span>
                    </a>

                    <!-- Indikator -->
                    <a href="{{ route('indikator.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition-all group">
                        <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                        <span>Indikator</span>
                    </a>

                    <!-- Sub Indikator -->
                    <a href="{{ route('sub-indikator.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition-all group">
                        <i data-lucide="list" class="w-5 h-5"></i>
                        <span>Sub Indikator</span>
                    </a>

                    <!-- Pertanyaan -->
                    <a href="{{ route('pertanyaan.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition-all group">
                        <i data-lucide="help-circle" class="w-5 h-5"></i>
                        <span>Pertanyaan</span>
                    </a>

                    <!-- Periode -->
                    <a href="{{ route('periode.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition-all group">
                        <i data-lucide="calendar-range" class="w-5 h-5"></i>
                        <span>Periode</span>
                    </a>

                    <!-- Pengaturan -->
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-white hover:bg-white/10 rounded-lg transition-all group">
                        <i data-lucide="settings" class="w-5 h-5"></i>
                        <span>Pengaturan</span>
                    </a>
                </nav>

                <!-- Sidebar Footer -->
                <div class="mt-6 pt-6 border-t border-white/20">
                    <div class="px-3 py-2 text-white/60 text-xs">
                        <p class="flex items-center gap-2">
                            <i data-lucide="info" class="w-3 h-3"></i>
                            <span>UPG v1.0</span>
                        </p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div id="mainContent" class="flex-1 ml-0 lg:ml-64 overflow-y-auto bg-gradient-to-br from-gray-50 via-blue-50/20 to-cyan-50/20 dark:from-gray-900 dark:via-blue-950/10 dark:to-cyan-950/10 transition-all duration-300">

            <!-- Header -->
            <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-10 transition-colors duration-200">
                <div class="px-4 sm:px-6 lg:px-8 py-3 sm:py-4">
                    <div class="flex items-center justify-between">
                        <!-- Sidebar Toggle & Date Time -->
                        <div class="flex items-center gap-2 sm:gap-4">
                            <!-- Sidebar Toggle Button -->
                            <button id="sidebarToggle" class="p-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                <i data-lucide="menu" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                            </button>

                            <!-- Date & Time Info - Hidden on mobile -->
                            <div class="hidden sm:flex items-center gap-3 text-gray-700 dark:text-gray-300">
                                <i data-lucide="calendar" class="w-5 h-5 text-[#0093FF]"></i>
                                <div>
                                    <p class="text-sm font-semibold" id="currentDate">12 Januari 2026</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400" id="currentTime">14:30:00 WIB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Info -->
                        <div class="flex items-center gap-2 sm:gap-4">
                            <!-- Dark Mode Toggle -->
                            <button id="darkModeToggle" class="p-2 text-gray-600 dark:text-gray-300 hover:bg-gradient-to-br hover:from-gray-50 hover:to-blue-50/50 dark:hover:from-gray-700 dark:hover:to-blue-900/20 rounded-2xl transition-all">
                                <i data-lucide="moon" class="w-5 h-5 sm:w-6 sm:h-6 dark:hidden"></i>
                                <i data-lucide="sun" class="w-5 h-5 sm:w-6 sm:h-6 hidden dark:block text-yellow-400"></i>
                            </button>

                            <!-- Notifications -->
                            <button class="relative p-2 text-gray-600 dark:text-gray-300 hover:bg-gradient-to-br hover:from-gray-50 hover:to-blue-50/50 dark:hover:from-gray-700 dark:hover:to-blue-900/20 rounded-2xl transition-all">
                                <i data-lucide="bell" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                            </button>

                            <!-- Profile - Responsive -->
                            <div class="relative">
                                <button id="profileDropdownToggle" class="flex items-center gap-2 sm:gap-3 px-2 sm:px-4 py-2 bg-gray-50 dark:bg-gray-700 rounded-2xl cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                        @auth
                                            <span class="text-white font-semibold text-xs sm:text-sm">{{ strtoupper(substr(Auth::user()->nama, 0, 2)) }}</span>
                                        @else
                                            <span class="text-white font-semibold text-xs sm:text-sm">??</span>
                                        @endauth
                                    </div>
                                    <div class="text-sm hidden md:block">
                                        @auth
                                            <p class="font-semibold text-gray-800 dark:text-white">{{ Auth::user()->nama }}</p>
                                            <p class="text-gray-500 dark:text-gray-400 text-xs">{{ Auth::user()->jabatan }}</p>
                                        @else
                                            <p class="font-semibold text-gray-800 dark:text-white">Guest</p>
                                            <p class="text-gray-500 dark:text-gray-400 text-xs">-</p>
                                        @endauth
                                    </div>
                                    <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400 hidden md:block transition-transform duration-200" id="profileChevron"></i>
                                </button>

                                <!-- Dropdown Menu -->
                                <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden z-50">
                                    @auth
                                        <!-- User Info -->
                                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                            <p class="text-sm font-semibold text-gray-800 dark:text-white">{{ Auth::user()->nama }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ Auth::user()->username }}</p>
                                            @if(Auth::user()->email)
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ Auth::user()->email }}</p>
                                            @endif
                                        </div>

                                        <!-- OPD Info -->
                                        @if(Auth::user()->opd)
                                            <div class="px-4 py-2 bg-blue-50 dark:bg-blue-900/20">
                                                <div class="flex items-start gap-2">
                                                    <i data-lucide="building" class="w-4 h-4 text-blue-600 dark:text-blue-400 mt-0.5 flex-shrink-0"></i>
                                                    <div>
                                                        <p class="text-xs font-medium text-blue-700 dark:text-blue-300">OPD</p>
                                                        <p class="text-xs text-blue-600 dark:text-blue-400 mt-0.5">{{ Auth::user()->opd->n_opd }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Menu Items -->
                                        <div class="py-2">
                                            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                                <i data-lucide="user" class="w-4 h-4"></i>
                                                <span>Profil Saya</span>
                                            </a>
                                            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                                <i data-lucide="settings" class="w-4 h-4"></i>
                                                <span>Pengaturan</span>
                                            </a>
                                        </div>

                                        <!-- Logout -->
                                        <div class="border-t border-gray-200 dark:border-gray-700">
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                                    <i data-lucide="log-out" class="w-4 h-4"></i>
                                                    <span>Keluar</span>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="px-4 py-3">
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Anda belum login</p>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="p-4 sm:p-6 lg:p-8">
                @yield('content')
            </main>

        </div>

    </div>

    <!-- Initialize Dark Mode First -->
    <script>
        // Check for saved dark mode preference or default to light mode
        const html = document.documentElement;
        if (localStorage.getItem('darkMode') === 'true' ||
            (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
        }
    </script>

    <!-- Initialize Lucide Icons and Dark Mode Toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Lucide Icons
            lucide.createIcons();

            // Sidebar Toggle
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            let sidebarOpen = false; // Start closed on mobile

            if (sidebarToggle && sidebar && mainContent && sidebarOverlay) {
                // Initialize sidebar state based on screen size
                if (window.innerWidth >= 1024) {
                    // Desktop: check saved state
                    const savedState = localStorage.getItem('sidebarOpen');
                    sidebarOpen = savedState !== 'false'; // Default open on desktop
                    if (!sidebarOpen) {
                        sidebar.classList.add('-translate-x-full');
                        mainContent.classList.remove('lg:ml-64');
                        mainContent.classList.add('lg:ml-0');
                    } else {
                        sidebar.classList.remove('-translate-x-full');
                        mainContent.classList.add('lg:ml-64');
                    }
                } else {
                    // Mobile: always start closed
                    sidebar.classList.add('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                }

                // Add transition after initialization to prevent animation on page load
                setTimeout(() => {
                    sidebar.classList.add('transition-all', 'duration-300');
                }, 50);

                // Toggle sidebar
                sidebarToggle.addEventListener('click', () => {
                    sidebarOpen = !sidebarOpen;

                    if (sidebarOpen) {
                        sidebar.classList.remove('-translate-x-full');
                        if (window.innerWidth >= 1024) {
                            mainContent.classList.remove('lg:ml-0');
                            mainContent.classList.add('lg:ml-64');
                        } else {
                            sidebarOverlay.classList.remove('hidden');
                        }
                    } else {
                        sidebar.classList.add('-translate-x-full');
                        if (window.innerWidth >= 1024) {
                            mainContent.classList.remove('lg:ml-64');
                            mainContent.classList.add('lg:ml-0');
                        } else {
                            sidebarOverlay.classList.add('hidden');
                        }
                    }

                    // Save state only on desktop
                    if (window.innerWidth >= 1024) {
                        localStorage.setItem('sidebarOpen', sidebarOpen);
                    }

                    // Reinitialize icons after animation
                    setTimeout(() => {
                        lucide.createIcons();
                    }, 300);
                });

                // Close sidebar when clicking overlay on mobile
                sidebarOverlay.addEventListener('click', () => {
                    sidebarOpen = false;
                    sidebar.classList.add('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                });

                // Handle window resize
                window.addEventListener('resize', () => {
                    if (window.innerWidth >= 1024) {
                        // Desktop mode
                        sidebarOverlay.classList.add('hidden');
                        const savedState = localStorage.getItem('sidebarOpen');
                        sidebarOpen = savedState !== 'false';
                        if (!sidebarOpen) {
                            sidebar.classList.add('-translate-x-full');
                            mainContent.classList.remove('lg:ml-64');
                            mainContent.classList.add('lg:ml-0');
                        } else {
                            sidebar.classList.remove('-translate-x-full');
                            mainContent.classList.remove('lg:ml-0');
                            mainContent.classList.add('lg:ml-64');
                        }
                    } else {
                        // Mobile mode - always close
                        sidebar.classList.add('-translate-x-full');
                        sidebarOverlay.classList.add('hidden');
                        sidebarOpen = false;
                    }
                });
            }

            // Dark Mode Toggle
            const darkModeToggle = document.getElementById('darkModeToggle');
            const html = document.documentElement;

            if (darkModeToggle) {
                darkModeToggle.addEventListener('click', () => {
                    html.classList.toggle('dark');
                    localStorage.setItem('darkMode', html.classList.contains('dark'));
                    // Reinitialize icons after toggle
                    setTimeout(() => {
                        lucide.createIcons();
                    }, 10);
                });
            }

            // Update Date & Time
            function updateDateTime() {
                const now = new Date();

                // Format tanggal
                const options = { day: 'numeric', month: 'long', year: 'numeric' };
                const dateStr = now.toLocaleDateString('id-ID', options);

                // Format waktu
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                const timeStr = `${hours}:${minutes}:${seconds} WIB`;

                // Update DOM
                const dateElement = document.getElementById('currentDate');
                const timeElement = document.getElementById('currentTime');

                if (dateElement) dateElement.textContent = dateStr;
                if (timeElement) timeElement.textContent = timeStr;
            }

            // Update setiap detik
            updateDateTime();
            setInterval(updateDateTime, 1000);

            // Menu Toggle Functionality
            const menuItems = document.querySelectorAll('.menu-item');

            menuItems.forEach(item => {
                item.addEventListener('click', (e) => {
                    e.preventDefault();

                    const submenuId = item.getAttribute('data-submenu');
                    const submenu = document.getElementById(submenuId);
                    const chevron = item.querySelector('.chevron-icon');

                    if (submenu && chevron) {
                        // Toggle submenu visibility
                        submenu.classList.toggle('hidden');

                        // Rotate chevron icon
                        chevron.classList.toggle('rotate-180');

                        // Reinitialize icons after animation
                        setTimeout(() => {
                            lucide.createIcons();
                        }, 200);
                    }
                });
            });

            // Profile Dropdown Toggle
            const profileDropdownToggle = document.getElementById('profileDropdownToggle');
            const profileDropdown = document.getElementById('profileDropdown');
            const profileChevron = document.getElementById('profileChevron');

            if (profileDropdownToggle && profileDropdown) {
                profileDropdownToggle.addEventListener('click', (e) => {
                    e.stopPropagation();
                    profileDropdown.classList.toggle('hidden');
                    if (profileChevron) {
                        profileChevron.classList.toggle('rotate-180');
                    }
                    // Reinitialize icons
                    setTimeout(() => {
                        lucide.createIcons();
                    }, 10);
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', (e) => {
                    if (!profileDropdown.contains(e.target) && !profileDropdownToggle.contains(e.target)) {
                        profileDropdown.classList.add('hidden');
                        if (profileChevron) {
                            profileChevron.classList.remove('rotate-180');
                        }
                    }
                });
            }
        });
    </script>

    @stack('scripts')

</body>
</html>
