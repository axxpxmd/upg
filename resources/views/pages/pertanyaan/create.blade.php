@extends('layout.app')

@section('title', 'Tambah Pertanyaan')

@section('content')
    <!-- Page Header -->
    <div class="mb-6 sm:mb-8">
        <div class="flex items-center gap-3 mb-4">
            <a href="{{ route('pertanyaan.index') }}" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                <i data-lucide="arrow-left" class="w-5 h-5 text-gray-600 dark:text-gray-400"></i>
            </a>
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-white">Tambah Pertanyaan</h1>
                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Tambahkan pertanyaan baru</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <form action="{{ route('pertanyaan.store') }}" method="POST" class="p-6 sm:p-8">
            @csrf

            <div class="space-y-6">
                <!-- Periode Filter -->
                <div>
                    <label for="periode_filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Tahun
                    </label>
                    <select id="periode_filter" class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all appearance-none" onchange="filterIndikator()">
                        <option value="">Semua Tahun</option>
                        @foreach($periodes as $periode)
                            <option value="{{ $periode->id }}">
                                Tahun {{ $periode->tahun }} {{ $periode->is_active ? '(Aktif)' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Indikator Filter -->
                <div>
                    <label for="indikator_filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Indikator
                    </label>
                    <select id="indikator_filter" class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all appearance-none" onchange="filterSubIndikator()">
                        <option value="">Semua Indikator</option>
                        @foreach($indikators as $indikator)
                            <option value="{{ $indikator->id }}" data-periode-id="{{ $indikator->periode_id }}">
                                {{ $indikator->nama_indikator }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sub Indikator -->
                <div>
                    <label for="sub_indikator_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Sub Indikator <span class="text-red-500">*</span>
                    </label>
                    <select name="sub_indikator_id" id="sub_indikator_id" required class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all appearance-none">
                        <option value="">Pilih Sub Indikator</option>
                        @foreach($subIndikators as $subIndikator)
                            <option value="{{ $subIndikator->id }}" data-indikator-id="{{ $subIndikator->indikator_id }}" {{ old('sub_indikator_id') == $subIndikator->id ? 'selected' : '' }}>
                                {{ $subIndikator->nama_sub_indikator }}
                            </option>
                        @endforeach
                    </select>
                    @error('sub_indikator_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pertanyaan List -->
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Pertanyaan <span class="text-red-500">*</span>
                        </label>
                        <button type="button" onclick="addPertanyaan()" class="px-3 py-1.5 bg-gradient-to-r from-[#0093FF] to-[#00A8FF] text-white text-xs font-medium rounded-lg hover:from-[#00A8FF] hover:to-[#0093FF] transition-all flex items-center gap-1.5">
                            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                            <span>Tambah Row</span>
                        </button>
                    </div>

                    <div id="pertanyaan-container" class="space-y-3">
                        <!-- First Row -->
                        <div class="pertanyaan-row p-4 bg-gray-50 dark:bg-gray-900/30 rounded-lg border border-gray-200 dark:border-gray-600">
                            <div class="flex items-start gap-3">
                                <div class="flex-1">
                                    <textarea name="n_pertanyaan[]" rows="3" placeholder="Masukkan pertanyaan..." required class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all resize-none"></textarea>
                                </div>
                                <button type="button" onclick="removePertanyaan(this)" class="p-2.5 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors mt-0.5" title="Hapus">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row items-center gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-gray-700">
                <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-gradient-to-r from-[#0093FF] to-[#00A8FF] text-white text-sm font-medium rounded-lg hover:from-[#00A8FF] hover:to-[#0093FF] transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    <span>Simpan</span>
                </button>
                <a href="{{ route('pertanyaan.index') }}" class="w-full sm:w-auto px-6 py-2.5 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors flex items-center justify-center gap-2">
                    <i data-lucide="x" class="w-4 h-4"></i>
                    <span>Batal</span>
                </a>
            </div>
        </form>
    </div>

    <script>
        function filterIndikator() {
            const periodeFilter = document.getElementById('periode_filter').value;
            const indikatorSelect = document.getElementById('indikator_filter');
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

            if (indikatorSelect.value && periodeFilter) {
                const selectedOption = indikatorSelect.querySelector(`option[value="${indikatorSelect.value}"]`);
                if (selectedOption && selectedOption.style.display === 'none') {
                    indikatorSelect.value = '';
                    filterSubIndikator();
                }
            }
        }

        function filterSubIndikator() {
            const indikatorFilter = document.getElementById('indikator_filter').value;
            const subIndikatorSelect = document.getElementById('sub_indikator_id');
            const options = subIndikatorSelect.querySelectorAll('option');

            options.forEach(option => {
                if (option.value === '') {
                    option.style.display = 'block';
                    return;
                }

                if (indikatorFilter === '') {
                    option.style.display = 'block';
                } else {
                    const optionIndikatorId = option.getAttribute('data-indikator-id');
                    option.style.display = optionIndikatorId === indikatorFilter ? 'block' : 'none';
                }
            });

            if (subIndikatorSelect.value && indikatorFilter) {
                const selectedOption = subIndikatorSelect.querySelector(`option[value="${subIndikatorSelect.value}"]`);
                if (selectedOption && selectedOption.style.display === 'none') {
                    subIndikatorSelect.value = '';
                }
            }
        }

        function addPertanyaan() {
            const container = document.getElementById('pertanyaan-container');

            const newRow = document.createElement('div');
            newRow.className = 'pertanyaan-row p-4 bg-gray-50 dark:bg-gray-900/30 rounded-lg border border-gray-200 dark:border-gray-600';
            newRow.innerHTML = `
                <div class="flex items-start gap-3">
                    <div class="flex-1">
                        <textarea name="n_pertanyaan[]" rows="3" placeholder="Masukkan pertanyaan..." required class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all resize-none"></textarea>
                    </div>
                    <button type="button" onclick="removePertanyaan(this)" class="p-2.5 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors mt-0.5" title="Hapus">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>
                </div>
            `;

            container.appendChild(newRow);

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }

        function removePertanyaan(button) {
            const container = document.getElementById('pertanyaan-container');
            const rows = container.querySelectorAll('.pertanyaan-row');

            if (rows.length > 1) {
                button.closest('.pertanyaan-row').remove();
            } else {
                alert('Minimal harus ada 1 pertanyaan');
            }
        }
    </script>
@endsection
