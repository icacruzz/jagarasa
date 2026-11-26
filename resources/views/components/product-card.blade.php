@props(['product'])

<div class="bg-white rounded-2xl border border-amber-200/80 shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col h-full overflow-hidden group hover:-translate-y-1">
    <!-- Gambar Produk -->
    <div class="relative overflow-hidden aspect-4/3 bg-amber-50">
        <img src="{{ $product->gambar_url }}" 
             alt="{{ $product->nama_produk }}"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
             onerror="this.src='{{ asset('images/logo-jagarasa.png') }}'">
        
        <!-- Category Badge -->
        <div class="absolute top-3 left-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-700/95 text-white shadow-sm backdrop-blur-xs">
                <i class="fa-solid fa-tag text-[10px]"></i>
                {{ $product->category->nama_kategori }}
            </span>
        </div>

        <!-- Stok Badge -->
        <div class="absolute top-3 right-3">
            @if($product->stok > 0)
                <span class="px-2.5 py-1 rounded-full text-[11px] font-medium bg-white/90 text-amber-900 border border-amber-200 shadow-xs">
                    Tersedia {{ $product->stok }} pcs
                </span>
            @else
                <span class="px-2.5 py-1 rounded-full text-[11px] font-medium bg-rose-500 text-white shadow-xs">
                    Stok Habis
                </span>
            @endif
        </div>
    </div>

    <!-- Konten Informasi Produk -->
    <div class="p-5 flex flex-col flex-grow justify-between">
        <div>
            <div class="flex items-center justify-between text-xs text-amber-800/70 mb-1">
                <span>Berat: {{ $product->berat_gram }} gram</span>
                <span class="flex items-center text-amber-500">
                    <i class="fa-solid fa-star text-xs mr-1"></i> 4.9 (Autentik)
                </span>
            </div>

            <h3 class="text-base sm:text-lg font-bold text-amber-950 font-heading line-clamp-2 group-hover:text-amber-600 transition">
                <a href="{{ route('produk.show', $product->slug) }}">
                    {{ $product->nama_produk }}
                </a>
            </h3>

            <p class="text-xs sm:text-sm text-amber-900/75 mt-2 line-clamp-2 leading-relaxed">
                {{ $product->deskripsi }}
            </p>
        </div>

        <div class="mt-5 pt-4 border-t border-amber-100 flex items-center justify-between">
            <div>
                <span class="text-[11px] uppercase tracking-wider text-amber-800/60 block font-medium">Harga</span>
                <span class="text-lg font-extrabold text-amber-600 font-heading">
                    {{ $product->formatted_harga }}
                </span>
            </div>

            <a href="{{ route('produk.show', $product->slug) }}" 
               class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs sm:text-sm font-semibold bg-amber-500 hover:bg-amber-600 text-white shadow-xs transition hover:shadow-md">
                <span>Lihat Detail</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>
</div>
