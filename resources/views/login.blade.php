<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Inventaris Kampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .gradient-bg {
            background: linear-gradient(-45deg, #1e40af, #7c3aed, #2563eb, #4f46e5);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            -webkit-backdrop-filter: blur(10px);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Fallback for browsers that don't support backdrop-filter */
        @supports not (-webkit-backdrop-filter: blur(1px)) {
            .glass-effect {
                background-color: rgba(255, 255, 255, 0.25);
            }
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .shape-1 { width: 80px; height: 80px; top: 10%; left: 10%; animation-delay: 0s; }
        .shape-2 { width: 120px; height: 120px; top: 60%; left: 80%; animation-delay: -2s; }
        .shape-3 { width: 60px; height: 60px; top: 80%; left: 20%; animation-delay: -4s; }
        .shape-4 { width: 100px; height: 100px; top: 20%; left: 70%; animation-delay: -6s; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">

    <!-- Main Container -->
    <div class="min-h-screen flex flex-col md:flex-row">
        
        <!-- Left Panel - Illustration -->
        <div class="hidden md:flex md:w-1/2 gradient-bg text-white relative overflow-hidden">
            <!-- Floating Shapes -->
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
                <div class="shape shape-4"></div>
            </div>
            
            <!-- Content -->
            <div class="relative z-10 flex flex-col justify-center items-center text-center px-12">
                <div class="animate-fade-in-up">
                    <!-- University Logo -->
                    <div class="mb-8 animate-float">
                        <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6 inline-flex">
                            <img src="logo/ubbg.jpg" alt="UBBG Logo" class="w-20 h-20 rounded-xl shadow-lg">
                        </div>
                    </div>
                    
                    <h1 class="text-4xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-white to-blue-100">
                        Sistem Inventaris Kampus
                    </h1>
                    
                    <p class="text-xl text-blue-100 mb-8 leading-relaxed">
                        Kelola dan pantau seluruh aset universitas dengan sistem yang terintegrasi dan efisien
                    </p>

                    <!-- Features List -->
                    <div class="grid grid-cols-1 gap-4 text-left max-w-md">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white/20 rounded-lg p-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-blue-100">Manajemen inventaris real-time</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="bg-white/20 rounded-lg p-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <span class="text-blue-100">Laporan dan analisis lengkap</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="bg-white/20 rounded-lg p-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <span class="text-blue-100">Keamanan data terjamin</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel - Login Form -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md animate-fade-in-up">
                <!-- Mobile Logo -->
                <div class="md:hidden text-center mb-8">
                    <div class="bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl p-4 inline-flex mb-4">
                        <img src="logo/ubbg.jpg" alt="UBBG Logo" class="w-16 h-16 rounded-xl">
                    </div>
                    <h1 class="text-2xl font-bold text-gray-800">Universitas Bina Bangsa Getsempena</h1>
                </div>

                <!-- Login Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Masuk ke Akun</h2>
                        <p class="text-gray-600">Selamat datang kembali! Silakan masuk ke sistem</p>
                    </div>

                    <!-- Login Form -->
                    <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Alamat Email
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                </div>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                    placeholder="email@example.com"
                                    required
                                    aria-label="Alamat email"
                                    aria-describedby="email-help"
                                >
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Kata Sandi
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                    placeholder="Masukkan kata sandi"
                                    required
                                    aria-label="Kata sandi"
                                    aria-describedby="password-help"
                                >
                            </div>
                        </div>

                        <!-- Remember & Forgot -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input
                                    id="remember"
                                    name="remember"
                                    type="checkbox"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                    aria-label="Ingat saya"
                                >
                                <label for="remember" class="ml-2 block text-sm text-gray-700">
                                    Ingat saya
                                </label>
                            </div>
                            <a href="#"
                               class="text-sm font-medium text-blue-600 hover:text-blue-500 transition duration-200"
                               aria-label="Lupa kata sandi">
                                Lupa kata sandi?
                            </a>
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 px-4 rounded-lg font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            aria-label="Masuk ke sistem inventaris"
                        >
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                </svg>
                                Masuk ke Sistem
                            </span>
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <p class="text-center text-sm text-gray-600">
                            Butuh bantuan? 
                            <a href="#"
                               class="font-medium text-blue-600 hover:text-blue-500 transition duration-200"
                               aria-label="Hubungi administrator">
                                Hubungi Administrator
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="text-center mt-6">
                    <p class="text-xs text-gray-500">
                        &copy; 2024 Universitas Bina Bangsa Getsempena. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Error/Success Messages -->
    @if($errors->any())
    <div class="fixed top-4 right-4 max-w-sm animate-fade-in-up">
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 shadow-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <button onclick="this.parentElement.parentElement.parentElement.remove()"
                            class="inline-flex bg-red-50 rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-50 focus:ring-red-600"
                            aria-label="Tutup notifikasi error">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800">
                        {{ $errors->first() }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(session('success'))
    <div class="fixed top-4 right-4 max-w-sm animate-fade-in-up">
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 shadow-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <button onclick="this.parentElement.parentElement.parentElement.remove()"
                            class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600"
                            aria-label="Tutup notifikasi sukses">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif

</body>
</html>