<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
{
    $products = Product::count();
    $categories = Category::count();
    $suppliers = 0;

    $restockItems = Product::whereColumn('stock', '<=', 'min_stock')->count();

    $latestProducts = Product::with('category')
        ->latest()
        ->take(5)
        ->get();

    $restockProducts = Product::with('category')
        ->whereColumn('stock', '<=', 'min_stock')
        ->latest()
        ->take(5)
        ->get();

    $totalBarangMasuk = BarangMasuk::sum('jumlah');
    $totalBarangKeluar = BarangKeluar::sum('jumlah');

    // Filter Bulan & Tahun
    $bulan = request('bulan', now()->month);
    $tahun = request('tahun', now()->year);

    $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

    $labels = [];
    $chartMasuk = [];
    $chartKeluar = [];

    for ($i = 1; $i <= $jumlahHari; $i++) {

        $labels[] = $i;

        $chartMasuk[] = BarangMasuk::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->whereDay('tanggal', $i)
            ->sum('jumlah');

        $chartKeluar[] = BarangKeluar::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->whereDay('tanggal', $i)
            ->sum('jumlah');
    }

    return view('dashboard', compact(
        'products',
        'categories',
        'suppliers',
        'restockItems',
        'latestProducts',
        'restockProducts',
        'totalBarangMasuk',
        'totalBarangKeluar',
        'labels',
        'chartMasuk',
        'chartKeluar',
        'bulan',
        'tahun'
    ));
}
public function chart()
{
    $bulan = request('bulan', now()->month);
    $tahun = request('tahun', now()->year);

    $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

    $labels = [];
    $chartMasuk = [];
    $chartKeluar = [];

    for ($i = 1; $i <= $jumlahHari; $i++) {

        $labels[] = $i;

        $chartMasuk[] = BarangMasuk::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->whereDay('tanggal', $i)
            ->sum('jumlah');

        $chartKeluar[] = BarangKeluar::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->whereDay('tanggal', $i)
            ->sum('jumlah');
    }

    return response()->json([
        'labels' => $labels,
        'masuk' => $chartMasuk,
        'keluar' => $chartKeluar,
    ]);
}
}