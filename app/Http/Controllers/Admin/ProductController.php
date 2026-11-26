<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Tampilan daftar tabel manajemen produk admin
     */
    public function index(): View
    {
        $products = Product::with('category')->latest()->paginate(10);
        $totalProducts = Product::count();
        $totalCategories = Category::count();

        return view('admin.products.index', compact('products', 'totalProducts', 'totalCategories'));
    }

    /**
     * Form tambah produk baru
     */
    public function create(): View
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Menyimpan produk baru & upload gambar ke storage
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Upload gambar ke storage/app/public/produk
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('produk', 'public');
            $validated['gambar'] = $path;
        }

        // Generate slug unik
        $baseSlug = Str::slug($validated['nama_produk']);
        $validated['slug'] = $baseSlug . '-' . Str::lower(Str::random(5));

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan ke katalog Jagarasa!');
    }

    /**
     * Form edit produk
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Memperbarui data produk & mengganti file gambar jika ada
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika tersimpan di disk public
            if ($product->gambar && Storage::disk('public')->exists($product->gambar)) {
                Storage::disk('public')->delete($product->gambar);
            }

            $path = $request->file('gambar')->store('produk', 'public');
            $validated['gambar'] = $path;
        }

        // Jika nama berubah, update slug
        if ($product->nama_produk !== $validated['nama_produk']) {
            $baseSlug = Str::slug($validated['nama_produk']);
            $validated['slug'] = $baseSlug . '-' . Str::lower(Str::random(5));
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Data produk berhasil diperbarui!');
    }

    /**
     * Menghapus produk beserta file gambarnya dari storage
     */
    public function destroy(Product $product): RedirectResponse
    {
        // Bersihkan file dari storage
        if ($product->gambar && Storage::disk('public')->exists($product->gambar)) {
            Storage::disk('public')->delete($product->gambar);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus dari sistem!');
    }
}
