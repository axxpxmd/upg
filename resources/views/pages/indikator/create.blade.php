@extends('layout.app')

@section('title', 'Tambah Indikator')

@section('content')
    <!-- Page Header -->
    <div class="mb-6 sm:mb-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-white mb-2">Tambah Indikator Baru</h1>
                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Isi formulir di bawah untuk menambahkan indikator baru</p>
            </div>
            <a href="{{ route('indikator.index') }}" class="w-full sm:w-auto px-5 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-2xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-all shadow-sm flex items-center justify-center gap-2">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <form action="{{ route('indikator.store') }}" method="POST" class="p-6 sm:p-8">
            @csrf

            <div class="mb-8">
                <div class="grid grid-cols-1 gap-6">
                    <!-- Nama Indikator -->
                    <div>
                        <label for="nama_indikator" class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="clipboard-list" class="w-4 h-4 text-[#0093FF]"></i>
                            Nama Indikator <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_indikator" name="nama_indikator" value="{{ old('nama_indikator') }}" required placeholder="Contoh: Tingkat Kepatuhan Pelaporan"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all @error('nama_indikator') border-red-500 @enderror">
                        @error('nama_indikator')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Periode -->
                        <div>
                            <label for="periode_id" class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i data-lucide="calendar" class="w-4 h-4 text-[#0093FF]"></i>
                                Periode <span class="text-red-500">*</span>
                            </label>
                            <select id="periode_id" name="periode_id" required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all @error('periode_id') border-red-500 @enderror">
                                <option value="">Pilih Periode</option>
                                @foreach($periodes as $periode)
                                    <option value="{{ $periode->id }}" {{ old('periode_id') == $periode->id ? 'selected' : '' }}>
                                        Tahun {{ $periode->tahun }} {{ $periode->is_active ? '(Aktif)' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('periode_id')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bobot Persen -->
                        <div>
                            <label for="bobot_persen" class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i data-lucide="percent" class="w-4 h-4 text-[#0093FF]"></i>
                                Bobot (%)
                            </label>
                            <input type="number" id="bobot_persen" name="bobot_persen" value="{{ old('bobot_persen') }}" step="0.01" min="0" max="100" placeholder="Contoh: 25.5"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all @error('bobot_persen') border-red-500 @enderror">
                            @error('bobot_persen')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-end">
                <a href="{{ route('indikator.index') }}" class="w-full sm:w-auto px-6 py-3 text-center bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                    Batal
                </a>
                <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-[#0093FF] to-[#00A8FF] text-white font-medium rounded-lg hover:from-[#00A8FF] hover:to-[#0093FF] transition-all shadow-lg hover:shadow-xl">
                    Simpan Indikator
                </button>
            </div>
        </form>
    </div>
@endsection
