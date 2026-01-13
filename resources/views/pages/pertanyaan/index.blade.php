@extends('layout.app')

@section('title', 'Data Pertanyaan')

@section('content')
    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg flex items-center gap-3">
            <i data-lucide="check-circle" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
            <p class="text-sm text-green-600 dark:text-green-400 font-medium">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Page Header -->
    <div class="mb-6 sm:mb-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-white mb-2">Data Pertanyaan</h1>
                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Kelola data pertanyaan penilaian</p>
            </div>
            <a href="{{ route('pertanyaan.create') }}" class="w-full sm:w-auto px-5 py-2.5 bg-gradient-to-r from-[#0093FF] to-[#00A8FF] text-white text-sm font-medium rounded-2xl hover:from-[#00A8FF] hover:to-[#0093FF] transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Tambah Pertanyaan</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-6 sm:mb-8">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Pertanyaan</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalPertanyaan }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center">
                    <i data-lucide="help-circle" class="w-6 h-6 text-blue-500 dark:text-blue-400"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Sub Indikator Dengan Pertanyaan</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $subIndikatorWithPertanyaan }}</p>
                </div>
                <div class="w-12 h-12 bg-green-50 dark:bg-green-900/30 rounded-2xl flex items-center justify-center">
                    <i data-lucide="list-checks" class="w-6 h-6 text-green-500 dark:text-green-400"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Pertanyaan Table -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <!-- Table Header -->
        <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800">
            <form method="GET" action="{{ route('pertanyaan.index') }}" id="filterForm">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                    <div class="flex-1 w-full sm:w-auto flex gap-3">
                        <div class="relative flex-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="search" class="w-5 h-5 text-gray-400"></i>
                            </div>
                            <input type="text" name="search" id="searchInput" value="{{ request('search') }}" placeholder="Cari pertanyaan..." class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all" onkeyup="debounceSearch(this)">
                            <div id="searchLoading" class="absolute inset-y-0 right-0 pr-3 flex items-center hidden">
                                <svg class="animate-spin h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="relative">
                            <select name="sub_indikator_id" onchange="this.form.submit()" class="px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all appearance-none pr-10">
                                <option value="">Semua Sub Indikator</option>
                                @foreach($subIndikators as $subIndikator)
                                    <option value="{{ $subIndikator->id }}" {{ request('sub_indikator_id') == $subIndikator->id ? 'selected' : '' }}>
                                        {{ $subIndikator->nama_sub_indikator }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                            </div>
                            @if(request('sub_indikator_id'))
                                <span class="absolute -top-1 -right-1 w-2 h-2 bg-blue-500 rounded-full"></span>
                            @endif
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
                        <th class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Pertanyaan</th>
                        <th class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider hidden lg:table-cell">Sub Indikator</th>
                        <th class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @if(count($pertanyaans) > 0)
                        @foreach($pertanyaans as $pertanyaan)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                <!-- Pertanyaan -->
                                <td class="px-4 sm:px-6 py-4">
                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-[#0093FF] to-[#00A8FF] rounded-lg flex items-center justify-center flex-shrink-0">
                                            <i data-lucide="help-circle" class="w-5 h-5 text-white"></i>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-sm text-gray-800 dark:text-white leading-relaxed">{{ $pertanyaan->n_pertanyaan }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 lg:hidden">
                                                {{ $pertanyaan->subIndikator ? $pertanyaan->subIndikator->nama_sub_indikator : '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Sub Indikator -->
                                <td class="px-4 sm:px-6 py-4 hidden lg:table-cell">
                                    @if($pertanyaan->subIndikator)
                                        <div>
                                            <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $pertanyaan->subIndikator->nama_sub_indikator }}</p>
                                            @if($pertanyaan->subIndikator->indikator)
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $pertanyaan->subIndikator->indikator->nama_indikator }}</p>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-400 dark:text-gray-500">-</span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="px-4 sm:px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('pertanyaan.edit', $pertanyaan->id) }}" class="p-2 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition-colors" title="Edit">
                                            <i data-lucide="edit-2" class="w-4 h-4"></i>
                                        </a>
                                        <form action="{{ route('pertanyaan.destroy', $pertanyaan->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors" title="Hapus">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="px-4 sm:px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                        <i data-lucide="help-circle" class="w-8 h-8 text-gray-400"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Tidak ada data pertanyaan</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-500">
                                            @if(request('search'))
                                                Tidak ditemukan hasil untuk "{{ request('search') }}"
                                            @else
                                                Klik tombol "Tambah Pertanyaan" untuk menambah data baru
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
        @if($pertanyaans->hasPages())
            <div class="px-4 sm:px-6 py-4 border-t border-gray-100 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Menampilkan <span class="font-semibold">{{ $pertanyaans->firstItem() }}</span>
                        sampai <span class="font-semibold">{{ $pertanyaans->lastItem() }}</span>
                        dari <span class="font-semibold">{{ $pertanyaans->total() }}</span> data
                    </p>
                    <div class="flex items-center gap-2">
                        {{ $pertanyaans->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script>
        let searchTimeout;

        function debounceSearch(input) {
            const loadingIcon = document.getElementById('searchLoading');

            // Show loading indicator
            loadingIcon.classList.remove('hidden');

            // Clear previous timeout
            clearTimeout(searchTimeout);

            // Set new timeout
            searchTimeout = setTimeout(function() {
                input.form.submit();
            }, 500);
        }
    </script>
@endsection
