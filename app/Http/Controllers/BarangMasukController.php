<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Product;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
{
    $barangMasuk = BarangMasuk::with('product')
        ->latest()
        ->get();

    return view('barang-masuk.index', compact('barangMasuk'));
}

public function create()
{
    $products = Product::all();

    return view('barang-masuk.create', compact('products'));
}

public function destroy($id)
{
    $barangMasuk = BarangMasuk::findOrFail($id);

    // Kurangi stok produk
    $product = Product::findOrFail($barangMasuk->product_id);

    $product->decrement('stock', $barangMasuk->jumlah);

    // Hapus transaksi
    $barangMasuk->delete();

    return redirect()
        ->route('barang-masuk.index')
        ->with('success', 'Data barang masuk berhasil dihapus.');
}

public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required',
        'jumlah' => 'required|integer|min:1',
        'tanggal' => 'required|date',
        'keterangan' => 'nullable'
    ]);

    BarangMasuk::create([
        'product_id' => $request->product_id,
        'jumlah' => $request->jumlah,
        'tanggal' => $request->tanggal,
        'keterangan' => $request->keterangan,
    ]);

    $product = Product::findOrFail($request->product_id);

    $product->increment('stock', $request->jumlah);

    return redirect()
        ->route('barang-masuk.index')
        ->with('success', 'Barang masuk berhasil ditambahkan.');
}

}

