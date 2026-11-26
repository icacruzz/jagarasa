@extends('layouts.app')

@section('title', 'JAGARASA - Oleh-Oleh Camilan Khas Lampung Pilihan')

@section('content')
    <!-- HERO SECTION -->
    <section id="hero" class="relative overflow-hidden bg-gradient-to-b from-amber-100/70 via-amber-50/50 to-transparent py-12 sm:py-20 lg:py-24 border-b border-amber-200/40">
        <!-- Background Ornaments -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-amber-300/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 -left-20 w-80 h-80 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Text Column -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/15 border border-amber-500/30 text-amber-900 text-xs sm:text-sm font-semibold">
                        <i class="fa-solid fa-crown text-amber-600"></i>
                        <span>Pusat Oleh-Oleh Khas Lampung Terpercaya</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-amber-950 font-heading leading-tight tracking-tight">
                        Oleh-Oleh Khas Lampung, <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-600 via-amber-500 to-yellow-600">Renyahnya Bikin Rindu</span> Kampung Halaman.
                    </h1>

                    <p class="text-base sm:text-lg text-amber-900/80 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        Cicipi kelezatan autentik Keripik Pisang Kepok aneka rasa renyah, Singkong Balado gurih, Kemplang Panggang ikan tenggiri, dan Kopi Robusta khas dataran tinggi Lampung.
                    </p>

                    <!-- CTAs -->
                    <div class="pt-2 flex flex-wrap items-center justify-center lg:justify-start gap-4">
                        <a href="#katalog" 
                           class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl font-bold text-white bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 shadow-md hover:shadow-xl transition transform hover:-translate-y-0.5 text-sm sm:text-base">
                            <i class="fa-solid fa-basket-shopping"></i>
                            <span>Jelajahi Katalog</span>
                        </a>

                        <a href="#tentang" 
                           class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl font-bold text-amber-950 bg-white/80 border border-amber-300 hover:bg-amber-100/60 shadow-xs transition text-sm sm:text-base">
                            <i class="fa-solid fa-circle-info text-amber-700"></i>
                            <span>Tentang Jagarasa</span>
                        </a>
                    </div>

                    <!-- Highlights Badge -->
                    <div class="pt-4 grid grid-cols-3 gap-4 border-t border-amber-200/80 max-w-lg mx-auto lg:mx-0 text-left">
                        <div>
                            <div class="text-xl sm:text-2xl font-black text-amber-900 font-heading">100%</div>
                            <div class="text-xs text-amber-800/70">Bahan Baku Asli Lampung</div>
                        </div>
                        <div>
                            <div class="text-xl sm:text-2xl font-black text-amber-900 font-heading">Higienis</div>
                            <div class="text-xs text-amber-800/70">Kemasan Sealing Rapi</div>
                        </div>
                        <div>
                            <div class="text-xl sm:text-2xl font-black text-amber-900 font-heading">Autentik</div>
                            <div class="text-xs text-amber-800/70">Cita Rasa Tradisional</div>
                        </div>
                    </div>
                </div>

                <!-- Visual Image Column -->
                <div class="lg:col-span-5 flex justify-center">
                    <div class="relative w-72 sm:w-96 aspect-square">
                        <!-- Glow behind card -->
                        <div class="absolute inset-0 bg-gradient-to-tr from-amber-400 to-amber-200 rounded-3xl rotate-6 filter blur-xl opacity-60"></div>
                        
                        <!-- Main Card with Logo -->
                        <div class="relative bg-white p-6 rounded-3xl border border-amber-200 shadow-2xl flex flex-col items-center justify-center text-center h-full">
                            <img src="{{ asset('images/logo-jagarasa.png') }}" 
                                 alt="Logo Jagarasa Lampung" 
                                 class="w-44 h-44 sm:w-56 sm:h-56 object-cover rounded-full shadow-lg ring-4 ring-amber-400/70 hover:scale-105 transition-transform duration-300"
                                 onerror="this.src='{{ asset('logo.jpg') }}'">

                            <div class="mt-4">
                                <h3 class="text-xl sm:text-2xl font-black font-heading text-amber-950">JAGARASA</h3>
                                <p class="text-xs font-semibold text-emerald-700 mt-0.5">
                                    <i class="fa-solid fa-leaf mr-1"></i> Kelezatan Asli Tanah Siger
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION PROFIL USAHA (TENTANG KAMI) -->
    <section id="tentang" class="py-16 sm:py-24 bg-white border-b border-amber-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-amber-600 bg-amber-100 px-3 py-1 rounded-full">Profil Usaha</span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-amber-950 font-heading mt-3">
                    Dedikasi Menjaga Keaslian Rasa Lampung
                </h2>
                <div class="w-20 h-1 bg-amber-500 mx-auto rounded-full mt-4 mb-4"></div>
                <p class="text-amber-900/80 text-sm sm:text-base leading-relaxed">
                    Jagarasa lahir dari inisiatif untuk melestarikan dan mengangkat kualitas aneka camilan khas Lampung. Menggunakan pisang kepok segar dari petani lokal, rempah-rempah pilihan, serta racikan bumbu khas yang diwariskan turun-temurun.
                </p>
            </div>

            <!-- 3 Keunggulan Card -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="p-8 rounded-2xl bg-amber-50/60 border border-amber-200/70 hover:border-amber-400 transition hover:shadow-lg">
                    <div class="w-14 h-14 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center text-2xl mb-6">
                        <i class="fa-solid fa-seedling"></i>
                    </div>
                    <h3 class="text-lg font-bold text-amber-950 font-heading mb-2">Bahan Baku Lokal Pilihan</h3>
                    <p class="text-sm text-amber-900/75 leading-relaxed">
                        Diproduksi langsung dari pisang kepok kuning Lampung yang terkenal tebal, manis alami, serta singkong segar berkualitas unggul dari perkebunan lokal.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="p-8 rounded-2xl bg-amber-50/60 border border-amber-200/70 hover:border-amber-400 transition hover:shadow-lg">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-600/10 text-emerald-600 flex items-center justify-center text-2xl mb-6">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h3 class="text-lg font-bold text-amber-950 font-heading mb-2">Kemasan Higienis & Tahan Lama</h3>
                    <p class="text-sm text-amber-900/75 leading-relaxed">
                        Dikemas dengan teknologi sealing modern dan aluminium foil kedap udara, menjaga kerenyahan maksimal untuk dinikmati kapan saja atau dijadikan buah tangan.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="p-8 rounded-2xl bg-amber-50/60 border border-amber-200/70 hover:border-amber-400 transition hover:shadow-lg">
                    <div class="w-14 h-14 rounded-2xl bg-amber-600/10 text-amber-700 flex items-center justify-center text-2xl mb-6">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <h3 class="text-lg font-bold text-amber-950 font-heading mb-2">Bumbu Melimpah & Autentik</h3>
                    <p class="text-sm text-amber-900/75 leading-relaxed">
                        Taburan bumbu cokelat premium lumer, keju susu gurih, dan balado rempah yang tebal merata di setiap gigitan keripik.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION KATALOG PRODUK (PUBLIK) -->
    <section id="katalog" class="py-16 sm:py-24 bg-amber-50/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full">Koleksi Oleh-Oleh</span>
                    <h2 class="text-2xl sm:text-4xl font-extrabold text-amber-950 font-heading mt-2">
                        Pilihan Camilan Terbaik Jagarasa
                    </h2>
                    <p class="text-sm text-amber-900/75 mt-1">
                        Pilih produk favorit Anda, langsung dari dapur produksi Lampung.
                    </p>
                </div>

                <!-- Quick Admin Jump -->
                <div>
                    <a href="{{ route('admin.products.create') }}" 
                       class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-amber-700 hover:text-amber-800 bg-amber-100/80 hover:bg-amber-200/80 px-4 py-2 rounded-xl transition">
                        <i class="fa-solid fa-plus-circle"></i>
                        <span>Tambah Produk Baru (Admin)</span>
                    </a>
                </div>
            </div>

            <!-- Filter Kategori Interaktif -->
            <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-8 scrollbar-none">
                <a href="{{ route('home') }}#katalog" 
                   class="px-5 py-2.5 rounded-full text-xs sm:text-sm font-semibold transition whitespace-nowrap {{ empty($selectedCategory) || $selectedCategory === 'semua' ? 'bg-amber-600 text-white shadow-md' : 'bg-white text-amber-900 border border-amber-200 hover:bg-amber-100' }}">
                    Semua Kategori ({{ $categories->sum('products_count') }})
                </a>

                @foreach($categories as $category)
                    <a href="{{ route('home', ['kategori' => $category->slug]) }}#katalog" 
                       class="px-5 py-2.5 rounded-full text-xs sm:text-sm font-semibold transition whitespace-nowrap {{ $selectedCategory === $category->slug ? 'bg-amber-600 text-white shadow-md' : 'bg-white text-amber-900 border border-amber-200 hover:bg-amber-100' }}">
                        {{ $category->nama_kategori }} ({{ $category->products_count }})
                    </a>
                @endforeach
            </div>

            <!-- Grid Card Produk -->
            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    @foreach($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl border border-amber-200 p-12 text-center max-w-lg mx-auto">
                    <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto text-2xl mb-4">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <h3 class="text-lg font-bold text-amber-950 font-heading">Belum Ada Produk di Kategori Ini</h3>
                    <p class="text-sm text-amber-800/70 mt-1 mb-6">
                        Silakan pilih kategori lain atau tambahkan produk baru melalui dashboard admin.
                    </p>
                    <a href="{{ route('home') }}#katalog" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-amber-500 text-white font-medium text-xs">
                        Lihat Semua Produk
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
