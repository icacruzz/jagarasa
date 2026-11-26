@extends('layouts.app')

@section('title', $product->nama_produk . ' - JAGARASA Lampung')
@section('meta_description', Str::limit(strip_tags($product->deskripsi), 150))

@section('content')
<div class="py-8 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb Nav -->
        <nav class="flex items-center gap-2 text-xs sm:text-sm text-amber-800/70 mb-8">
            <a href="{{ route('home') }}" class="hover:text-amber-600">Beranda</a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <a href="{{ route('home', ['kategori' => $product->category->slug]) }}" class="hover:text-amber-600">
                {{ $product->category->nama_kategori }}
            </a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <span class="text-amber-950 font-semibold truncate">{{ $product->nama_produk }}</span>
        </nav>

        <!-- Product Detail Main Container -->
        <div class="bg-white rounded-3xl border border-amber-200/80 shadow-md overflow-hidden p-6 sm:p-10 lg:p-12 mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14">
                <!-- Gambar Produk -->
                <div class="lg:col-span-5">
                    <div class="relative aspect-square rounded-2xl overflow-hidden bg-amber-50 border border-amber-200/60 shadow-inner group">
                        <img src="{{ $product->gambar_url }}" 
                             alt="{{ $product->nama_produk }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                             onerror="this.src='{{ asset('images/logo-jagarasa.png') }}'">

                        <!-- Badge Category -->
                        <div class="absolute top-4 left-4">
                            <span class="px-3.5 py-1.5 rounded-full text-xs font-semibold bg-emerald-700 text-white shadow-sm">
                                {{ $product->category->nama_kategori }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-4 flex items-center justify-between text-xs text-amber-800/70 px-1">
                        <span class="flex items-center gap-1.5">
                            <i class="fa-solid fa-truck-fast text-amber-600"></i>
                            Kirim dari Bandar Lampung
                        </span>
                        <span class="flex items-center gap-1.5">
                            <i class="fa-solid fa-award text-amber-600"></i>
                            Kualitas Premium Terjamin
                        </span>
                    </div>
                </div>

                <!-- Info & Spesifikasi Produk -->
                <div class="lg:col-span-7 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-xs font-semibold px-2.5 py-0.5 rounded bg-amber-100 text-amber-800">
                                Kode: JAG-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                            @if($product->stok > 0)
                                <span class="text-xs font-semibold px-2.5 py-0.5 rounded bg-emerald-100 text-emerald-800">
                                    <i class="fa-solid fa-circle text-[8px] mr-1"></i> Stok Siap Kirim ({{ $product->stok }} pcs)
                                </span>
                            @else
                                <span class="text-xs font-semibold px-2.5 py-0.5 rounded bg-rose-100 text-rose-800">
                                    Stok Kosong
                                </span>
                            @endif
                        </div>

                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-amber-950 font-heading leading-tight mb-4">
                            {{ $product->nama_produk }}
                        </h1>

                        <!-- Pricing Card -->
                        <div class="bg-amber-50/70 border border-amber-200/80 rounded-2xl p-4 sm:p-5 mb-6 flex flex-wrap items-baseline gap-4">
                            <div class="text-2xl sm:text-3xl font-black text-amber-600 font-heading">
                                {{ $product->formatted_harga }}
                            </div>
                            <div class="text-xs text-amber-800/80">
                                / kemasan pouch {{ $product->berat_gram }}g
                            </div>
                        </div>

                        <!-- Deskripsi Lengkap -->
                        <div class="space-y-4 mb-8">
                            <h3 class="text-sm font-bold uppercase tracking-wider text-amber-900 font-heading">Deskripsi & Cita Rasa:</h3>
                            <div class="text-sm sm:text-base text-amber-900/80 leading-relaxed space-y-2">
                                <p>{{ $product->deskripsi }}</p>
                            </div>
                        </div>

                        <!-- Info Spesifikasi Box -->
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 p-4 rounded-xl bg-slate-50 border border-slate-200 text-xs mb-8">
                            <div>
                                <span class="text-slate-500 block">Berat Bersih</span>
                                <span class="font-bold text-slate-800">{{ $product->berat_gram }} Gram</span>
                            </div>
                            <div>
                                <span class="text-slate-500 block">Kategori</span>
                                <span class="font-bold text-slate-800">{{ $product->category->nama_kategori }}</span>
                            </div>
                            <div>
                                <span class="text-slate-500 block">Masa Simpan</span>
                                <span class="font-bold text-slate-800">Hingga 6 Bulan</span>
                            </div>
                        </div>
                    </div>

                    <!-- Call to Action Buttons -->
                    <div class="pt-6 border-t border-amber-100 flex flex-wrap items-center gap-4">
                        @php
                            $waMessage = rawurlencode("Halo Jagarasa, saya tertarik memesan produk oleh-oleh Lampung: {$product->nama_produk} ({$product->formatted_harga}). Apakah stok masih tersedia?");
                        @endphp
                        <a href="https://wa.me/6281234567890?text={{ $waMessage }}" 
                           target="_blank"
                           class="flex-1 inline-flex items-center justify-center gap-2.5 px-6 py-4 rounded-2xl font-bold text-white bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 shadow-md hover:shadow-lg transition">
                            <i class="fa-brands fa-whatsapp text-lg"></i>
                            <span>Pesan via WhatsApp Sekarang</span>
                        </a>

                        <a href="{{ route('home') }}#katalog" 
                           class="inline-flex items-center justify-center gap-2 px-5 py-4 rounded-2xl font-semibold text-amber-950 bg-amber-100 hover:bg-amber-200 transition text-sm">
                            <i class="fa-solid fa-arrow-left"></i>
                            <span>Kembali ke Katalog</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rekomendasi Produk Terkait -->
        @if($relatedProducts->count() > 0)
            <div class="mt-12">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-amber-600">Pilihan Serupa</span>
                        <h2 class="text-xl sm:text-2xl font-bold text-amber-950 font-heading">Produk Lain di Kategori Ini</h2>
                    </div>
                    <a href="{{ route('home', ['kategori' => $product->category->slug]) }}" class="text-xs sm:text-sm font-semibold text-amber-600 hover:text-amber-700">
                        Lihat Semua &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($relatedProducts as $rel)
                        <x-product-card :product="$rel" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
