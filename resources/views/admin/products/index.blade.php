@extends('layouts.admin')

@section('title', 'Manajemen Produk - Admin Jagarasa')

@section('content')
<div class="space-y-6">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
        <div>
            <h1 class="text-2xl font-black text-slate-800 font-heading">Manajemen Produk</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Kelola katalog oleh-oleh khas Lampung (Tambah, Ubah, Hapus & Upload Gambar).
            </p>
        </div>

        <div>
            <a href="{{ route('admin.products.create') }}" 
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-bold text-sm shadow-sm transition hover:shadow-md">
                <i class="fa-solid fa-plus"></i>
                <span>+ Tambah Produk Baru</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards Summary -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-medium">Total Produk</span>
                <p class="text-2xl font-black text-slate-800 font-heading">{{ $totalProducts }}</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-tags"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-medium">Kategori Aktif</span>
                <p class="text-2xl font-black text-slate-800 font-heading">{{ $totalCategories }}</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-store"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-medium">Status Katalog</span>
                <p class="text-base font-bold text-emerald-600">Online & Siap Jual</p>
            </div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="p-5 border-b border-slate-200 flex items-center justify-between">
            <h2 class="text-base font-bold text-slate-800 font-heading">Daftar Produk Jagarasa</h2>
            <span class="text-xs text-slate-500">Menampilkan {{ $products->count() }} data</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-700 text-xs uppercase font-semibold border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4">Produk</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Harga Satuan</th>
                        <th class="px-6 py-4">Stok & Berat</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($products as $product)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $product->gambar_url }}" 
                                         alt="{{ $product->nama_produk }}" 
                                         class="w-12 h-12 rounded-xl object-cover border border-slate-200 shadow-2xs"
                                         onerror="this.src='{{ asset('images/logo-jagarasa.png') }}'">
                                    <div>
                                        <a href="{{ route('produk.show', $product->slug) }}" target="_blank" class="font-bold text-slate-800 hover:text-amber-600 transition block">
                                            {{ $product->nama_produk }}
                                        </a>
                                        <span class="text-[11px] text-slate-400">Slug: {{ $product->slug }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    {{ $product->category->nama_kategori }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-amber-600">
                                {{ $product->formatted_harga }}
                            </td>
                            <td class="px-6 py-4 text-xs">
                                <div>Stok: <span class="font-bold text-slate-800">{{ $product->stok }} pcs</span></div>
                                <div class="text-slate-400">Berat: {{ $product->berat_gram }}g</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="inline-flex items-center gap-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('admin.products.edit', $product->id) }}" 
                                       class="px-3 py-1.5 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 font-semibold text-xs transition flex items-center gap-1 border border-amber-200">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        <span>Edit</span>
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini? Gambar di storage juga akan dibersihkan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-3 py-1.5 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 font-semibold text-xs transition flex items-center gap-1 border border-rose-200">
                                            <i class="fa-solid fa-trash-can"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                <i class="fa-solid fa-box-open text-3xl mb-2 block"></i>
                                Belum ada data produk di sistem.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="p-4 border-t border-slate-200">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
