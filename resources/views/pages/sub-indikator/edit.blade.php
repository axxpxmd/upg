@extends('layout.app')

@section('title', 'Edit Sub Indikator')

@section('content')
    <!-- Page Header -->
    <div class="mb-6 sm:mb-8">
        <div class="flex items-center gap-3 mb-4">
            <a href="{{ route('sub-indikator.index') }}" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                <i data-lucide="arrow-left" class="w-5 h-5 text-gray-600 dark:text-gray-400"></i>
            </a>
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-white">Edit Sub Indikator</h1>
                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Perbarui data sub indikator</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <form action="{{ route('sub-indikator.update', $subIndikator->id) }}" method="POST" class="p-6 sm:p-8">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Periode Filter -->
                <div>
                    <label for="periode_filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Filter Tahun
                    </label>
                    <select id="periode_filter" class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all appearance-none" onchange="filterIndikator()">
                        <option value="">Semua Tahun</option>
                        @foreach($periodes as $periode)
                            <option value="{{ $periode->id }}" {{ ($subIndikator->indikator && $subIndikator->indikator->periode_id == $periode->id) ? 'selected' : '' }}>
                                Tahun {{ $periode->tahun }} {{ $periode->is_active ? '(Aktif)' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Indikator -->
                <div>
                    <label for="indikator_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Indikator <span class="text-red-500">*</span>
                    </label>
                    <select name="indikator_id" id="indikator_id" required class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all appearance-none">
                        <option value="">Pilih Indikator</option>
                        @foreach($indikators as $indikator)
                            <option value="{{ $indikator->id }}" data-periode-id="{{ $indikator->periode_id }}" {{ (old('indikator_id', $subIndikator->indikator_id) == $indikator->id) ? 'selected' : '' }}>
                                {{ $indikator->nama_indikator }} ({{ $indikator->periode ? $indikator->periode->tahun : '-' }})
                            </option>
                        @endforeach
                    </select>
                    @error('indikator_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Sub Indikator -->
                <div>
                    <label for="nama_sub_indikator" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nama Sub Indikator <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_sub_indikator" id="nama_sub_indikator" value="{{ old('nama_sub_indikator', $subIndikator->nama_sub_indikator) }}" required class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all" placeholder="Masukkan nama sub indikator">
                    @error('nama_sub_indikator')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bobot Sub (%) -->
                <div>
                    <label for="bobot_sub_persen" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Bobot Sub (%)
                    </label>
                    <input type="number" name="bobot_sub_persen" id="bobot_sub_persen" value="{{ old('bobot_sub_persen', $subIndikator->bobot_sub_persen) }}" step="0.01" min="0" max="100" class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all" placeholder="Masukkan bobot sub">
                    @error('bobot_sub_persen')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row items-center gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-gray-700">
                <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-gradient-to-r from-[#0093FF] to-[#00A8FF] text-white text-sm font-medium rounded-lg hover:from-[#00A8FF] hover:to-[#0093FF] transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    <span>Perbarui</span>
                </button>
                <a href="{{ route('sub-indikator.index') }}" class="w-full sm:w-auto px-6 py-2.5 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors flex items-center justify-center gap-2">
                    <i data-lucide="x" class="w-4 h-4"></i>
                    <span>Batal</span>
                </a>
            </div>
        </form>
    </div>

    <script>
        function filterIndikator() {
            const periodeFilter = document.getElementById('periode_filter').value;
            const indikatorSelect = document.getElementById('indikator_id');
            const options = indikatorSelect.querySelectorAll('option');

            options.forEach(option => {
                if (option.value === '') {
                    option.style.display = 'block';
                    return;
                }

                if (periodeFilter === '') {
                    option.style.display = 'block';
                } else {
                    const optionPeriodeId = option.getAttribute('data-periode-id');
                    option.style.display = optionPeriodeId === periodeFilter ? 'block' : 'none';
                }
            });

            // Reset selection if current selection is hidden
            if (indikatorSelect.value && periodeFilter) {
                const selectedOption = indikatorSelect.querySelector(`option[value="${indikatorSelect.value}"]`);
                if (selectedOption && selectedOption.style.display === 'none') {
                    indikatorSelect.value = '';
                }
            }
        }

        // Apply filter on page load to show only relevant options
        document.addEventListener('DOMContentLoaded', function() {
            filterIndikator();
        });
    </script>
@endsection
