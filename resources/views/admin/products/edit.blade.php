@extends('layouts.admin')

@section('title', 'Edit Produk - Admin Jagarasa')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-slate-800 font-heading">Edit Produk</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Perbarui data atau ganti foto produk oleh-oleh Jagarasa.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-xs sm:text-sm text-slate-500 hover:text-slate-800 flex items-center gap-1.5 font-semibold">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Tabel</span>
        </a>
    </div>

    <!-- Form Box -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs p-6 sm:p-8">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Produk -->
            <div>
                <label for="nama_produk" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Nama Produk <span class="text-rose-500">*</span>
                </label>
                <input type="text" 
                       id="nama_produk" 
                       name="nama_produk" 
                       value="{{ old('nama_produk', $product->nama_produk) }}" 
                       class="w-full px-4 py-3 rounded-xl border {{ $errors->has('nama_produk') ? 'border-rose-400 bg-rose-50/30' : 'border-slate-300' }} focus:outline-hidden focus:ring-2 focus:ring-amber-500 text-sm"
                       required>
                @error('nama_produk')
                    <p class="text-xs text-rose-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori & Harga Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Kategori -->
                <div>
                    <label for="category_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Kategori Oleh-Oleh <span class="text-rose-500">*</span>
                    </label>
                    <select id="category_id" 
                            name="category_id" 
                            class="w-full px-4 py-3 rounded-xl border {{ $errors->has('category_id') ? 'border-rose-400 bg-rose-50/30' : 'border-slate-300' }} focus:outline-hidden focus:ring-2 focus:ring-amber-500 text-sm bg-white"
                            required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-xs text-rose-500 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga -->
                <div>
                    <label for="harga" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Harga Satuan (Rupiah) <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 text-sm font-semibold">Rp</span>
                        <input type="number" 
                               id="harga" 
                               name="harga" 
                               value="{{ old('harga', $product->harga) }}" 
                               min="1000"
                               class="w-full pl-11 pr-4 py-3 rounded-xl border {{ $errors->has('harga') ? 'border-rose-400 bg-rose-50/30' : 'border-slate-300' }} focus:outline-hidden focus:ring-2 focus:ring-amber-500 text-sm"
                               required>
                    </div>
                    @error('harga')
                        <p class="text-xs text-rose-500 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Stok & Berat Gram Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Stok -->
                <div>
                    <label for="stok" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Ketersediaan Stok (Pcs) <span class="text-rose-500">*</span>
                    </label>
                    <input type="number" 
                           id="stok" 
                           name="stok" 
                           value="{{ old('stok', $product->stok) }}" 
                           min="0"
                           class="w-full px-4 py-3 rounded-xl border {{ $errors->has('stok') ? 'border-rose-400 bg-rose-50/30' : 'border-slate-300' }} focus:outline-hidden focus:ring-2 focus:ring-amber-500 text-sm"
                           required>
                    @error('stok')
                        <p class="text-xs text-rose-500 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Berat Gram -->
                <div>
                    <label for="berat_gram" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Berat Bersih (Gram) <span class="text-rose-500">*</span>
                    </label>
                    <input type="number" 
                           id="berat_gram" 
                           name="berat_gram" 
                           value="{{ old('berat_gram', $product->berat_gram) }}" 
                           min="10"
                           class="w-full px-4 py-3 rounded-xl border {{ $errors->has('berat_gram') ? 'border-rose-400 bg-rose-50/30' : 'border-slate-300' }} focus:outline-hidden focus:ring-2 focus:ring-amber-500 text-sm"
                           required>
                    @error('berat_gram')
                        <p class="text-xs text-rose-500 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="deskripsi" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Deskripsi Produk & Rasa <span class="text-rose-500">*</span>
                </label>
                <textarea id="deskripsi" 
                          name="deskripsi" 
                          rows="4" 
                          class="w-full px-4 py-3 rounded-xl border {{ $errors->has('deskripsi') ? 'border-rose-400 bg-rose-50/30' : 'border-slate-300' }} focus:outline-hidden focus:ring-2 focus:ring-amber-500 text-sm"
                          required>{{ old('deskripsi', $product->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-xs text-rose-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Gambar Produk (Optional di Edit) -->
            <div>
                <label for="gambar" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Foto Produk (Kosongkan jika tidak diubah)
                </label>
                <div class="mt-2 flex items-center gap-6">
                    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl border border-slate-300 overflow-hidden relative bg-slate-50">
                        <img id="image-preview" 
                             src="{{ $product->gambar_url }}" 
                             alt="Current Photo" 
                             class="w-full h-full object-cover">
                    </div>

                    <div class="flex-1">
                        <input type="file" 
                               id="gambar" 
                               name="gambar" 
                               accept="image/jpeg,image/png,image/jpg,image/webp"
                               class="block w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-100 file:text-amber-800 hover:file:bg-amber-200 cursor-pointer"
                               onchange="previewImage(event)">
                        <p class="text-[11px] text-slate-400 mt-2">
                            Pilih gambar baru untuk mengganti file lama di storage. Format JPG/PNG/WEBP, maksimal 2MB.
                        </p>
                    </div>
                </div>
                @error('gambar')
                    <p class="text-xs text-rose-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-50 font-semibold text-xs sm:text-sm">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs sm:text-sm shadow-sm transition hover:shadow-md flex items-center gap-2">
                    <i class="fa-solid fa-arrows-rotate"></i>
                    <span>Perbarui Produk</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
