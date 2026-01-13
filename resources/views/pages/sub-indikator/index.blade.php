@extends('layout.app')

@section('title', 'Data Sub Indikator')

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
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-white mb-2">Data Sub Indikator</h1>
                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Kelola data sub indikator penilaian</p>
            </div>
            <a href="{{ route('sub-indikator.create') }}" class="w-full sm:w-auto px-5 py-2.5 bg-gradient-to-r from-[#0093FF] to-[#00A8FF] text-white text-sm font-medium rounded-2xl hover:from-[#00A8FF] hover:to-[#0093FF] transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Tambah Sub Indikator</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Sub Indikator</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalSubIndikator }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center">
                    <i data-lucide="list" class="w-6 h-6 text-blue-500 dark:text-blue-400"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Indikator Dengan Sub</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $indikatorWithSub }}</p>
                </div>
                <div class="w-12 h-12 bg-green-50 dark:bg-green-900/30 rounded-2xl flex items-center justify-center">
                    <i data-lucide="clipboard-list" class="w-6 h-6 text-green-500 dark:text-green-400"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Bobot Sub</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ number_format($totalBobot ?? 0, 1) }}%</p>
                </div>
                <div class="w-12 h-12 bg-purple-50 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center">
                    <i data-lucide="percent" class="w-6 h-6 text-purple-500 dark:text-purple-400"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Sub Indikator Table -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <!-- Table Header -->
        <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800">
            <form method="GET" action="{{ route('sub-indikator.index') }}" id="filterForm">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                    <div class="flex-1 w-full sm:w-auto flex gap-3">
                        <div class="relative flex-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="search" class="w-5 h-5 text-gray-400"></i>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari sub indikator..." class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all" onkeyup="this.form.submit()">
                        </div>
                        <div class="relative">
                            <select name="indikator_id" onchange="this.form.submit()" class="px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all appearance-none pr-10">
                                <option value="">Semua Indikator</option>
                                @foreach($indikators as $indikator)
                                    <option value="{{ $indikator->id }}" {{ request('indikator_id') == $indikator->id ? 'selected' : '' }}>
                                        {{ $indikator->nama_indikator }} ({{ $indikator->periode ? $indikator->periode->tahun : '-' }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                            </div>
                            @if(request('indikator_id'))
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
                        <th class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Nama Sub Indikator</th>
                        <th class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider hidden md:table-cell">Indikator</th>
                        <th class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider hidden lg:table-cell">Bobot (%)</th>
                        <th class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @if(count($subIndikators) > 0)
                        @foreach($subIndikators as $subIndikator)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                <!-- Nama Sub Indikator -->
                                <td class="px-4 sm:px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-[#0093FF] to-[#00A8FF] rounded-lg flex items-center justify-center flex-shrink-0">
                                            <i data-lucide="list" class="w-5 h-5 text-white"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-gray-800 dark:text-white">{{ $subIndikator->nama_sub_indikator }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 md:hidden">
                                                {{ $subIndikator->indikator ? $subIndikator->indikator->nama_indikator : '-' }} • {{ $subIndikator->bobot_sub_persen ? number_format($subIndikator->bobot_sub_persen, 1) . '%' : '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Indikator -->
                                <td class="px-4 sm:px-6 py-4 hidden md:table-cell">
                                    @if($subIndikator->indikator)
                                        <div>
                                            <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $subIndikator->indikator->nama_indikator }}</p>
                                            @if($subIndikator->indikator->periode)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 mt-1">
                                                    <i data-lucide="calendar" class="w-3 h-3 mr-1"></i>
                                                    {{ $subIndikator->indikator->periode->tahun }}
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-400 dark:text-gray-500">-</span>
                                    @endif
                                </td>

                                <!-- Bobot -->
                                <td class="px-4 sm:px-6 py-4 hidden lg:table-cell">
                                    @if($subIndikator->bobot_sub_persen)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                                            <i data-lucide="percent" class="w-3 h-3 mr-1"></i>
                                            {{ number_format($subIndikator->bobot_sub_persen, 1) }}%
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-400 dark:text-gray-500">-</span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="px-4 sm:px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('sub-indikator.edit', $subIndikator->id) }}" class="p-2 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition-colors" title="Edit">
                                            <i data-lucide="edit-2" class="w-4 h-4"></i>
                                        </a>
                                        <form action="{{ route('sub-indikator.destroy', $subIndikator->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sub indikator ini?')">
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
                            <td colspan="4" class="px-4 sm:px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                        <i data-lucide="list" class="w-8 h-8 text-gray-400"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Tidak ada data sub indikator</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-500">
                                            @if(request('search'))
                                                Tidak ditemukan hasil untuk "{{ request('search') }}"
                                            @else
                                                Klik tombol "Tambah Sub Indikator" untuk menambah data baru
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
        @if($subIndikators->hasPages())
            <div class="px-4 sm:px-6 py-4 border-t border-gray-100 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Menampilkan <span class="font-semibold">{{ $subIndikators->firstItem() }}</span>
                        sampai <span class="font-semibold">{{ $subIndikators->lastItem() }}</span>
                        dari <span class="font-semibold">{{ $subIndikators->total() }}</span> data
                    </p>
                    <div class="flex items-center gap-2">
                        {{ $subIndikators->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
