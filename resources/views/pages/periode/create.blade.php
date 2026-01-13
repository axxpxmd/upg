@extends('layout.app')

@section('title', 'Tambah Periode')

@section('content')
    <!-- Page Header -->
    <div class="mb-6 sm:mb-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-white mb-2">Tambah Periode Baru</h1>
                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Isi formulir di bawah untuk menambahkan periode baru</p>
            </div>
            <a href="{{ route('periode.index') }}" class="w-full sm:w-auto px-5 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-2xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-all shadow-sm flex items-center justify-center gap-2">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <form action="{{ route('periode.store') }}" method="POST" class="p-6 sm:p-8">
            @csrf

            <div class="mb-8">
                <div class="grid grid-cols-1 gap-6">
                    <!-- Tahun -->
                    <div>
                        <label for="tahun" class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="calendar" class="w-4 h-4 text-[#0093FF]"></i>
                            Tahun <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="tahun" name="tahun" value="{{ old('tahun', date('Y')) }}" required min="2000" max="2100" placeholder="Contoh: {{ date('Y') }}"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all @error('tahun') border-red-500 @enderror">
                        @error('tahun')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Tanggal Mulai -->
                        <div>
                            <label for="tgl_mulai" class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i data-lucide="calendar-check" class="w-4 h-4 text-[#0093FF]"></i>
                                Tanggal Mulai
                            </label>
                            <input type="datetime-local" id="tgl_mulai" name="tgl_mulai" value="{{ old('tgl_mulai') }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all @error('tgl_mulai') border-red-500 @enderror">
                            @error('tgl_mulai')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Selesai -->
                        <div>
                            <label for="tgl_selesai" class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i data-lucide="calendar-x" class="w-4 h-4 text-[#0093FF]"></i>
                                Tanggal Selesai
                            </label>
                            <input type="datetime-local" id="tgl_selesai" name="tgl_selesai" value="{{ old('tgl_selesai') }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all @error('tgl_selesai') border-red-500 @enderror">
                            @error('tgl_selesai')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Status Aktif -->
                    <div>
                        <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="toggle-right" class="w-4 h-4 text-[#0093FF]"></i>
                            Status
                        </label>
                        <div class="flex items-center gap-3">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-[#0093FF]"></div>
                                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">Aktifkan periode ini</span>
                            </label>
                        </div>
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                            <i data-lucide="info" class="w-3 h-3 inline mr-1"></i>
                            Mengaktifkan periode ini akan menonaktifkan periode lain secara otomatis
                        </p>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-end">
                <a href="{{ route('periode.index') }}" class="w-full sm:w-auto px-6 py-3 text-center bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                    Batal
                </a>
                <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-[#0093FF] to-[#00A8FF] text-white font-medium rounded-lg hover:from-[#00A8FF] hover:to-[#0093FF] transition-all shadow-lg hover:shadow-xl">
                    Simpan Periode
                </button>
            </div>
        </form>
    </div>
@endsection
