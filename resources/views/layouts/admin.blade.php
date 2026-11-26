<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - JAGARASA Lampung')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            gold: '#F59E0B',
                            goldDark: '#D97706',
                            brown: '#451A03',
                            leaf: '#15803D',
                        }
                    },
                    fontFamily: {
                        heading: ['"Plus Jakarta Sans"', 'sans-serif'],
                        body: ['"Inter"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-heading { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen flex antialiased">

    <!-- Mobile Sidebar Backdrop -->
    <div id="sidebar-backdrop" 
         onclick="toggleSidebar()" 
         class="fixed inset-0 bg-slate-900/60 z-40 hidden lg:hidden backdrop-blur-xs transition-opacity"></div>

    <!-- SIDEBAR -->
    <aside id="admin-sidebar" 
           class="fixed lg:static top-0 bottom-0 left-0 z-50 w-72 bg-amber-950 text-amber-100 flex flex-col justify-between transition-transform duration-300 -translate-x-full lg:translate-x-0 shadow-2xl lg:shadow-none">
        <div>
            <!-- Sidebar Header -->
            <div class="h-20 flex items-center justify-between px-6 border-b border-amber-900/60 bg-amber-950/60">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo-jagarasa.png') }}" 
                         alt="Logo Jagarasa" 
                         class="h-10 w-10 rounded-full object-cover ring-2 ring-amber-400"
                         onerror="this.src='{{ asset('logo.jpg') }}'">
                    <div>
                        <div class="font-heading font-black text-lg text-amber-400 tracking-wide leading-tight">
                            JAGA<span class="text-white">RASA</span>
                        </div>
                        <span class="text-[10px] text-amber-300 font-medium uppercase tracking-wider block">Admin Management</span>
                    </div>
                </a>

                <button onclick="toggleSidebar()" class="lg:hidden text-amber-300 hover:text-white p-2">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Profile Info in Sidebar -->
            <div class="p-5 border-b border-amber-900/40 bg-amber-900/20">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-400 border border-amber-500/40 flex items-center justify-center font-bold">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div class="overflow-hidden">
                        <div class="text-xs font-bold text-white truncate">{{ Auth::user()->name ?? 'Admin Jagarasa' }}</div>
                        <div class="text-[11px] text-amber-300/80 truncate">{{ Auth::user()->email ?? 'admin@jagarasa.com' }}</div>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1.5 text-sm font-medium">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-amber-500 text-white font-bold shadow-md shadow-amber-600/30' : 'text-amber-200/80 hover:bg-amber-900/50 hover:text-white' }}">
                    <i class="fa-solid fa-chart-pie w-5 text-center"></i>
                    <span>Dashboard Utama</span>
                </a>

                <!-- Kelola Produk CRUD -->
                <a href="{{ route('admin.products.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.products.*') ? 'bg-amber-500 text-white font-bold shadow-md shadow-amber-600/30' : 'text-amber-200/80 hover:bg-amber-900/50 hover:text-white' }}">
                    <i class="fa-solid fa-boxes-stacked w-5 text-center"></i>
                    <span>Katalog Produk</span>
                </a>

                <!-- Laporan Penjualan (New) -->
                <a href="{{ route('admin.reports.sales') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.reports.sales') ? 'bg-amber-500 text-white font-bold shadow-md shadow-amber-600/30' : 'text-amber-200/80 hover:bg-amber-900/50 hover:text-white' }}">
                    <i class="fa-solid fa-chart-line w-5 text-center"></i>
                    <span>Laporan Penjualan</span>
                    <span class="ml-auto text-[10px] bg-emerald-500/20 text-emerald-300 px-2 py-0.5 rounded-full border border-emerald-500/30">Grafik</span>
                </a>

                <div class="pt-4 pb-2 px-4 text-[11px] font-bold uppercase tracking-wider text-amber-400/60">
                    Situs Publik
                </div>

                <!-- Preview Web Publik -->
                <a href="{{ route('home') }}" target="_blank"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-amber-200/80 hover:bg-amber-900/50 hover:text-white transition">
                    <i class="fa-solid fa-arrow-up-right-from-square w-5 text-center text-amber-400"></i>
                    <span>Buka Toko Jagarasa</span>
                </a>
            </nav>
        </div>

        <!-- Sidebar Footer & Logout -->
        <div class="p-4 border-t border-amber-900/60 bg-amber-950/80">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" 
                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-rose-300 bg-rose-950/50 hover:bg-rose-900/70 hover:text-white border border-rose-800/40 transition">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN WRAPPER -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        <!-- Top Navbar -->
        <header class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-xs">
            <div class="px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
                <!-- Hamburger Button -->
                <div class="flex items-center gap-3">
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-xl text-slate-600 hover:bg-slate-100 focus:outline-hidden">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                    <div class="text-sm font-semibold text-slate-700 hidden sm:block">
                        Panel Kontrol Administrator UMKM
                    </div>
                </div>

                <!-- Right Quick Actions -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" target="_blank" 
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-800 text-xs font-semibold border border-amber-200 transition">
                        <i class="fa-solid fa-eye"></i>
                        <span class="hidden sm:inline">Preview Web</span>
                    </a>

                    <div class="h-6 w-px bg-slate-200 mx-1"></div>

                    <!-- User Pill -->
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-amber-500 text-white flex items-center justify-center font-bold text-xs shadow-xs">
                            {{ substr(Auth::user()->name ?? 'Admin', 0, 1) }}
                        </div>
                        <span class="text-xs font-bold text-slate-700 hidden md:block">
                            {{ Auth::user()->name ?? 'Admin' }}
                        </span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Flash Messages -->
        <div class="px-4 sm:px-6 lg:px-8 pt-4">
            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-r-xl shadow-xs flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-rose-50 border-l-4 border-rose-500 text-rose-800 p-4 rounded-r-xl shadow-xs flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-triangle-exclamation text-rose-500 text-lg"></i>
                        <p class="text-sm font-medium">{{ session('error') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif
        </div>

        <!-- Content Area -->
        <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-slate-200 py-4 px-6 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} JAGARASA LAMPUNG &bull; Sistem Informasi & Manajemen Produk UMKM
        </footer>
    </div>

    <!-- Script Sidebar Toggle -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }
    </script>

    @stack('scripts')
</body>
</html>
