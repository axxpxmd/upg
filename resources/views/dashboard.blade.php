@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
    @php
        // Dummy data untuk stat cards
        $stats = [
            [
                'title' => 'Total Investasi',
                'value' => 'Rp 125.500.000',
                'change' => '+12.5%',
                'trend' => 'up',
                'icon' => 'trending-up',
                'color' => 'blue'
            ],
            [
                'title' => 'Profit',
                'value' => 'Rp 18.750.000',
                'change' => '+8.2%',
                'trend' => 'up',
                'icon' => 'dollar-sign',
                'color' => 'green'
            ],
            [
                'title' => 'User Aktif',
                'value' => '2,847',
                'change' => '+24.1%',
                'trend' => 'up',
                'icon' => 'users',
                'color' => 'purple'
            ],
            [
                'title' => 'Pending',
                'value' => '142',
                'change' => '-5.3%',
                'trend' => 'down',
                'icon' => 'clock',
                'color' => 'orange'
            ]
        ];

        // Dummy data untuk tabel aktivitas
        $activities = [
            [
                'id' => 'TRX-001',
                'user' => 'Ahmad Wijaya',
                'type' => 'Deposit',
                'amount' => 'Rp 5.000.000',
                'status' => 'Selesai',
                'date' => '12 Jan 2026, 14:30'
            ],
            [
                'id' => 'TRX-002',
                'user' => 'Siti Nurhaliza',
                'type' => 'Withdraw',
                'amount' => 'Rp 2.500.000',
                'status' => 'Proses',
                'date' => '12 Jan 2026, 13:15'
            ],
            [
                'id' => 'TRX-003',
                'user' => 'Budi Santoso',
                'type' => 'Deposit',
                'amount' => 'Rp 10.000.000',
                'status' => 'Selesai',
                'date' => '12 Jan 2026, 11:45'
            ],
            [
                'id' => 'TRX-004',
                'user' => 'Rina Permata',
                'type' => 'Transfer',
                'amount' => 'Rp 3.750.000',
                'status' => 'Proses',
                'date' => '12 Jan 2026, 10:20'
            ],
            [
                'id' => 'TRX-005',
                'user' => 'Dedi Kurniawan',
                'type' => 'Deposit',
                'amount' => 'Rp 7.500.000',
                'status' => 'Selesai',
                'date' => '11 Jan 2026, 16:50'
            ],
            [
                'id' => 'TRX-006',
                'user' => 'Maya Sari',
                'type' => 'Withdraw',
                'amount' => 'Rp 4.200.000',
                'status' => 'Selesai',
                'date' => '11 Jan 2026, 15:30'
            ]
        ];
    @endphp

    <!-- Welcome Section -->
    <div class="mb-6 sm:mb-8 bg-gradient-to-r from-[#0093FF] to-[#00A8FF] p-6 sm:p-8 rounded-2xl shadow-lg">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex-1">
                <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">Selamat Datang Kembali, {{ Auth::user()->nama }}! 👋</h1>
                <p class="text-sm sm:text-base text-blue-50 mb-3">Berikut adalah ringkasan aktivitas hari ini</p>
                <div class="flex flex-wrap items-center gap-4 text-sm text-white/90">
                    <div class="flex items-center gap-2">
                        <i data-lucide="shield" class="w-4 h-4"></i>
                        <span>{{ ucfirst(Auth::user()->role) }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="building-2" class="w-4 h-4"></i>
                        <span>{{ Auth::user()->opd->n_opd ?? 'N/A' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span>{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
                    </div>
                </div>
            </div>
            <div class="flex gap-3">
                <div class="bg-white/10 backdrop-blur-sm px-4 py-3 rounded-xl border border-white/20">
                    <p class="text-xs text-white/70 mb-1">Laporan Pending</p>
                    <p class="text-2xl font-bold text-white">12</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm px-4 py-3 rounded-xl border border-white/20">
                    <p class="text-xs text-white/70 mb-1">Butuh Verifikasi</p>
                    <p class="text-2xl font-bold text-white">8</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
        @foreach($stats as $stat)
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all relative overflow-hidden group">
                <!-- Colored accent bar -->
                <div class="absolute top-0 left-0 w-1 h-full
                    @if($stat['color'] === 'blue') bg-gradient-to-b from-blue-400 to-blue-600
                    @elseif($stat['color'] === 'green') bg-gradient-to-b from-green-400 to-green-600
                    @elseif($stat['color'] === 'purple') bg-gradient-to-b from-purple-400 to-purple-600
                    @else bg-gradient-to-b from-orange-400 to-orange-600
                    @endif opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center
                        @if($stat['color'] === 'blue') bg-blue-50 dark:bg-blue-900/30
                        @elseif($stat['color'] === 'green') bg-green-50 dark:bg-green-900/30
                        @elseif($stat['color'] === 'purple') bg-purple-50 dark:bg-purple-900/30
                        @else bg-orange-50 dark:bg-orange-900/30
                        @endif">
                        <i data-lucide="{{ $stat['icon'] }}" class="w-6 h-6
                            @if($stat['color'] === 'blue') text-blue-500 dark:text-blue-400
                            @elseif($stat['color'] === 'green') text-green-500 dark:text-green-400
                            @elseif($stat['color'] === 'purple') text-purple-500 dark:text-purple-400
                            @else text-orange-500 dark:text-orange-400
                            @endif"></i>
                    </div>
                    <span class="text-xs font-medium px-3 py-1 rounded-full
                        @if($stat['trend'] === 'up') bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400
                        @else bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400
                        @endif">
                        {{ $stat['change'] }}
                    </span>
                </div>
                <h3 class="text-gray-600 dark:text-gray-400 text-sm font-medium mb-1">{{ $stat['title'] }}</h3>
                <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $stat['value'] }}</p>
            </div>
        @endforeach
    </div>

    <!-- Activity Table -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-blue-50/30 dark:from-gray-800 dark:to-blue-900/10">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0">
                <div>
                    <h2 class="text-lg sm:text-xl font-bold text-gray-800 dark:text-white">Aktivitas Terbaru</h2>
                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Transaksi dan aktivitas pengguna terkini</p>
                </div>
                <button class="w-full sm:w-auto px-4 sm:px-5 py-2.5 bg-[#0093FF] text-white text-sm font-medium rounded-2xl hover:bg-[#0070CC] transition-colors shadow-sm flex items-center justify-center gap-2">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Transaksi Baru</span>
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-900/50 border-b border-gray-100 dark:border-gray-700">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">ID Transaksi</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Pengguna</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($activities as $activity)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-semibold text-gray-800 dark:text-white">{{ $activity['id'] }}</span>
                                        </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-xs">{{ substr($activity['user'], 0, 1) }}</span>
                                    </div>
                                    <span class="text-sm font-medium text-gray-800 dark:text-white">{{ $activity['user'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="inline-flex items-center gap-2">
                                        @if($activity['type'] === 'Deposit')
                                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                        @elseif($activity['type'] === 'Withdraw')
                                            <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                        @else
                                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                        @endif
                                        {{ $activity['type'] }}
                                    </span>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-semibold text-gray-800 dark:text-white">{{ $activity['amount'] }}</span>
                                        </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($activity['status'] === 'Selesai')
                                    <span class="px-3 py-1.5 text-xs font-medium bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 rounded-full">
                                        {{ $activity['status'] }}
                                    </span>
                                @else
                                    <span class="px-3 py-1.5 text-xs font-medium bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 rounded-full">
                                        {{ $activity['status'] }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $activity['date'] }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                                <i data-lucide="more-vertical" class="w-5 h-5"></i>
                                            </button>
                                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Table Footer / Pagination -->
        <div class="px-4 sm:px-6 py-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-0">
                <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                    Menampilkan <span class="font-semibold">1-6</span> dari <span class="font-semibold">142</span> transaksi
                </p>
                <div class="flex gap-2 w-full sm:w-auto">
                    <button class="flex-1 sm:flex-none px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-2xl hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                        Previous
                    </button>
                    <button class="flex-1 sm:flex-none px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-white bg-[#0093FF] rounded-2xl hover:bg-[#0070CC] transition-colors">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
