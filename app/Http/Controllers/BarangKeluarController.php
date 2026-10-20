<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Product;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
{
    $barangKeluar = BarangKeluar::with('product')
        ->latest()
        ->get();

    return view('barang-keluar.index', compact('barangKeluar'));
}

public function create()
{
    $products = Product::all();

    return view('barang-keluar.create', compact('products'));
}

public function destroy($id)
{
    $barangKeluar = BarangKeluar::findOrFail($id);

    // Kembalikan stok
    $product = Product::findOrFail($barangKeluar->product_id);
    $product->increment('stock', $barangKeluar->jumlah);

    // Hapus transaksi
    $barangKeluar->delete();

    return redirect()
        ->route('barang-keluar.index')
        ->with('success', 'Data berhasil dihapus.');
}

public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required',
        'jumlah' => 'required|integer|min:1',
        'tanggal' => 'required|date',
        'keterangan' => 'nullable'
    ]);

    $product = Product::findOrFail($request->product_id);

    if ($request->jumlah > $product->stock) {

        return back()
            ->withInput()
            ->with('error', 'Stok tidak mencukupi!');
    }

    BarangKeluar::create([
        'product_id' => $request->product_id,
        'jumlah' => $request->jumlah,
        'tanggal' => $request->tanggal,
        'keterangan' => $request->keterangan,
    ]);

    $product->decrement('stock', $request->jumlah);

    return redirect()
        ->route('barang-keluar.index')
        ->with('success', 'Barang keluar berhasil ditambahkan.');
}
}
