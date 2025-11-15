<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SIM Inventaris Kampus') }} - @yield('title', 'Dashboard')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-blue: #1e40af;
            --primary-indigo: #4f46e5;
            --primary-purple: #7c3aed;
            --secondary-blue: #3b82f6;
            --accent-cyan: #06b6d4;
            --success-green: #10b981;
            --warning-orange: #f59e0b;
            --danger-red: #ef4444;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
        }

        body { 
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 25%, #e2e8f0 100%);
            min-height: 100vh;
            font-feature-settings: 'cv02', 'cv03', 'cv04', 'cv11';
        }

        [x-cloak] { display: none !important; }
        
        /* Enhanced scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(241, 245, 249, 0.5);
            border-radius: 12px;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #94a3b8 0%, #64748b 100%);
            border-radius: 12px;
            border: 1px solid rgba(241, 245, 249, 0.5);
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
        }

        /* Modern Glass Morphism */
        .glass {
            background: rgba(255, 255, 255, 0.85);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 
                0 8px 32px 0 rgba(31, 38, 135, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.1);
        }

        .glass-dark {
            background: rgba(15, 23, 42, 0.85);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 
                0 8px 32px 0 rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.05);
        }

        /* Enhanced gradient text */
        .gradient-text {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-indigo) 50%, var(--primary-purple) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }

        .gradient-text-light {
            background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 600;
        }

        /* Floating animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        @keyframes float-delayed {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        .float-animation-delayed {
            animation: float-delayed 6s ease-in-out infinite;
            animation-delay: 2s;
        }

        /* Pulse for notifications */
        @keyframes pulse-glow {
            0%, 100% { 
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
                transform: scale(1);
            }
            50% { 
                box-shadow: 0 0 0 8px rgba(239, 68, 68, 0);
                transform: scale(1.05);
            }
        }
        .pulse-notification {
            animation: pulse-glow 2s infinite;
        }

        /* Smooth transitions */
        .transition-all-custom {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Enhanced sidebar animations */
        .sidebar-enter {
            transform: translateX(-100%);
        }
        .sidebar-enter-active {
            transform: translateX(0);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar-leave {
            transform: translateX(0);
        }
        .sidebar-leave-active {
            transform: translateX(-100%);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Modern hover effects */
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hover-lift:hover {
            transform: translateY(-3px);
            box-shadow: 
                0 20px 40px -12px rgba(0, 0, 0, 0.25),
                0 0 0 1px rgba(255, 255, 255, 0.1);
        }

        /* Enhanced gradients */
        .gradient-sidebar {
            background: linear-gradient(135deg, 
                var(--gray-900) 0%, 
                var(--gray-800) 30%, 
                #1e293b 70%, 
                var(--gray-900) 100%);
            position: relative;
        }
        .gradient-sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(124, 58, 237, 0.3) 0%, transparent 50%);
            pointer-events: none;
        }

        .gradient-header {
            background: linear-gradient(135deg, 
                rgba(255,255,255,0.95) 0%, 
                rgba(248,250,252,0.95) 50%, 
                rgba(241,245,249,0.95) 100%);
            backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* University themed colors */
        .bg-university-primary {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-indigo) 100%);
        }
        .bg-university-secondary {
            background: linear-gradient(135deg, var(--primary-indigo) 0%, var(--primary-purple) 100%);
        }
        .bg-university-accent {
            background: linear-gradient(135deg, var(--accent-cyan) 0%, var(--secondary-blue) 100%);
        }

        /* Enhanced button styles */
        .btn-university {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-indigo) 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 1rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 14px 0 rgba(30, 64, 175, 0.3);
        }
        .btn-university:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px 0 rgba(30, 64, 175, 0.4);
            background: linear-gradient(135deg, var(--primary-indigo) 0%, var(--primary-purple) 100%);
        }

        /* Loading skeleton */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 0.5rem;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Custom focus styles */
        .focus-ring:focus {
            outline: none;
            ring: 2px;
            ring-color: var(--primary-indigo);
            ring-offset: 2px;
            ring-offset-color: white;
        }

        /* Navigation active state */
        .nav-item-active {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-indigo) 100%);
            color: white;
            box-shadow: 
                0 4px 14px 0 rgba(30, 64, 175, 0.3),
                inset 0 1px 0 0 rgba(255, 255, 255, 0.1);
        }

        .nav-item-active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(135deg, var(--accent-cyan), var(--secondary-blue));
            border-radius: 0 4px 4px 0;
        }

        /* Enhanced modal styles */
        .modal-overlay {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
        }

        /* University logo styling */
        .logo-container {
            position: relative;
            overflow: hidden;
        }
        .logo-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
            animation: logo-shine 3s infinite;
        }
        @keyframes logo-shine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            50% { transform: translateX(100%) translateY(100%) rotate(45deg); }
            100% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
        }

        /* Enhanced search bar */
        .search-enhanced {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .search-enhanced:focus-within {
            background: rgba(255, 255, 255, 0.95);
            border-color: var(--primary-indigo);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
    </style>
</head>
<body class="font-sans antialiased">
    
    <div x-data="{ 
        sidebarOpen: window.innerWidth >= 1024, 
        darkMode: localStorage.theme === 'dark' || false,
        notificationsOpen: false,
        userMenuOpen: false,
        init() {
            // Respect system preference
            if (!localStorage.theme && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                this.darkMode = true;
            }
        }
    }" 
         :class="{ 
             'dark': darkMode,
             'bg-gray-900': darkMode
         }" 
         class="flex h-screen overflow-hidden transition-all duration-300">
        
        {{-- Enhanced overlay for mobile --}}
        <div x-show="sidebarOpen && window.innerWidth < 1024" 
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="fixed inset-0 z-40 modal-overlay lg:hidden"></div>

        {{-- Enhanced Sidebar --}}
        <aside x-show="sidebarOpen || window.innerWidth >= 1024" 
               x-transition:enter="sidebar-enter sidebar-enter-active"
               x-transition:leave="sidebar-leave sidebar-leave-active"
               class="fixed lg:static inset-y-0 left-0 z-50 gradient-sidebar text-gray-300 flex flex-col shadow-2xl border-r border-white/10 w-72 lg:w-72 overflow-hidden">
            
            {{-- Enhanced Logo Section --}}
            <div class="flex items-center justify-between h-20 px-6 bg-gradient-to-r from-blue-600/20 to-purple-600/20 border-b border-white/10 backdrop-blur-sm relative">
                <div class="flex items-center space-x-4">
                    <div class="relative logo-container">
                        <img src="{{ asset('logo/ubbg.jpg') }}" alt="Logo Universitas" 
                             class="w-12 h-12 rounded-xl object-cover border-2 border-blue-400/50 shadow-xl float-animation">
                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-gradient-to-r from-green-400 to-emerald-500 border-2 border-gray-900 rounded-full shadow-lg float-animation-delayed"></div>
                    </div>
                    <div class="transition-all duration-300">
                        <span class="text-xl font-bold gradient-text-light tracking-tight">SIM Inventaris</span>
                        <p class="text-xs text-blue-200 mt-0.5 font-medium">Kampus Management System</p>
                    </div>
                </div>
                
                {{-- Close button for mobile --}}
                <button @click="sidebarOpen = false"
                        class="lg:hidden p-2 rounded-xl bg-white/10 hover:bg-white/20 transition-all duration-200 hover-lift focus-ring"
                        aria-label="Tutup sidebar">
                    <span class="sr-only">Tutup sidebar</span>
                    <svg class="w-5 h-5 text-gray-300 hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Enhanced Navigation --}}
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto relative z-10">
                @php
                    $menuItems = [
                        ['route' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'heroicon-o-home'],
                        ['route' => 'inventaris.pilih_jenis', 'label' => 'Inventaris', 'icon' => 'heroicon-o-cube'],
                        ['route' => 'acquisitions.index', 'label' => 'Akuisisi', 'icon' => 'heroicon-o-arrow-up-circle'],
                        ['route' => 'rooms.index', 'label' => 'Ruangan', 'icon' => 'heroicon-o-building-library'],
                        ['route' => 'units.index', 'label' => 'Unit', 'icon' => 'heroicon-o-squares-2x2'],
                        ['route' => 'users.index', 'label' => 'Pengguna', 'icon' => 'heroicon-o-users'],
                        ['route' => 'transactions.index', 'label' => 'Transaksi', 'icon' => 'heroicon-o-arrow-path'],
                        ['route' => 'settings.index', 'label' => 'Pengaturan', 'icon' => 'heroicon-o-cog-6-tooth'],
                    ];
                @endphp

                @foreach($menuItems as $item)
                    <x-sidebar-link
                        :route="$item['route']"
                        :label="$item['label']"
                        :icon="$item['icon']"
                        :active="request()->routeIs($item['route'] . '*')" />
                @endforeach
            </nav>

            {{-- Enhanced Sidebar Footer --}}
            <div class="p-4 border-t border-white/10 bg-gray-900/40 backdrop-blur-sm relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-sm font-medium text-gray-400">Tampilan</span>
                    <button @click="darkMode = !darkMode; localStorage.theme = darkMode ? 'dark' : 'light'"
                            class="relative inline-flex h-7 w-12 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-300 ease-in-out focus-ring"
                            :class="{ 'bg-university-secondary': darkMode, 'bg-gray-600': !darkMode }"
                            :aria-label="darkMode ? 'Aktifkan mode terang' : 'Aktifkan mode gelap'">
                        <span class="sr-only" x-text="darkMode ? 'Aktifkan mode terang' : 'Aktifkan mode gelap'"></span>
                        <span class="pointer-events-none relative inline-block h-6 w-6 transform rounded-full bg-white shadow-lg ring-0 transition duration-300 ease-in-out"
                              :class="{ 'translate-x-5': darkMode, 'translate-x-0': !darkMode }">
                            <span class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity duration-300 ease-in-out"
                                  :class="{ 'opacity-0': darkMode, 'opacity-100': !darkMode }">
                                <svg class="h-4 w-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                            <span class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity duration-300 ease-in-out"
                                  :class="{ 'opacity-100': darkMode, 'opacity-0': !darkMode }">
                                <svg class="h-4 w-4 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                                </svg>
                            </span>
                        </span>
                    </button>
                </div>
                <div class="text-center">
                    <div class="text-xs text-gray-400 mb-1 font-medium">SIM Inventaris v3.0</div>
                    <div class="text-xs text-gray-500">&copy; {{ date('Y') }} Universitas Bina Bangsa</div>
                </div>
            </div>
        </aside>

        {{-- Enhanced Main Content Area --}}
        <div class="flex flex-1 flex-col overflow-hidden w-full">
            
            {{-- Enhanced Top Navigation --}}
            <header class="sticky top-0 z-40 gradient-header border-b border-gray-200/60 px-4 sm:px-6 py-4 shadow-sm">
                <div class="flex items-center justify-between">
                    
                    {{-- Left Section --}}
                    <div class="flex items-center gap-4">
                        {{-- Mobile menu toggle --}}
                        <button @click="sidebarOpen = !sidebarOpen"
                                class="lg:hidden inline-flex items-center justify-center p-3 rounded-2xl text-gray-600 hover:text-blue-600 hover:bg-white/80 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300 hover-lift"
                                :aria-label="sidebarOpen ? 'Tutup menu navigasi' : 'Buka menu navigasi'">
                            <span class="sr-only" x-text="sidebarOpen ? 'Tutup menu navigasi' : 'Buka menu navigasi'"></span>
                            <svg x-show="!sidebarOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            <svg x-show="sidebarOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>

                        {{-- Enhanced Page Title --}}
                        <div class="hidden md:block">
                            <h1 class="text-2xl font-bold gradient-text">@yield('title', 'Dashboard')</h1>
                            <p class="text-sm text-gray-600 mt-1">@yield('subtitle', 'Selamat datang di sistem inventaris kampus')</p>
                        </div>
                    </div>

                    {{-- Enhanced Search Bar --}}
                    <div class="flex-1 max-w-2xl mx-4 lg:mx-8">
                        <div class="relative search-enhanced rounded-2xl">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-6-6m2-5a7 7 0 1 1-14 0 7 7 0 0 1 14 0z"/>
                                </svg>
                            </div>
                            <input type="text"
                                   class="block w-full pl-12 pr-4 py-3 bg-transparent focus:outline-none text-sm transition-all duration-300 placeholder-gray-500"
                                   placeholder="Cari inventaris, transaksi, atau aset kampus..."
                                   aria-label="Kolom pencarian inventaris dan aset kampus">
                        </div>
                    </div>

                    {{-- Enhanced Right Menu --}}
                    <div class="flex items-center gap-3">
                        
                        {{-- Theme Toggle --}}
                        <button @click="darkMode = !darkMode; localStorage.theme = darkMode ? 'dark' : 'light'"
                                class="hidden md:flex items-center justify-center p-3 text-gray-600 hover:text-blue-600 hover:bg-white/80 rounded-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 hover-lift"
                                :title="darkMode ? 'Mode Terang' : 'Mode Gelap'"
                                :aria-label="darkMode ? 'Aktifkan mode terang' : 'Aktifkan mode gelap'">
                            <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                            <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </button>

                        {{-- Enhanced Notifications --}}
                        <div x-data="{ open: false }" @click.away="open = false" class="relative">
                            <button @click="open = !open"
                                    class="relative p-3 text-gray-600 hover:text-blue-600 hover:bg-white/80 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300 hover-lift"
                                    :aria-label="open ? 'Tutup notifikasi' : 'Buka notifikasi'">
                                <span class="sr-only" x-text="open ? 'Tutup notifikasi' : 'Buka notifikasi'"></span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM10.5 3.75a6 6 0 0 0-6 6v2.25l-2.47 2.47a.75.75 0 0 0 .53 1.28h15.88a.75.75 0 0 0 .53-1.28L16.5 12V9.75a6 6 0 00-6-6z"/>
                                </svg>
                                @if(isset($pendingRequests) && $pendingRequests > 0)
                                    <span class="absolute top-2.5 right-2.5 block h-3 w-3 rounded-full bg-red-500 ring-2 ring-white pulse-notification"></span>
                                @endif
                            </button>
                            
                            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-96 glass rounded-2xl shadow-xl border border-gray-200/80 py-3">
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <h3 class="text-sm font-semibold text-gray-900">Notifikasi Terbaru</h3>
                                </div>
                                <div class="max-h-96 overflow-y-auto">
                                    <div class="px-4 py-8 text-center">
                                        <div class="bg-gradient-to-br from-blue-100 to-indigo-100 text-blue-400 p-4 rounded-2xl inline-flex mb-4">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                                            </svg>
                                        </div>
                                        <p class="text-sm text-gray-500 font-medium">Tidak ada notifikasi baru</p>
                                        <p class="text-xs text-gray-400 mt-1">Semua notifikasi sudah ditangani</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Enhanced User Menu --}}
                        <div x-data="{ open: false }" @click.away="open = false" class="relative">
                            <button @click="open = !open"
                                    class="flex items-center gap-3 p-2 rounded-2xl hover:bg-white/80 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300 hover-lift group"
                                    :aria-label="open ? 'Tutup menu pengguna' : 'Buka menu pengguna'">
                                <span class="sr-only" x-text="open ? 'Tutup menu pengguna' : 'Buka menu pengguna'"></span>
                                <div class="relative">
                                    <img class="w-10 h-10 rounded-xl object-cover border-2 border-blue-200 group-hover:border-blue-300 transition-colors shadow-lg" 
                                         src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=e0f2fe&color=0ea5e9&bold=true' }}" 
                                         alt="{{ Auth::user()->name }}">
                                    <div class="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-gradient-to-r from-green-400 to-emerald-500 border-2 border-white rounded-full shadow-lg"></div>
                                </div>
                                <div class="hidden md:block text-left">
                                    <div class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-gray-500 bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700 px-2 py-0.5 rounded-full font-medium">
                                        {{ ucfirst(Auth::user()->role ?? 'User') }}
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" 
                                     :class="{ 'rotate-180': open }" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-64 glass rounded-2xl shadow-xl border border-gray-200/80 py-3">
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('profile.edit') }}"
                                   class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700 transition-all duration-200 group/item"
                                   aria-label="Buka profil saya">
                                    <div class="bg-gradient-to-br from-blue-100 to-indigo-100 p-2 rounded-xl group-hover/item:scale-110 transition-transform duration-200">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <span>Profil Saya</span>
                                </a>
                                <a href="{{ route('settings.index') }}"
                                   class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700 transition-all duration-200 group/item"
                                   aria-label="Buka pengaturan">
                                    <div class="bg-gradient-to-br from-blue-100 to-indigo-100 p-2 rounded-xl group-hover/item:scale-110 transition-transform duration-200">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <span>Pengaturan</span>
                                </a>
                                <div class="border-t border-gray-100 my-2"></div>
                                <form action="{{ route('logout') }}" method="POST" class="px-4 py-2">
                                    @csrf
                                    <button type="submit"
                                            class="flex items-center gap-3 w-full text-left text-sm text-red-600 hover:bg-gradient-to-r hover:from-red-50 hover:to-orange-50 rounded-xl px-2 py-2.5 transition-all duration-200 group/item"
                                            aria-label="Keluar dari sistem">
                                        <div class="bg-gradient-to-br from-red-100 to-orange-100 p-2 rounded-xl group-hover/item:scale-110 transition-transform duration-200">
                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                            </svg>
                                        </div>
                                        <span class="font-medium">Keluar</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Enhanced Flash Messages --}}
            @if(session()->has('success') || session()->has('error') || session()->has('info') || session()->has('warning'))
                <div class="fixed top-20 right-4 z-50 space-y-2 max-w-sm">
                    @if(session()->has('success'))
                        <div class="glass border-l-4 border-green-400 p-4 rounded-xl shadow-xl transform transition-all duration-500 ease-in-out">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">
                                        {{ session('success') }}
                                    </p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <div class="-mx-1.5 -my-1.5">
                                        <button onclick="this.parentElement.parentElement.parentElement.parentElement.remove()"
                                                class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600 focus-ring"
                                                aria-label="Tutup notifikasi sukses">
                                            <span class="sr-only">Dismiss</span>
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(session()->has('error'))
                        <div class="glass border-l-4 border-red-400 p-4 rounded-xl shadow-xl transform transition-all duration-500 ease-in-out">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800">
                                        {{ session('error') }}
                                    </p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <div class="-mx-1.5 -my-1.5">
                                        <button onclick="this.parentElement.parentElement.parentElement.parentElement.remove()"
                                                class="inline-flex bg-red-50 rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-50 focus:ring-red-600 focus-ring"
                                                aria-label="Tutup notifikasi error">
                                            <span class="sr-only">Dismiss</span>
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(session()->has('info'))
                        <div class="glass border-l-4 border-blue-400 p-4 rounded-xl shadow-xl transform transition-all duration-500 ease-in-out">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-blue-800">
                                        {{ session('info') }}
                                    </p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <div class="-mx-1.5 -my-1.5">
                                        <button onclick="this.parentElement.parentElement.parentElement.parentElement.remove()"
                                                class="inline-flex bg-blue-50 rounded-md p-1.5 text-blue-500 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-50 focus:ring-blue-600 focus-ring"
                                                aria-label="Tutup notifikasi info">
                                            <span class="sr-only">Dismiss</span>
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(session()->has('warning'))
                        <div class="glass border-l-4 border-yellow-400 p-4 rounded-xl shadow-xl transform transition-all duration-500 ease-in-out">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-yellow-800">
                                        {{ session('warning') }}
                                    </p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <div class="-mx-1.5 -my-1.5">
                                        <button onclick="this.parentElement.parentElement.parentElement.parentElement.remove()"
                                                class="inline-flex bg-yellow-50 rounded-md p-1.5 text-yellow-500 hover:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-yellow-50 focus:ring-yellow-600 focus-ring"
                                                aria-label="Tutup notifikasi peringatan">
                                            <span class="sr-only">Dismiss</span>
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <script>
                    // Auto-hide flash messages after 5 seconds
                    setTimeout(function() {
                        const messages = document.querySelectorAll('.fixed.top-20.right-4 > div');
                        messages.forEach(function(message) {
                            message.style.opacity = '0';
                            message.style.transform = 'translateX(100%)';
                            setTimeout(function() {
                                message.remove();
                            }, 500);
                        });
                    }, 5000);
                </script>
            @endif

            {{-- Enhanced Page Content --}}
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 transition-all duration-300">
                <div class="max-w-8xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        // Enhanced layout initialization
        document.addEventListener('alpine:init', () => {
            Alpine.data('layout', () => ({
                init() {
                    // Theme management
                    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                        this.darkMode = true;
                    } else {
                        this.darkMode = false;
                    }

                    // Sidebar responsive management
                    this.sidebarOpen = window.innerWidth >= 1024;
                    
                    // Enhanced resize listener
                    let resizeTimer;
                    window.addEventListener('resize', () => {
                        clearTimeout(resizeTimer);
                        resizeTimer = setTimeout(() => {
                            this.sidebarOpen = window.innerWidth >= 1024;
                        }, 150);
                    });

                    // Enhanced keyboard shortcuts
                    document.addEventListener('keydown', (e) => {
                        // Toggle sidebar with Ctrl+B
                        if (e.ctrlKey && e.key === 'b') {
                            e.preventDefault();
                            this.sidebarOpen = !this.sidebarOpen;
                        }
                        // Toggle dark mode with Ctrl+D
                        if (e.ctrlKey && e.key === 'd') {
                            e.preventDefault();
                            this.darkMode = !this.darkMode;
                            localStorage.theme = this.darkMode ? 'dark' : 'light';
                        }
                    });
                }
            }));
        });

        // Performance optimization: Lazy load images
        document.addEventListener('DOMContentLoaded', function() {
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            img.classList.remove('opacity-0');
                            img.classList.add('opacity-100');
                            observer.unobserve(img);
                        }
                    });
                });

                document.querySelectorAll('img[data-src]').forEach(img => {
                    imageObserver.observe(img);
                });
            }
        });
    </script>
</body>
</html>