@extends('layout.app')

@section('title', 'Data Pengguna')

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
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-white mb-2">Data Pengguna</h1>
                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Kelola data pengguna sistem</p>
            </div>
            <a href="{{ route('pengguna.create') }}" class="w-full sm:w-auto px-5 py-2.5 bg-gradient-to-r from-[#0093FF] to-[#00A8FF] text-white text-sm font-medium rounded-2xl hover:from-[#00A8FF] hover:to-[#0093FF] transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                <i data-lucide="user-plus" class="w-4 h-4"></i>
                <span>Tambah Pengguna</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Pengguna</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalUsers }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center">
                    <i data-lucide="users" class="w-6 h-6 text-blue-500 dark:text-blue-400"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Administrator</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $adminCount }}</p>
                </div>
                <div class="w-12 h-12 bg-green-50 dark:bg-green-900/30 rounded-2xl flex items-center justify-center">
                    <i data-lucide="shield-check" class="w-6 h-6 text-green-500 dark:text-green-400"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Operator</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $operatorCount }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-50 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center">
                    <i data-lucide="user" class="w-6 h-6 text-purple-500 dark:text-purple-400"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Verifikator</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $verifikatorCount }}</p>
                </div>
                <div class="w-12 h-12 bg-orange-50 dark:bg-orange-900/30 rounded-2xl flex items-center justify-center">
                    <i data-lucide="user-check" class="w-6 h-6 text-orange-500 dark:text-orange-400"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <!-- Table Header -->
        <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800">
            <form method="GET" action="{{ route('pengguna.index') }}" id="filterForm">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                    <div class="flex-1 w-full sm:w-auto">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="search" class="w-5 h-5 text-gray-400"></i>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pengguna..." class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all" onkeyup="this.form.submit()">
                        </div>
                    </div>
                    <div class="flex gap-2 w-full sm:w-auto">
                        <div class="relative flex-1 sm:flex-none">
                            <button type="button" onclick="toggleFilterDropdown()" class="w-full px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors flex items-center justify-center gap-2">
                                <i data-lucide="filter" class="w-4 h-4"></i>
                                <span>Filter</span>
                                @if(request('role'))
                                    <span class="ml-1 px-2 py-0.5 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-full text-xs">1</span>
                                @endif
                            </button>
                            <!-- Filter Dropdown -->
                            <div id="filterDropdown" class="hidden absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 z-10">
                                <div class="p-4">
                                    <div class="flex items-center justify-between mb-3">
                                        <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Filter Role</h3>
                                        @if(request('role'))
                                            <a href="{{ route('pengguna.index', ['search' => request('search')]) }}" class="text-xs text-blue-600 dark:text-blue-400 hover:underline">Reset</a>
                                        @endif
                                    </div>
                                    <div class="space-y-2">
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="role" value="" {{ !request('role') ? 'checked' : '' }} onchange="this.form.submit()" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                            <span class="text-sm text-gray-700 dark:text-gray-300">Semua Role</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="role" value="admin" {{ request('role') == 'admin' ? 'checked' : '' }} onchange="this.form.submit()" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                            <span class="text-sm text-gray-700 dark:text-gray-300">Admin</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="role" value="operator" {{ request('role') == 'operator' ? 'checked' : '' }} onchange="this.form.submit()" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                            <span class="text-sm text-gray-700 dark:text-gray-300">Operator</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="role" value="verifikator" {{ request('role') == 'verifikator' ? 'checked' : '' }} onchange="this.form.submit()" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                            <span class="text-sm text-gray-700 dark:text-gray-300">Verifikator</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <th class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Pengguna</th>
                        <th class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Username</th>
                        <th class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider hidden md:table-cell">Jabatan</th>
                        <th class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider hidden lg:table-cell">OPD</th>
                        <th class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider hidden xl:table-cell">No. HP</th>
                        <th class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @if(count($users) > 0)
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                <!-- Pengguna -->
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-[#0093FF] to-[#00A8FF] rounded-full flex items-center justify-center flex-shrink-0">
                                            <span class="text-white font-semibold text-sm">{{ strtoupper(substr($user->nama, 0, 1)) }}</span>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-gray-800 dark:text-white truncate">{{ $user->nama }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $user->email ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Username -->
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-800 dark:text-white">{{ $user->username }}</span>
                                </td>

                                <!-- Jabatan -->
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden md:table-cell">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ $user->jabatan }}</span>
                                </td>

                                <!-- OPD -->
                                <td class="px-4 sm:px-6 py-4 hidden lg:table-cell">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                                        <i data-lucide="building-2" class="w-3 h-3 mr-1"></i>
                                        {{ $user->opd->n_opd ?? '-' }}
                                    </span>
                                </td>

                                <!-- No HP -->
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden xl:table-cell">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ $user->no_hp ?? '-' }}</span>
                                </td>

                                <!-- Aksi -->
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('pengguna.edit', $user) }}" class="p-2 text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/30 rounded-lg transition-colors" title="Edit">
                                            <i data-lucide="edit" class="w-4 h-4"></i>
                                        </a>
                                        <form action="{{ route('pengguna.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
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
                            <td colspan="6" class="px-4 sm:px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                        <i data-lucide="users" class="w-8 h-8 text-gray-400 dark:text-gray-500"></i>
                                    </div>
                                    <div>
                                        <p class="text-lg font-semibold text-gray-800 dark:text-white mb-1">Tidak Ada Data Pengguna</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada pengguna yang terdaftar dalam sistem</p>
                                    </div>
                                    <a href="{{ route('pengguna.create') }}" class="mt-2 px-5 py-2.5 bg-gradient-to-r from-[#0093FF] to-[#00A8FF] text-white text-sm font-medium rounded-lg hover:from-[#00A8FF] hover:to-[#0093FF] transition-all shadow-lg hover:shadow-xl flex items-center gap-2">
                                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                                        <span>Tambah Pengguna Pertama</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        <div class="px-4 sm:px-6 py-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                    Menampilkan <span class="font-semibold">1-{{ count($users) }}</span> dari <span class="font-semibold">{{ count($users) }}</span> pengguna
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

@push('scripts')
<script>
    function toggleFilterDropdown() {
        const dropdown = document.getElementById('filterDropdown');
        dropdown.classList.toggle('hidden');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('filterDropdown');
        const filterButton = event.target.closest('button[onclick="toggleFilterDropdown()"]');

        if (!filterButton && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
@endpush
