<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="UPG - Unit Pengendali Gratifikasi Kota Tangerang Selatan. Sistem manajemen dan pengelolaan data gratifikasi">
    <meta name="keywords" content="UPG, Unit Pengendali Gratifikasi, Tangerang Selatan, Gratifikasi">
    <meta name="author" content="Pemerintah Kota Tangerang Selatan">
    <title>Login - UPG Tangerang Selatan</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo/tangsel.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo/tangsel.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/tangsel.png') }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>

    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes floatSlow {
            0%, 100% {
                transform: translateY(0px) translateX(0px);
            }
            50% {
                transform: translateY(-30px) translateX(10px);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(58, 128, 245, 0.3);
            }
            50% {
                box-shadow: 0 0 30px rgba(58, 128, 245, 0.6);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-slow {
            animation: floatSlow 8s ease-in-out infinite;
        }

        .animate-slide-up {
            animation: slideUp 0.6s ease-out;
        }

        .input-gradient-focus:focus {
            border-color: transparent;
            background-image: linear-gradient(white, white), linear-gradient(135deg, #0093FF, #06b6d4);
            background-origin: border-box;
            background-clip: padding-box, border-box;
            border-width: 2px;
        }

        .dark .input-gradient-focus:focus {
            background-image: linear-gradient(rgb(55, 65, 81), rgb(55, 65, 81)), linear-gradient(135deg, #0093FF, #06b6d4);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-[#0093FF] via-[#00A8FF] to-[#0093FF] dark:from-gray-900 dark:via-blue-950 dark:to-gray-900 transition-colors duration-200 relative overflow-hidden">

    <!-- Decorative Shapes -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-white/10 dark:bg-blue-400/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-cyan-300/20 dark:bg-cyan-600/10 rounded-full blur-3xl animate-float-slow"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-400/10 dark:bg-blue-500/5 rounded-full blur-3xl animate-float"></div>

        <!-- Additional decorative circles -->
        <div class="absolute top-20 left-20 w-32 h-32 bg-white/5 rounded-full blur-2xl animate-float"></div>
        <div class="absolute bottom-40 right-32 w-40 h-40 bg-cyan-400/10 rounded-full blur-2xl animate-float-slow"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center p-4 relative z-10">

        <!-- Login Card -->
        <div class="w-full max-w-md animate-slide-up">

            <!-- Logo & Title Section -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-white to-blue-50 dark:from-gray-800 dark:to-gray-700 rounded-2xl shadow-2xl mb-4 p-3 ring-4 ring-white/50 dark:ring-gray-700/50 hover:ring-white/70 dark:hover:ring-gray-600/70 transition-all duration-300">
                    <img src="{{ asset('images/logo/tangsel.png') }}" alt="Logo Tangsel" class="w-full h-full object-contain">
                </div>
                <div class="mb-3">
                    <h2 class="text-xl font-bold text-white dark:text-white drop-shadow-lg">
                        UPG
                    </h2>
                    <p class="text-white/90 dark:text-gray-300 text-sm drop-shadow">
                        Unit Pengendali Gratifikasi
                    </p>
                </div>
            </div>

            <!-- Login Form Card -->
            <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-2xl p-8 border border-white/20 dark:border-gray-700/50 hover:shadow-3xl transition-all duration-300">

                <!-- Header -->
                <div class="text-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">
                        Selamat Datang
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm flex items-center justify-center gap-2">
                        <i data-lucide="shield-check" class="w-4 h-4 text-[#0093FF]"></i>
                        Silakan masuk ke akun Anda
                    </p>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                        <div class="flex items-start gap-3">
                            <i data-lucide="alert-circle" class="w-5 h-5 text-red-600 dark:text-red-400 flex-shrink-0 mt-0.5"></i>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-red-800 dark:text-red-400 mb-1">Login Gagal</h3>
                                <ul class="text-sm text-red-700 dark:text-red-300 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Success Messages -->
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                        <div class="flex items-start gap-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-green-600 dark:text-green-400 flex-shrink-0 mt-0.5"></i>
                            <p class="text-sm text-green-700 dark:text-green-300">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Username Field -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                            <i data-lucide="user-circle" class="w-4 h-4 text-[#0093FF]"></i>
                            Username
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="user" class="w-5 h-5 text-gray-400 group-focus-within:text-[#0093FF] transition-colors"></i>
                            </div>
                            <input
                                type="text"
                                id="username"
                                name="username"
                                value="{{ old('username') }}"
                                class="input-gradient-focus block w-full pl-10 pr-3 py-3 border @error('username') border-red-500 dark:border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF]/50 transition-all"
                                placeholder="Masukkan username Anda"
                                required
                                autocomplete="username"
                            >
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                            <i data-lucide="lock-keyhole" class="w-4 h-4 text-[#0093FF]"></i>
                            Password
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="lock" class="w-5 h-5 text-gray-400 group-focus-within:text-[#0093FF] transition-colors"></i>
                            </div>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="input-gradient-focus block w-full pl-10 pr-12 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0093FF]/50 transition-all"
                                placeholder="Masukkan password Anda"
                                required
                                autocomplete="current-password"
                            >
                            <button
                                type="button"
                                id="togglePassword"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-[#0093FF] transition-colors"
                            >
                                <i data-lucide="eye" class="w-5 h-5" id="eyeIcon"></i>
                                <i data-lucide="eye-off" class="w-5 h-5 hidden" id="eyeOffIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input
                                type="checkbox"
                                id="remember"
                                name="remember"
                                class="w-4 h-4 text-[#0093FF] bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-2 focus:ring-[#0093FF] transition-all"
                            >
                            <label for="remember" class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                Ingat saya
                            </label>
                        </div>
                        <a href="#" class="text-sm text-[#0093FF] hover:text-[#0070CC] dark:hover:text-blue-400 font-medium transition-colors">
                            Lupa password?
                        </a>
                    </div>

                    <!-- Login Button -->
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-[#0093FF] to-[#00A8FF] text-white py-3 px-4 rounded-lg font-semibold hover:from-[#00A8FF] hover:to-[#0093FF] focus:outline-none focus:ring-2 focus:ring-[#0093FF] focus:ring-offset-2 dark:focus:ring-offset-gray-800 transform hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 shadow-lg hover:shadow-2xl relative overflow-hidden group"
                    >
                        <span class="absolute inset-0 w-0 bg-white/20 transition-all duration-300 ease-out group-hover:w-full"></span>
                        <span class="relative flex items-center justify-center gap-2">
                            <i data-lucide="log-in" class="w-5 h-5"></i>
                            Masuk
                        </span>
                    </button>

                </form>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                            Atau
                        </span>
                    </div>
                </div>

                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Belum punya akun?
                        <a href="#" class="text-[#0093FF] hover:text-[#0070CC] dark:hover:text-blue-400 font-semibold transition-colors inline-flex items-center gap-1 hover:gap-2">
                            Daftar sekarang
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </p>
                </div>

            </div>

            <!-- Dark Mode Toggle -->
            <div class="mt-6 text-center">
                <button
                    id="darkModeToggle"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 dark:bg-gray-800/50 backdrop-blur text-white dark:text-gray-300 hover:bg-white/30 dark:hover:bg-gray-800/70 rounded-lg transition-all shadow-lg"
                >
                    <i data-lucide="moon" class="w-5 h-5 dark:hidden"></i>
                    <i data-lucide="sun" class="w-5 h-5 hidden dark:block text-yellow-400"></i>
                    <span class="text-sm font-medium">
                        <span class="dark:hidden">Mode Gelap</span>
                        <span class="hidden dark:inline">Mode Terang</span>
                    </span>
                </button>
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-xs text-white/80 dark:text-gray-400 drop-shadow">
                    &copy; {{ date('Y') }} UPG - Unit Pengendali Gratifikasi Tangerang Selatan. All rights reserved.
                </p>
            </div>

        </div>

    </div>

    <!-- Initialize Dark Mode -->
    <script>
        // Check for saved dark mode preference or default to light mode
        const html = document.documentElement;
        if (localStorage.getItem('darkMode') === 'true' ||
            (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
        }
    </script>

    <!-- Initialize Lucide Icons and Interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Lucide Icons
            lucide.createIcons();

            // Dark Mode Toggle
            const darkModeToggle = document.getElementById('darkModeToggle');
            const html = document.documentElement;

            if (darkModeToggle) {
                darkModeToggle.addEventListener('click', () => {
                    html.classList.toggle('dark');
                    localStorage.setItem('darkMode', html.classList.contains('dark'));
                    // Reinitialize icons after toggle
                    setTimeout(() => {
                        lucide.createIcons();
                    }, 10);
                });
            }

            // Toggle Password Visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeOffIcon = document.getElementById('eyeOffIcon');

            if (togglePassword && passwordInput && eyeIcon && eyeOffIcon) {
                togglePassword.addEventListener('click', () => {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    eyeIcon.classList.toggle('hidden');
                    eyeOffIcon.classList.toggle('hidden');
                });
            }
        });
    </script>

</body>
</html>
