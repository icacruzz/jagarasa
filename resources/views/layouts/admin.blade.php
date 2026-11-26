<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Jagarasa')</title>

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

    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-heading { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">

    <!-- Top Admin Header -->
    <header class="bg-amber-950 text-white shadow-md sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Brand -->
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo-jagarasa.png') }}" 
                         alt="Logo Jagarasa" 
                         class="h-10 w-10 rounded-full object-cover ring-2 ring-amber-400"
                         onerror="this.src='{{ asset('logo.jpg') }}'">
                    <div>
                        <a href="{{ route('admin.products.index') }}" class="font-heading font-black text-lg text-amber-400 tracking-wide">
                            JAGARASA <span class="text-white text-xs font-normal uppercase bg-amber-800/80 px-2 py-0.5 rounded ml-1">Admin Panel</span>
                        </a>
                    </div>
                </div>

                <!-- Right Nav -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" 
                       class="text-xs sm:text-sm text-amber-200 hover:text-white flex items-center gap-1.5 transition">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        <span>Lihat Website Publik</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Sub Navigation Bar -->
    <div class="bg-white border-b border-slate-200 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between py-3">
            <div class="flex items-center gap-6 text-sm font-semibold">
                <a href="{{ route('admin.products.index') }}" 
                   class="{{ request()->routeIs('admin.products.*') ? 'text-amber-600 border-b-2 border-amber-600 pb-1' : 'text-slate-600 hover:text-amber-600' }} flex items-center gap-2">
                    <i class="fa-solid fa-box-archive"></i>
                    <span>Katalog Produk</span>
                </a>
            </div>

            <div class="text-xs text-slate-500 font-medium">
                <i class="fa-solid fa-circle-check text-emerald-500 mr-1"></i> Mode Admin Aktif
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 w-full">
        @if(session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-r-xl shadow-xs flex items-center justify-between mb-4 animate-fade-in">
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

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 w-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-4 text-center text-xs text-slate-500">
        &copy; {{ date('Y') }} Jagarasa Admin Panel &bull; Manajemen Database Produk UMKM Lampung
    </footer>

    @stack('scripts')
</body>
</html>
