@extends('layout.app')

@section('title', 'Data Periode')

@section('content')
    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg flex items-center gap-3">
            <i data-lucide="check-circle" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
            <p class="text-sm text-green-600 dark:text-green-400 font-medium">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg flex items-center gap-3">
            <i data-lucide="alert-circle" class="w-5 h-5 text-red-600 dark:text-red-400"></i>
            <p class="text-sm text-red-600 dark:text-red-400 font-medium">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Page Header -->
    <div class="mb-6 sm:mb-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-white mb-2">Data Periode</h1>
                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Kelola data periode penilaian gratifikasi</p>
            </div>
            <a href="{{ route('periode.create') }}" class="w-full sm:w-auto px-5 py-2.5 bg-gradient-to-r from-[#0093FF] to-[#00A8FF] text-white text-sm font-medium rounded-2xl hover:from-[#00A8FF] hover:to-[#0093FF] transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Tambah Periode</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Periode</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalPeriode }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center">
                    <i data-lucide="calendar-range" class="w-6 h-6 text-blue-500 dark:text-blue-400"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Periode Aktif</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $periodeAktif }}</p>
                </div>
                <div class="w-12 h-12 bg-green-50 dark:bg-green-900/30 rounded-2xl flex items-center justify-center">
                    <i data-lucide="check-circle" class="w-6 h-6 text-green-500 dark:text-green-400"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Periode Non-Aktif</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $periodeNonAktif }}</p>
                </div>
                <div class="w-12 h-12 bg-orange-50 dark:bg-orange-900/30 rounded-2xl flex items-center justify-center">
                    <i data-lucide="x-circle" class="w-6 h-6 text-orange-500 dark:text-orange-400"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Indikator</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalIndikator }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-50 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center">
                    <i data-lucide="clipboard-list" class="w-6 h-6 text-purple-500 dark:text-purple-400"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Periode Table -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <!-- Table Header -->
        <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800">
            <form method="GET" action="{{ route('periode.index') }}" id="filterForm">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                    <div class="flex-1 w-full sm:w-auto">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="search" class="w-5 h-5 text-gray-400"></i>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tahun periode..." class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all" onkeyup="this.form.submit()">
                        </div>
                    </div>
                    <div class="flex gap-2 w-full sm:w-auto">
                        <button type="button" class="flex-1 sm:flex-none px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors flex items-center justify-center gap-2">
                            <i data-lucide="download" class="w-4 h-4"></i>
                            <span class="hidden sm:inline">Export</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-900/50 border-b border-gray-100 dark:border-gray-700">
                        <th class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Tahun</th>
                        <th class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider hidden md:table-cell">Periode</th>
                        <th class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider hidden lg:table-cell">Jumlah Indikator</th>
                        <th class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @if(count($periodes) > 0)
                        @foreach($periodes as $periode)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                <!-- Tahun -->
                                <td class="px-4 sm:px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-[#0093FF] to-[#00A8FF] rounded-lg flex items-center justify-center flex-shrink-0">
                                            <i data-lucide="calendar" class="w-5 h-5 text-white"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-gray-800 dark:text-white">Tahun {{ $periode->tahun }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 md:hidden">
                                                {{ $periode->indikators_count }} Indikator
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Periode -->
                                <td class="px-4 sm:px-6 py-4 hidden md:table-cell">
                                    @if($periode->tgl_mulai && $periode->tgl_selesai)
                                        <div class="text-sm text-gray-600 dark:text-gray-400">
                                            <p>{{ \Carbon\Carbon::parse($periode->tgl_mulai)->format('d M Y') }}</p>
                                            <p class="text-xs text-gray-500">s/d {{ \Carbon\Carbon::parse($periode->tgl_selesai)->format('d M Y') }}</p>
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-400 dark:text-gray-500">-</span>
                                    @endif
                                </td>

                                <!-- Jumlah Indikator -->
                                <td class="px-4 sm:px-6 py-4 hidden lg:table-cell">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $periode->indikators_count > 0 ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }}">
                                        <i data-lucide="clipboard-list" class="w-3 h-3 mr-1"></i>
                                        {{ $periode->indikators_count }} Indikator
                                    </span>
                                </td>

                                <!-- Status -->
                                <td class="px-4 sm:px-6 py-4">
                                    @if($periode->is_active)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400">
                                            <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                                            <i data-lucide="x-circle" class="w-3 h-3 mr-1"></i>
                                            Non-Aktif
                                        </span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="px-4 sm:px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('periode.edit', $periode->id) }}" class="p-2 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition-colors" title="Edit">
                                            <i data-lucide="edit-2" class="w-4 h-4"></i>
                                        </a>
                                        <form action="{{ route('periode.destroy', $periode->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus periode ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors {{ $periode->indikators_count > 0 ? 'opacity-50 cursor-not-allowed' : '' }}" title="Hapus" {{ $periode->indikators_count > 0 ? 'disabled' : '' }}>
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="px-4 sm:px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                        <i data-lucide="calendar-range" class="w-8 h-8 text-gray-400"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Tidak ada data periode</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-500">
                                            @if(request('search'))
                                                Tidak ditemukan hasil untuk "{{ request('search') }}"
                                            @else
                                                Klik tombol "Tambah Periode" untuk menambah data baru
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($periodes->hasPages())
            <div class="px-4 sm:px-6 py-4 border-t border-gray-100 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Menampilkan <span class="font-semibold">{{ $periodes->firstItem() }}</span>
                        sampai <span class="font-semibold">{{ $periodes->lastItem() }}</span>
                        dari <span class="font-semibold">{{ $periodes->total() }}</span> data
                    </p>
                    <div class="flex items-center gap-2">
                        {{ $periodes->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
