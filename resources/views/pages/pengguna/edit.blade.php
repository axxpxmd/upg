@extends('layout.app')

@section('title', 'Edit Pengguna')

@push('styles')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Select2 Dark Mode Support */
        .dark .select2-container--default .select2-selection--single {
            background-color: rgb(55, 65, 81);
            border-color: rgb(75, 85, 99);
            color: white;
        }
        .dark .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: white;
        }
        .dark .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #9ca3af transparent transparent transparent;
        }
        .dark .select2-dropdown {
            background-color: rgb(55, 65, 81);
            border-color: rgb(75, 85, 99);
        }
        .dark .select2-container--default .select2-results__option {
            color: white;
        }
        .dark .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #0093FF;
        }
        .dark .select2-search--dropdown .select2-search__field {
            background-color: rgb(55, 65, 81);
            border-color: rgb(75, 85, 99);
            color: white;
        }
        /* Select2 Custom Styling */
        .select2-container--default .select2-selection--single {
            height: 48px;
            padding: 8px 12px;
            border-radius: 0.5rem;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 32px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 46px;
        }
        .select2-container {
            width: 100% !important;
        }
    </style>
@endpush

@section('content')
    <!-- Page Header -->
    <div class="mb-6 sm:mb-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-white mb-2">Edit Pengguna</h1>
                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Perbarui informasi pengguna {{ $pengguna->nama }}</p>
            </div>
            <a href="{{ route('pengguna.index') }}" class="w-full sm:w-auto px-5 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-2xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-all shadow-sm flex items-center justify-center gap-2">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <form action="{{ route('pengguna.update', $pengguna) }}" method="POST" class="p-6 sm:p-8">
            @csrf
            @method('PUT')

            <div class="mb-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Username -->
                    <div>
                        <label for="username" class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="at-sign" class="w-4 h-4 text-[#0093FF]"></i>
                            Username <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="username" name="username" value="{{ old('username', $pengguna->username) }}" required placeholder="Contoh: john.doe atau admin123"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all @error('username') border-red-500 @enderror">
                        @error('username')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIK -->
                    <div>
                        <label for="nik" class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="credit-card" class="w-4 h-4 text-[#0093FF]"></i>
                            NIK
                        </label>
                        <input type="text" id="nik" name="nik" value="{{ old('nik', $pengguna->nik) }}" inputmode="numeric" pattern="[0-9]{16}" maxlength="16" placeholder="Contoh: 3674012301850001"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all @error('nik') border-red-500 @enderror">
                        @error('nik')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div>
                        <label for="nama" class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="user" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $pengguna->nama) }}" required placeholder="Contoh: John Doe Wijaya"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all @error('nama') border-red-500 @enderror">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jabatan -->
                    <div>
                        <label for="jabatan" class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="briefcase" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                            Jabatan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan', $pengguna->jabatan) }}" required placeholder="Contoh: Staff IT, Kepala Bidang Data"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all @error('jabatan') border-red-500 @enderror">
                        @error('jabatan')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="mail" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                            Email
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email', $pengguna->email) }}" placeholder="Contoh: john.doe@tangsel.go.id"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No HP -->
                    <div>
                        <label for="no_hp" class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="phone" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                            No. HP
                        </label>
                        <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $pengguna->no_hp) }}" placeholder="Contoh: 08123456789"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all @error('no_hp') border-red-500 @enderror">
                        @error('no_hp')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- OPD -->
                    <div>
                        <label for="opd_id" class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="building" class="w-4 h-4 text-purple-600 dark:text-purple-400"></i>
                            OPD <span class="text-red-500">*</span>
                        </label>
                        <select id="opd_id" name="opd_id" required
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all @error('opd_id') border-red-500 @enderror">
                            <option value="">Pilih OPD</option>
                            @foreach($opds as $opd)
                                <option value="{{ $opd->id }}" {{ old('opd_id', $pengguna->opd_id) == $opd->id ? 'selected' : '' }}>
                                    {{ $opd->n_opd }}
                                </option>
                            @endforeach
                        </select>
                        @error('opd_id')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div>
                        <label for="role" class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="shield" class="w-4 h-4 text-purple-600 dark:text-purple-400"></i>
                            Role <span class="text-red-500">*</span>
                        </label>
                        <select id="role" name="role" required
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all @error('role') border-red-500 @enderror">
                            <option value="">Pilih Role</option>
                            <option value="admin" {{ old('role', $pengguna->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="operator" {{ old('role', $pengguna->role) == 'operator' ? 'selected' : '' }}>Operator</option>
                            <option value="verifikator" {{ old('role', $pengguna->role) == 'verifikator' ? 'selected' : '' }}>Verifikator</option>
                        </select>
                        @error('role')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <div>
                    <label for="password" class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        <i data-lucide="key" class="w-4 h-4 text-red-600 dark:text-red-400"></i>
                        Password Baru
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password" oninput="validatePassword()"
                            class="w-full px-4 py-3 pr-12 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF] transition-all @error('password') border-red-500 @enderror">
                        <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                            <i data-lucide="eye" class="w-5 h-5" id="password-icon"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-end">
                <a href="{{ route('pengguna.index') }}" class="w-full sm:w-auto px-6 py-3 text-center bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                    Batal
                </a>
                <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-[#0093FF] to-[#00A8FF] text-white font-medium rounded-lg hover:from-[#00A8FF] hover:to-[#0093FF] transition-all shadow-lg hover:shadow-xl">
                    Update Pengguna
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for OPD dropdown
            $('#opd_id').select2({
                placeholder: 'Pilih OPD',
                allowClear: true,
                width: '100%'
            });

            // Initialize Select2 for Role dropdown
            $('#role').select2({
                placeholder: 'Pilih Role',
                allowClear: true,
                width: '100%',
                minimumResultsForSearch: Infinity // Disable search for role (only 3 options)
            });
        });

        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId + '-icon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                input.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }

            lucide.createIcons();
        }

        function validatePassword() {
            var pw = document.getElementById('password').value;
            var requirements = document.getElementById('password-requirements');

            // Show/hide requirements
            if (pw.length > 0) {
                requirements.classList.remove('hidden');
            } else {
                requirements.classList.add('hidden');
                return;
            }

            // Check length
            var lengthValid = pw.length >= 12;
            document.getElementById('req-length').className = lengthValid ? 'flex items-center gap-2 text-xs text-green-600 dark:text-green-400' : 'flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400';
            document.getElementById('req-length').innerHTML = '<i data-lucide="' + (lengthValid ? 'check-circle' : 'circle') + '" class="w-3 h-3"></i><span>Minimal 12 karakter</span>';

            // Check uppercase
            var upperValid = /[A-Z]/.test(pw);
            document.getElementById('req-uppercase').className = upperValid ? 'flex items-center gap-2 text-xs text-green-600 dark:text-green-400' : 'flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400';
            document.getElementById('req-uppercase').innerHTML = '<i data-lucide="' + (upperValid ? 'check-circle' : 'circle') + '" class="w-3 h-3"></i><span>Minimal satu huruf besar (A-Z)</span>';

            // Check lowercase
            var lowerValid = /[a-z]/.test(pw);
            document.getElementById('req-lowercase').className = lowerValid ? 'flex items-center gap-2 text-xs text-green-600 dark:text-green-400' : 'flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400';
            document.getElementById('req-lowercase').innerHTML = '<i data-lucide="' + (lowerValid ? 'check-circle' : 'circle') + '" class="w-3 h-3"></i><span>Minimal satu huruf kecil (a-z)</span>';

            // Check number
            var numberValid = /[0-9]/.test(pw);
            document.getElementById('req-number').className = numberValid ? 'flex items-center gap-2 text-xs text-green-600 dark:text-green-400' : 'flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400';
            document.getElementById('req-number').innerHTML = '<i data-lucide="' + (numberValid ? 'check-circle' : 'circle') + '" class="w-3 h-3"></i><span>Minimal satu angka (0-9)</span>';

            // Check special character
            var specialValid = /[@$!%*?&#]/.test(pw);
            document.getElementById('req-special').className = specialValid ? 'flex items-center gap-2 text-xs text-green-600 dark:text-green-400' : 'flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400';
            document.getElementById('req-special').innerHTML = '<i data-lucide="' + (specialValid ? 'check-circle' : 'circle') + '" class="w-3 h-3"></i><span>Minimal satu karakter spesial (@$!%*?&#)</span>';

            // Reinitialize icons
            lucide.createIcons();
        }
    </script>
@endpush
