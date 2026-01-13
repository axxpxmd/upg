@extends('layout.app')

@section('title', 'Tambah OPD')

@section('content')
    <!-- Page Header -->
    <div class="mb-6 sm:mb-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-white mb-2">Tambah OPD Baru</h1>
                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Isi formulir di bawah untuk menambahkan OPD baru</p>
            </div>
            <a href="{{ route('opd.index') }}" class="w-full sm:w-auto px-5 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-2xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-all shadow-sm flex items-center justify-center gap-2">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <form action="{{ route('opd.store') }}" method="POST" class="p-6 sm:p-8">
            @csrf

            <div class="mb-8">
                <div class="grid grid-cols-1 gap-6">
                    <!-- Nama OPD -->
                    <div>
                        <label for="n_opd" class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="building-2" class="w-4 h-4 text-[#0093FF]"></i>
                            Nama OPD <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="n_opd" name="n_opd" value="{{ old('n_opd') }}" required placeholder="Contoh: Dinas Komunikasi dan Informatika"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all @error('n_opd') border-red-500 @enderror">
                        @error('n_opd')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="map-pin" class="w-4 h-4 text-[#0093FF]"></i>
                            Alamat
                        </label>
                        <textarea id="alamat" name="alamat" rows="4" placeholder="Contoh: Jl. Maruga No. 1, Pondok Aren, Tangerang Selatan"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all resize-none @error('alamat') border-red-500 @enderror">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-end">
                <a href="{{ route('opd.index') }}" class="w-full sm:w-auto px-6 py-3 text-center bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                    Batal
                </a>
                <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-[#0093FF] to-[#00A8FF] text-white font-medium rounded-lg hover:from-[#00A8FF] hover:to-[#0093FF] transition-all shadow-lg hover:shadow-xl">
                    Simpan OPD
                </button>
            </div>
        </form>
    </div>
@endsection
