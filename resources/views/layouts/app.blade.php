<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'JAGARASA - Oleh-Oleh Khas Lampung Pilihan')</title>
    <meta name="description" content="@yield('meta_description', 'Pusat oleh-oleh camilan autentik khas Lampung. Keripik Pisang Kepok aneka rasa, Keripik Singkong Balado, Kemplang Panggang, dan Kopi Robusta Lampung.')">

    <!-- Fonts: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CDN + Custom Configuration -->
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
                            brownSoft: '#5C2D16',
                            leaf: '#15803D',
                            leafLight: '#22C55E',
                            cream: '#FFFBEB',
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

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #FFFBEB;
            color: #451A03;
        }
        h1, h2, h3, h4, h5, h6, .font-heading {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-amber-50/40 text-amber-950 flex flex-col min-h-screen">

    <!-- NAVBAR (Sticky) -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-amber-200/70 shadow-sm transition-all duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo & Brand -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo-jagarasa.png') }}" 
                         alt="Logo Jagarasa" 
                         class="h-12 w-12 sm:h-14 sm:w-14 rounded-full object-cover ring-2 ring-amber-500/50 shadow-md transition group-hover:scale-105"
                         onerror="this.src='{{ asset('logo.jpg') }}'">
                    <div>
                        <div class="text-xl sm:text-2xl font-black tracking-wider text-amber-950 font-heading">
                            JAGA<span class="text-amber-500">RASA</span>
                        </div>
                        <p class="text-[11px] font-medium text-amber-800 hidden sm:block -mt-1 tracking-tight">
                            Oleh-Oleh Khas Lampung
                        </p>
                    </div>
                </a>

                <!-- Navigation Links (Desktop) -->
                <nav class="hidden md:flex items-center gap-8 font-medium text-sm">
                    <a href="{{ route('home') }}#hero" class="text-amber-900 hover:text-amber-600 transition">Beranda</a>
                    <a href="{{ route('home') }}#tentang" class="text-amber-900 hover:text-amber-600 transition">Tentang Kami</a>
                    <a href="{{ route('home') }}#katalog" class="text-amber-900 hover:text-amber-600 transition">Katalog Oleh-Oleh</a>
                </nav>

                <!-- Action Button & Hamburger for Mobile -->
                <div class="flex items-center gap-2 sm:gap-3">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" 
                           class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-semibold text-xs sm:text-sm px-3.5 py-2 sm:px-4 sm:py-2.5 rounded-xl shadow-md hover:from-amber-600 hover:to-amber-700 transition">
                            <i class="fa-solid fa-gauge-high"></i>
                            <span class="hidden sm:inline">Dashboard</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-semibold text-xs sm:text-sm px-3.5 py-2 sm:px-4 sm:py-2.5 rounded-xl shadow-md hover:from-amber-600 hover:to-amber-700 transition">
                            <i class="fa-solid fa-lock"></i>
                            <span>Admin Login</span>
                        </a>
                    @endauth

                    <!-- Mobile Hamburger Button -->
                    <button type="button" 
                            onclick="toggleMobileMenu()"
                            class="md:hidden p-2 rounded-xl text-amber-900 hover:bg-amber-100 focus:outline-hidden transition"
                            aria-label="Toggle menu">
                        <i id="menu-icon" class="fa-solid fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div id="mobile-menu" class="hidden md:hidden border-t border-amber-200/80 py-4 px-2 space-y-2 bg-white/95 rounded-b-2xl shadow-lg">
                <a href="{{ route('home') }}#hero" 
                   onclick="toggleMobileMenu()" 
                   class="block px-4 py-2.5 rounded-xl text-sm font-semibold text-amber-950 hover:bg-amber-50 transition">
                    <i class="fa-solid fa-house text-amber-600 mr-2 w-4"></i> Beranda
                </a>
                <a href="{{ route('home') }}#tentang" 
                   onclick="toggleMobileMenu()" 
                   class="block px-4 py-2.5 rounded-xl text-sm font-semibold text-amber-950 hover:bg-amber-50 transition">
                    <i class="fa-solid fa-circle-info text-amber-600 mr-2 w-4"></i> Tentang Kami
                </a>
                <a href="{{ route('home') }}#katalog" 
                   onclick="toggleMobileMenu()" 
                   class="block px-4 py-2.5 rounded-xl text-sm font-semibold text-amber-950 hover:bg-amber-50 transition">
                    <i class="fa-solid fa-boxes-stacked text-amber-600 mr-2 w-4"></i> Katalog Oleh-Oleh
                </a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" 
                       class="block px-4 py-2.5 rounded-xl text-sm font-semibold text-amber-700 bg-amber-50 hover:bg-amber-100 transition">
                        <i class="fa-solid fa-gauge text-amber-600 mr-2 w-4"></i> Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="block px-4 py-2.5 rounded-xl text-sm font-semibold text-amber-700 bg-amber-50 hover:bg-amber-100 transition">
                        <i class="fa-solid fa-right-to-bracket text-amber-600 mr-2 w-4"></i> Masuk Admin
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const icon = document.getElementById('menu-icon');
            menu.classList.toggle('hidden');
            if (menu.classList.contains('hidden')) {
                icon.classList.remove('fa-xmark');
                icon.classList.add('fa-bars');
            } else {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-xmark');
            }
        }
    </script>


    <!-- MAIN CONTENT -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-amber-950 text-amber-100 border-t border-amber-900/40 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo-jagarasa.png') }}" 
                             alt="Logo Jagarasa" 
                             class="h-12 w-12 rounded-full object-cover ring-2 ring-amber-400"
                             onerror="this.src='{{ asset('logo.jpg') }}'">
                        <div>
                            <span class="text-2xl font-black text-amber-400 font-heading tracking-wide">JAGARASA</span>
                            <p class="text-xs text-amber-300">Menjaga Keaslian Rasa, Menghadirkan Kehangatan Lampung</p>
                        </div>
                    </div>
                    <p class="text-sm text-amber-200/80 leading-relaxed max-w-md">
                        UMKM kuliner khas Provinsi Lampung yang menghadirkan olahan camilan autentik seperti keripik pisang kepok aneka rasa, keripik singkong balado, kemplang panggang, dan kopi Robusta pilihan bermutu tinggi.
                    </p>
                </div>

                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-amber-400 font-heading mb-4">Navigasi Cepat</h4>
                    <ul class="space-y-2 text-sm text-amber-200/80">
                        <li><a href="{{ route('home') }}#hero" class="hover:text-amber-400 transition">Beranda Utama</a></li>
                        <li><a href="{{ route('home') }}#tentang" class="hover:text-amber-400 transition">Profil Usaha</a></li>
                        <li><a href="{{ route('home') }}#katalog" class="hover:text-amber-400 transition">Katalog Produk</a></li>
                        <li><a href="{{ route('admin.products.index') }}" class="hover:text-amber-400 transition">Panel Admin CRUD</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-amber-400 font-heading mb-4">Pusat Layanan</h4>
                    <ul class="space-y-2.5 text-sm text-amber-200/80">
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-location-dot text-amber-400 w-4"></i>
                            <span>Bandar Lampung, Indonesia</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-brands fa-whatsapp text-emerald-400 w-4"></i>
                            <a href="https://wa.me/6281234567890" target="_blank" class="hover:text-amber-400 transition">+62 812-3456-7890</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-envelope text-amber-400 w-4"></i>
                            <span>halo@jagarasa.id</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-amber-900/60 mt-12 pt-6 flex flex-col sm:flex-row items-center justify-between text-xs text-amber-300/70 gap-4">
                <p>&copy; {{ date('Y') }} JAGARASA UMKM Lampung. Hak Cipta Dilindungi.</p>
                <p class="flex items-center gap-1">
                    Dibuat dengan rasa bangga di Lampung <span class="text-red-500">&hearts;</span>
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
