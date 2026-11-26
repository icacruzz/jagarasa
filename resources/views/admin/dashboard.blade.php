@extends('layouts.admin')

@section('title', 'Dashboard Utama - Admin JAGARASA')

@section('content')
<div class="space-y-6">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-amber-600 via-amber-500 to-yellow-600 rounded-3xl p-6 sm:p-8 text-white shadow-lg relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-xl pointer-events-none"></div>
        <div class="relative z-10 max-w-2xl">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/20 text-xs font-semibold backdrop-blur-xs mb-3">
                <i class="fa-solid fa-crown text-amber-200"></i> Panel Manajemen Toko
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold font-heading">
                Selamat Datang, {{ Auth::user()->name ?? 'Administrator' }}!
            </h1>
            <p class="text-amber-100 text-xs sm:text-sm mt-1 leading-relaxed">
                Pantau performa katalog oleh-oleh, stok gudang, dan omset penjualan UMKM Jagarasa secara realtime.
            </p>
        </div>
    </div>

    <!-- 4 Key Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Metric 1: Total Omset Bulan Ini -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs text-slate-500 font-medium">Omset Bulan Ini</span>
                <p class="text-xl font-black text-slate-800 font-heading mt-1">
                    Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}
                </p>
                <span class="text-[11px] text-emerald-600 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-arrow-trend-up"></i> +18.7% vs bulan lalu
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-money-bill-wave"></i>
            </div>
        </div>

        <!-- Metric 2: Pesanan Selesai -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs text-slate-500 font-medium">Transaksi Selesai</span>
                <p class="text-xl font-black text-slate-800 font-heading mt-1">{{ $totalOrders }} Pesanan</p>
                <span class="text-[11px] text-emerald-600 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-circle-check"></i> Konversi tinggi
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
        </div>

        <!-- Metric 3: Total Produk -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs text-slate-500 font-medium">Total Produk Aktif</span>
                <p class="text-xl font-black text-slate-800 font-heading mt-1">{{ $totalProducts }} Item</p>
                <span class="text-[11px] text-slate-400 font-semibold mt-1 block">
                    Dalam {{ $totalCategories }} Kategori
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
        </div>

        <!-- Metric 4: Total Stok Gudang -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs text-slate-500 font-medium">Stok Tersedia</span>
                <p class="text-xl font-black text-slate-800 font-heading mt-1">{{ $totalStock }} Pcs</p>
                <span class="text-[11px] text-amber-600 font-semibold mt-1 block">
                    Siap kirim dari gudang
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-violet-50 text-violet-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-warehouse"></i>
            </div>
        </div>
    </div>

    <!-- Quick Action & Recent Products Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left: Produk Terbaru di Katalog -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
            <div class="p-5 border-b border-slate-200 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-bold text-slate-800 font-heading">Produk Terbaru di Katalog</h2>
                    <p class="text-xs text-slate-500">Daftar camilan yang baru saja ditambahkan</p>
                </div>
                <a href="{{ route('admin.products.index') }}" class="text-xs font-semibold text-amber-600 hover:text-amber-700">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="divide-y divide-slate-100">
                @forelse($recentProducts as $prod)
                    <div class="p-4 flex items-center justify-between hover:bg-slate-50 transition">
                        <div class="flex items-center gap-3">
                            <img src="{{ $prod->gambar_url }}" 
                                 alt="{{ $prod->nama_produk }}" 
                                 class="w-11 h-11 rounded-xl object-cover border border-slate-200 shadow-2xs"
                                 onerror="this.src='{{ asset('images/logo-jagarasa.png') }}'">
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">{{ $prod->nama_produk }}</h4>
                                <span class="text-xs text-slate-400">
                                    {{ $prod->category->nama_kategori }} &bull; {{ $prod->berat_gram }}g
                                </span>
                            </div>
                        </div>

                        <div class="text-right">
                            <div class="text-sm font-black text-amber-600">{{ $prod->formatted_harga }}</div>
                            <span class="text-xs text-slate-500">Sisa: <b>{{ $prod->stok }} pcs</b></span>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-400 text-xs">Belum ada produk.</div>
                @endforelse
            </div>
        </div>

        <!-- Right: Pintasan Cepat & Panduan -->
        <div class="space-y-6">
            <!-- Shortcut Buttons -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
                <h3 class="text-sm font-bold text-slate-800 font-heading mb-4">Aksi Cepat Admin</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.products.create') }}" 
                       class="w-full flex items-center justify-between px-4 py-3 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-semibold text-xs transition shadow-xs">
                        <span class="flex items-center gap-2">
                            <i class="fa-solid fa-plus-circle"></i> Tambah Produk Baru
                        </span>
                        <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    </a>

                    <a href="{{ route('admin.reports.sales') }}" 
                       class="w-full flex items-center justify-between px-4 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-semibold text-xs transition">
                        <span class="flex items-center gap-2">
                            <i class="fa-solid fa-chart-line text-emerald-600"></i> Buka Laporan Penjualan
                        </span>
                        <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    </a>

                    <a href="{{ route('home') }}" target="_blank"
                       class="w-full flex items-center justify-between px-4 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-semibold text-xs transition">
                        <span class="flex items-center gap-2">
                            <i class="fa-solid fa-store text-amber-600"></i> Cek Tampilan Web Publik
                        </span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- Profile Toko Card -->
            <div class="bg-amber-950 text-amber-100 p-6 rounded-2xl shadow-xs">
                <div class="flex items-center gap-3 mb-3">
                    <img src="{{ asset('images/logo-jagarasa.png') }}" alt="Logo" class="w-10 h-10 rounded-full ring-2 ring-amber-400" onerror="this.src='{{ asset('logo.jpg') }}'">
                    <div>
                        <div class="text-sm font-bold text-white font-heading">UMKM JAGARASA</div>
                        <div class="text-[11px] text-amber-300">Bandar Lampung, Indonesia</div>
                    </div>
                </div>
                <p class="text-xs text-amber-200/80 leading-relaxed">
                    Sistem informasi katalog dan manajemen produk siap menyongsong digitalisasi oleh-oleh khas Lampung.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
