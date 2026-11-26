<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Menampilkan beranda (profil UMKM, filter kategori, dan katalog produk)
     */
    public function index(Request $request): View
    {
        $categories = Category::withCount('products')->get();

        $selectedCategory = $request->query('kategori');

        $productsQuery = Product::with('category')->latest();

        if ($selectedCategory && $selectedCategory !== 'semua') {
            $productsQuery->whereHas('category', function ($q) use ($selectedCategory) {
                $q->where('slug', $selectedCategory);
            });
        }

        $products = $productsQuery->get();

        return view('home.index', compact('categories', 'products', 'selectedCategory'));
    }

    /**
     * Menampilkan halaman detail per produk
     */
    public function show(string $slug): View
    {
        $product = Product::with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        // Rekomendasi produk serupa dari kategori yang sama
        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();

        return view('home.show', compact('product', 'relatedProducts'));
    }
}
