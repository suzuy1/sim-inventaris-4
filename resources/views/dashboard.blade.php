<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Inventaris') }} - @yield('title', 'Dasbor')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }
        [x-cloak] { display: none !important; }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(241, 245, 249, 0.5);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #94a3b8 0%, #64748b 100%);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
        }

        /* Glass morphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #7c3aed 0%, #4f46e5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Floating animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        /* Sidebar collapse transition */
        .sidebar-collapsed {
            width: 5rem !important;
        }
        .sidebar-expanded {
            width: 18rem !important;
        }
        .main-content-expanded {
            margin-left: 0 !important;
        }
        .main-content-collapsed {
            margin-left: 5rem !important;
        }
    </style>
</head>
<body class="font-sans antialiased">
    
    <div x-data="{ 
        sidebarOpen: window.innerWidth >= 1024, 
        darkMode: false,
        sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true'
    }" 
         :class="{ 
             'dark': darkMode,
             'sidebar-collapsed': sidebarCollapsed 
         }" 
         class="flex h-screen overflow-hidden transition-all duration-300">

        {{-- Overlay untuk mobile --}}
        <div x-show="!sidebarOpen && window.innerWidth < 1024" 
             x-transition:enter="transition-opacity ease-linear duration-200"
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-200"
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="fixed inset-0 z-20 bg-black/60 backdrop-blur-sm lg:hidden"></div>

        {{-- Sidebar --}}
        <aside x-show="sidebarOpen || window.innerWidth >= 1024" 
               x-transition:enter="transition ease-in-out duration-300 transform"
               x-transition:enter-start="-translate-x-full" 
               x-transition:enter-end="translate-x-0"
               x-transition:leave="transition ease-in-out duration-300 transform"
               x-transition:leave-start="translate-x-0" 
               x-transition:leave-end="-translate-x-full"
               :class="sidebarCollapsed ? 'sidebar-collapsed' : 'sidebar-expanded'"
               class="fixed lg:static inset-y-0 left-0 z-30 bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 text-gray-300 flex flex-col shadow-2xl lg:shadow-xl border-r border-gray-700/50 transition-all duration-300">
            
            {{-- Logo Section --}}
            <div class="flex items-center justify-between h-20 px-4 lg:px-6 bg-gradient-to-r from-purple-600/20 to-indigo-600/20 border-b border-gray-700/50 backdrop-blur-sm">
                <div class="flex items-center space-x-3" :class="sidebarCollapsed ? 'justify-center w-full' : ''">
                    <div class="relative">
                        <img src="{{ asset('logo/ubbg.jpg') }}" alt="Logo Universitas" class="w-10 h-10 rounded-xl object-cover border-2 border-purple-400/30 shadow-lg float-animation">
                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 border-2 border-gray-900 rounded-full"></div>
                    </div>
                    <div x-show="!sidebarCollapsed" class="transition-opacity duration-300">
                        <span class="text-lg font-bold text-white tracking-tight">Sistem Inventaris</span>
                        <p class="text-xs text-gray-400">Management System</p>
                    </div>
                </div>
                
                {{-- Close button for mobile --}}
                <button x-show="!sidebarCollapsed" @click="sidebarOpen = false" class="lg:hidden p-1.5 rounded-lg bg-gray-700/50 hover:bg-gray-600/50 transition-colors">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18-6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-3 py-6 space-y-1.5 overflow-y-auto" :class="sidebarCollapsed ? 'px-2' : 'px-4'">
                @php
                    $menuItems = [
                        ['route' => 'dashboard', 'label' => 'Dasbor', 'icon' => 'heroicon-o-home'],
                        [
                            'label' => 'Barang',
                            'icon' => 'heroicon-o-cube',
                            'children' => [
                                ['route' => 'inventaris.index', 'params' => ['kategori' => 'tidak_habis_pakai'], 'label' => 'Tidak Habis Pakai'],
                                ['route' => 'inventaris.index', 'params' => ['kategori' => 'habis_pakai'], 'label' => 'Habis Pakai'],
                                ['route' => 'inventaris.index', 'params' => ['kategori' => 'aset_tetap'], 'label' => 'Aset Tetap'],
                                ['route' => 'inventaris.index', 'label' => 'Semua Barang'],
                            ]
                        ],
                        ['route' => 'acquisitions.index', 'label' => 'Akuisisi', 'icon' => 'heroicon-o-arrow-up-circle'],
                        ['route' => 'rooms.index', 'label' => 'Ruangan', 'icon' => 'heroicon-o-building-library'],
                        ['route' => 'units.index', 'label' => 'Unit', 'icon' => 'heroicon-o-squares-2x2'],
                        ['route' => 'users.index', 'label' => 'Pengguna', 'icon' => 'heroicon-o-users'],
                        ['route' => 'transactions.index', 'label' => 'Transaksi', 'icon' => 'heroicon-o-arrow-path'],
                        ['route' => 'settings.index', 'label' => 'Pengaturan', 'icon' => 'heroicon-o-cog-6-tooth'],
                    ];
                @endphp

                @foreach($menuItems as $item)
                    @if(isset($item['children']))
                        <x-sidebar-dropdown :label="$item['label']" :icon="$item['icon']" :active="request()->routeIs('inventaris.*')" collapsed="false" x-bind:collapsed="sidebarCollapsed">
                            @foreach($item['children'] as $child)
                                @php
                                    $isChildActive = false;
                                    $childParams = $child['params'] ?? [];

                                    if (request()->routeIs($child['route'])) {
                                        if (isset($childParams['kategori'])) {
                                            $isChildActive = request()->query('kategori') === $childParams['kategori'];
                                        } elseif (!request()->query('kategori')) {
                                            $isChildActive = !request()->has('kategori');
                                        }
                                    }
                                @endphp
                                <x-sidebar-link 
                                    :route="$child['route']" 
                                    :params="$childParams"
                                    :label="$child['label']"
                                    :active="$isChildActive"
                                    collapsed="false" x-bind:collapsed="sidebarCollapsed" />
                            @endforeach
                        </x-sidebar-dropdown>
                    @else
                        <x-sidebar-link 
                            :route="$item['route']" 
                            :label="$item['label']"
                            :icon="$item['icon']"
                            :active="request()->routeIs($item['route'] . '*')"
                            collapsed="false" x-bind:collapsed="sidebarCollapsed" />
                    @endif
                @endforeach
            </nav>

            {{-- Sidebar Footer --}}
            <div class="p-3 border-t border-gray-700/50 bg-gray-800/30 backdrop-blur-sm" :class="sidebarCollapsed ? 'px-2' : 'px-4'">
                {{-- Collapse Button --}}
                <button @click="sidebarCollapsed = !sidebarCollapsed; localStorage.setItem('sidebarCollapsed', sidebarCollapsed)" 
                        class="w-full flex items-center justify-center lg:justify-start gap-2 p-2.5 rounded-lg bg-gray-700/50 hover:bg-gray-600/50 transition-all duration-200 group mb-3"
                        :title="sidebarCollapsed ? 'Expand Sidebar' : 'Collapse Sidebar'">
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-300" 
                         :class="{ 'rotate-180': sidebarCollapsed }" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                    </svg>
                    <span x-show="!sidebarCollapsed" class="text-xs font-medium text-gray-400 transition-opacity duration-300">
                        Collapse Sidebar
                    </span>
                </button>

                <div class="flex items-center justify-between mb-3" x-show="!sidebarCollapsed">
                    <span class="text-xs font-medium text-gray-400">Mode Tampilan</span>
                    <button @click="darkMode = !darkMode" 
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-gray-600 transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                            :class="{ 'bg-purple-600': darkMode, 'bg-gray-600': !darkMode }">
                        <span class="sr-only">Toggle dark mode</span>
                        <span class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                              :class="{ 'translate-x-5': darkMode, 'translate-x-0': !darkMode }">
                            <span class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity duration-200 ease-in-out"
                                  :class="{ 'opacity-0 duration-100 ease-out': darkMode, 'opacity-100 duration-200 ease-in': !darkMode }">
                                <svg class="h-3 w-3 text-gray-600" fill="none" viewBox="0 0 12 12">
                                    <path d="M4 8a4 4 0 1 1 4-4" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                </svg>
                            </span>
                            <span class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity duration-200 ease-in-out"
                                  :class="{ 'opacity-100 duration-200 ease-in': darkMode, 'opacity-0 duration-100 ease-out': !darkMode }">
                                <svg class="h-3 w-3 text-purple-600" fill="currentColor" viewBox="0 0 12 12">
                                    <path d="M6 1a1 1 0 0 1 1 1v1a1 1 0 1 1-2 0V2a1 1 0 0 1 1-1ZM3.5 3.5a1 1 0 0 1 1.414 0l.707.707a1 1 0 0 1-1.414 1.414l-.707-.707a1 1 0 0 1 0-1.414Zm5 0a1 1 0 0 1 0 1.414l-.707.707a1 1 0 0 1-1.414-1.414l.707-.707a1 1 0 0 1 1.414 0ZM6 9a1 1 0 0 1 1 1v1a1 1 0 1 1-2 0v-1a1 1 0 0 1 1-1Zm-2.5 1.5a1 1 0 0 1 0-1.414l.707-.707a1 1 0 0 1 1.414 1.414l-.707.707a1 1 0 0 1-1.414 0Zm5 0a1 1 0 0 1-1.414 0l-.707-.707a1 1 0 0 1 1.414-1.414l.707.707a1 1 0 0 1 0 1.414ZM6 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
                                </svg>
                            </span>
                        </span>
                    </button>
                </div>
                <div class="text-xs text-gray-500 text-center" x-show="!sidebarCollapsed">
                    &copy; {{ date('Y') }} Sistem Inventaris v1.0
                </div>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex flex-1 flex-col overflow-hidden w-full transition-all duration-300"
             :class="sidebarCollapsed ? 'lg:ml-20' : ''">
            
            {{-- Top Navigation --}}
            <header class="sticky top-0 z-10 glass border-b border-gray-200/50 px-4 sm:px-6 py-3 shadow-sm">
                <div class="flex items-center justify-between">
                    
                    {{-- Left Section: Menu Toggle and Expand Button --}}
                    <div class="flex items-center gap-3">
                        {{-- Mobile menu toggle --}}
                        <button @click="sidebarOpen = !sidebarOpen" 
                                class="lg:hidden inline-flex items-center justify-center p-2.5 rounded-xl text-gray-600 hover:text-purple-600 hover:bg-white/50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-200">
                            <svg x-show="!sidebarOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            <svg x-show="sidebarOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>

                        {{-- Expand sidebar button for desktop when collapsed --}}
                        <button x-show="sidebarCollapsed && window.innerWidth >= 1024" 
                                @click="sidebarCollapsed = false; localStorage.setItem('sidebarCollapsed', false)"
                                class="hidden lg:flex items-center justify-center p-2.5 rounded-xl text-gray-600 hover:text-purple-600 hover:bg-white/50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-200"
                                title="Expand Sidebar">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>

                        {{-- Breadcrumb or page title can go here --}}
                        <div class="hidden md:block">
                            <h1 class="text-lg font-semibold text-gray-900">@yield('title', 'Dasbor')</h1>
                        </div>
                    </div>

                    {{-- Search Bar --}}
                    <div class="flex-1 max-w-2xl mx-4 lg:mx-8">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-6-6m2-5a7 7 0 1 1-14 0 7 7 0 0 1 14 0z"/>
                                </svg>
                            </div>
                            <input type="text" 
                                   class="block w-full pl-11 pr-4 py-2.5 border border-gray-200/80 rounded-xl bg-white/50 focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-purple-300 text-sm transition-all duration-200 placeholder-gray-500 shadow-sm"
                                   placeholder="Cari barang, transaksi, atau pengguna...">
                        </div>
                    </div>

                    {{-- Right Menu --}}
                    <div class="flex items-center gap-3">
                        
                        {{-- Theme Toggle --}}
                        <button @click="darkMode = !darkMode" 
                                class="hidden md:flex items-center justify-center p-2.5 text-gray-600 hover:text-purple-600 hover:bg-white/50 rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                                :title="darkMode ? 'Switch to Light Mode' : 'Switch to Dark Mode'">
                            <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                            <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </button>

                        {{-- Notifications --}}
                        <div x-data="{ open: false }" @click.away="open = false" class="relative">
                            <button @click="open = !open" 
                                    class="relative p-2.5 text-gray-600 hover:text-purple-600 hover:bg-white/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM10.5 3.75a6 6 0 0 0-6 6v2.25l-2.47 2.47a.75.75 0 0 0 .53 1.28h15.88a.75.75 0 0 0 .53-1.28L16.5 12V9.75a6 6 0 00-6-6z"/>
                                </svg>
                                @if(isset($pendingRequests) && $pendingRequests > 0)
                                    <span class="absolute top-2 right-2 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                                @endif
                            </button>
                            
                            <div x-show="open" x-transition 
                                 class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-gray-200/80 py-2 backdrop-blur-sm">
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <h3 class="text-sm font-semibold text-gray-900">Notifikasi</h3>
                                </div>
                                <div class="max-h-96 overflow-y-auto">
                                    <div class="px-4 py-6 text-center">
                                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                                        </svg>
                                        <p class="text-sm text-gray-500">Tidak ada notifikasi baru</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- User Menu --}}
                        <div x-data="{ open: false }" @click.away="open = false" class="relative">
                            <button @click="open = !open" 
                                    class="flex items-center gap-3 p-2 rounded-xl hover:bg-white/50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-200 group">
                                <div class="relative">
                                    <img class="w-9 h-9 rounded-xl object-cover border-2 border-purple-200 group-hover:border-purple-300 transition-colors shadow-sm" 
                                         src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=e0f2fe&color=0ea5e9' }}" 
                                         alt="{{ Auth::user()->name }}">
                                    <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-400 border-2 border-white rounded-full"></div>
                                </div>
                                <div class="hidden md:block text-left">
                                    <div class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role ?? 'User') }}</div>
                                </div>
                                <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" 
                                     :class="{ 'rotate-180': open }" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div x-show="open" x-transition 
                                 class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-200/80 py-2 backdrop-blur-sm">
                                <div class="px-4 py-2 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('profile.edit') }}" 
                                   class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Profil Saya
                                </a>
                                <a href="{{ route('settings.index') }}" 
                                   class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Pengaturan
                                </a>
                                <div class="border-t border-gray-100 my-2"></div>
                                <form action="{{ route('logout') }}" method="POST" class="px-4 py-2">
                                    @csrf
                                    <button type="submit" 
                                            class="flex items-center gap-2 w-full text-left text-sm text-red-600 hover:bg-red-50 rounded-lg px-2 py-1.5 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

</body>
</html>
