@extends('layouts.admin')

@section('title', 'Laporan Penjualan - Admin JAGARASA')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
        <div>
            <h1 class="text-2xl font-black text-slate-800 font-heading">Laporan & Analitik Penjualan</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Visualisasi grafik tren omset, ringkasan transaksi, dan rincian penjualan camilan Jagarasa.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-50 font-semibold text-xs transition">
                <i class="fa-solid fa-print"></i>
                <span>Cetak Laporan</span>
            </button>
            <button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs transition shadow-xs">
                <i class="fa-solid fa-file-excel"></i>
                <span>Ekspor Excel</span>
            </button>
        </div>
    </div>

    <!-- Ringkasan Finansial Banner -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
            <span class="text-xs font-semibold text-slate-500">Total Akumulasi Omset</span>
            <div class="text-2xl font-black text-amber-600 font-heading mt-1">
                Rp {{ number_format($totalGrossSales, 0, ',', '.') }}
            </div>
            <span class="text-[11px] text-slate-400 mt-1 block">Periode 6 Bulan Terakhir</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
            <span class="text-xs font-semibold text-slate-500">Rata-Rata Nilai Belanja (AOV)</span>
            <div class="text-2xl font-black text-slate-800 font-heading mt-1">
                Rp {{ number_format($averageOrderValue, 0, ',', '.') }}
            </div>
            <span class="text-[11px] text-emerald-600 font-medium mt-1 block">Tinggi pada paket oleh-oleh</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
            <span class="text-xs font-semibold text-slate-500">Produk Terlaris (Best Seller)</span>
            <div class="text-sm font-bold text-slate-800 mt-2 line-clamp-1">
                {{ $bestSellingProduct }}
            </div>
            <span class="text-[11px] text-amber-600 font-semibold mt-1 block">Kategori Keripik Pisang</span>
        </div>
    </div>

    <!-- GRAFIK CHART.JS -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Grafik Bar/Line: Tren Omset 6 Bulan -->
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-base font-bold text-slate-800 font-heading">Grafik Tren Omset Penjualan (Rp)</h2>
                    <p class="text-xs text-slate-400">Pertumbuhan pendapatan Juni - November 2026</p>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 rounded bg-amber-50 text-amber-700 border border-amber-200">
                    Bulan Berjalan: Rp 18.45 Juta
                </span>
            </div>

            <div class="h-72 w-full">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Grafik Donut: Komposisi Kategori Terjual -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs flex flex-col justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-800 font-heading">Komposisi Kategori</h2>
                <p class="text-xs text-slate-400 mb-4">Persentase kontribusi produk</p>
                <div class="h-56 relative flex items-center justify-center">
                    <canvas id="categoryDonutChart"></canvas>
                </div>
            </div>

            <div class="mt-4 pt-4 border-t border-slate-100 grid grid-cols-2 gap-2 text-xs text-slate-600">
                <div class="flex items-center gap-1.5">
                    <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                    <span>Keripik Pisang (52%)</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                    <span>Keripik Singkong (22%)</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="w-3 h-3 rounded-full bg-blue-500"></span>
                    <span>Kemplang (16%)</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                    <span>Kopi Robusta (10%)</span>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL TRANSAKSI DUMMY REALISTIS -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="p-5 border-b border-slate-200 flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-800 font-heading">Rincian Transaksi Penjualan Terbaru</h2>
                <p class="text-xs text-slate-400">Data dummy transaksi pesanan oleh-oleh masuk</p>
            </div>
            <span class="text-xs font-semibold text-slate-500">5 Transaksi Terakhir</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-700 text-xs uppercase font-semibold border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4">No. Invoice & Waktu</th>
                        <th class="px-6 py-4">Nama Pelanggan</th>
                        <th class="px-6 py-4">Detail Produk</th>
                        <th class="px-6 py-4">Metode Bayar</th>
                        <th class="px-6 py-4">Total Belanja</th>
                        <th class="px-6 py-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($recentSales as $sale)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-800 block">{{ $sale['invoice'] }}</span>
                                <span class="text-[11px] text-slate-400">{{ $sale['tanggal'] }}</span>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-800">
                                {{ $sale['pembeli'] }}
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-600 max-w-xs truncate">
                                {{ $sale['item'] }}
                            </td>
                            <td class="px-6 py-4 text-xs">
                                <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-700 border border-slate-200">
                                    {{ $sale['metode'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-amber-600">
                                Rp {{ number_format($sale['total'], 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <i class="fa-solid fa-circle-check text-[10px]"></i>
                                    {{ $sale['status'] }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Line & Bar Chart Penjualan
        const ctxSales = document.getElementById('salesChart').getContext('2d');
        new Chart(ctxSales, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [
                    {
                        type: 'line',
                        label: 'Omset Penjualan (Rp)',
                        data: @json($chartRevenues),
                        borderColor: '#D97706',
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                        borderWidth: 3,
                        tension: 0.35,
                        fill: true,
                        yAxisID: 'y'
                    },
                    {
                        type: 'bar',
                        label: 'Jumlah Pesanan (Pcs)',
                        data: @json($chartOrders),
                        backgroundColor: 'rgba(21, 128, 61, 0.6)',
                        borderRadius: 8,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + (value / 1000000) + ' Jt';
                            }
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        grid: {
                            drawOnChartArea: false
                        }
                    }
                }
            }
        });

        // Donut Chart Kategori
        const ctxCategory = document.getElementById('categoryDonutChart').getContext('2d');
        new Chart(ctxCategory, {
            type: 'doughnut',
            data: {
                labels: ['Keripik Pisang', 'Keripik Singkong', 'Kemplang', 'Kopi Robusta'],
                datasets: [{
                    data: [52, 22, 16, 10],
                    backgroundColor: ['#F59E0B', '#10B981', '#3B82F6', '#F43F5E'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endpush
