<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Dashboard ringkasan analitik admin
     */
    public function index(): View
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalStock = Product::sum('stok');

        // Dummy data penjualan bulan ini
        $monthlyRevenue = 18450000; // Rp 18.450.000
        $totalOrders = 342;

        // Data 5 produk terbaru
        $recentProducts = Product::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalStock',
            'monthlyRevenue',
            'totalOrders',
            'recentProducts'
        ));
    }

    /**
     * Halaman Laporan Penjualan (dengan Chart/Grafik & Data Dummy Realistis)
     */
    public function salesReport(): View
    {
        // Data Dummy Tren Omset 6 Bulan Terakhir
        $chartLabels = ['Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November'];
        $chartRevenues = [9800000, 12400000, 14200000, 16800000, 15500000, 18450000];
        $chartOrders = [185, 230, 265, 310, 295, 342];

        // Ringkasan Finansial Dummy
        $totalGrossSales = 87150000;
        $averageOrderValue = 51200;
        $bestSellingProduct = 'Keripik Pisang Kepok Cokelat Lumer (142 pcs)';

        // Tabel Riwayat Transaksi Dummy Terakhir
        $recentSales = [
            [
                'invoice'    => 'INV-20261125-001',
                'pembeli'    => 'Anisa Rahma (Bandar Lampung)',
                'item'       => 'Keripik Pisang Cokelat Lumer (3x), Keripik Keju (2x)',
                'total'      => 140000,
                'metode'     => 'QRIS / Transfer Bank',
                'status'     => 'Selesai',
                'tanggal'    => '25 Nov 2026, 14:32',
            ],
            [
                'invoice'    => 'INV-20261125-002',
                'pembeli'    => 'Budi Santoso (Jakarta Selatan)',
                'item'       => 'Kemplang Panggang Tenggiri (4x), Kopi Robusta (2x)',
                'total'      => 198000,
                'metode'     => 'ShopeePay',
                'status'     => 'Selesai',
                'tanggal'    => '25 Nov 2026, 11:15',
            ],
            [
                'invoice'    => 'INV-20261124-003',
                'pembeli'    => 'Dewi Lestari (Bandung)',
                'item'       => 'Keripik Singkong Balado (5x)',
                'total'      => 100000,
                'metode'     => 'Transfer BCA',
                'status'     => 'Selesai',
                'tanggal'    => '24 Nov 2026, 16:40',
            ],
            [
                'invoice'    => 'INV-20261124-004',
                'pembeli'    => 'Rian Firmansyah (Palembang)',
                'item'       => 'Keripik Pisang Cokelat (2x), Kemplang (2x)',
                'total'      => 120000,
                'metode'     => 'COD / Langsung Toko',
                'status'     => 'Selesai',
                'tanggal'    => '24 Nov 2026, 09:20',
            ],
            [
                'invoice'    => 'INV-20261123-005',
                'pembeli'    => 'Maya Putri (Metro Lampung)',
                'item'       => 'Kopi Robusta Lampung Barat (3x)',
                'total'      => 105000,
                'metode'     => 'QRIS Mandiri',
                'status'     => 'Selesai',
                'tanggal'    => '23 Nov 2026, 18:05',
            ],
        ];

        return view('admin.reports.sales', compact(
            'chartLabels',
            'chartRevenues',
            'chartOrders',
            'totalGrossSales',
            'averageOrderValue',
            'bestSellingProduct',
            'recentSales'
        ));
    }
}
