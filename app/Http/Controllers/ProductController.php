<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
{
    $query = Product::with(['category', 'supplier'])
        ->orderBy('category_id')
        ->orderBy('name');

    if ($request->filled('supplier')) {
        $query->where('supplier_id', $request->supplier);
    }

    $products = $query->get();

    $categories = Category::with([
        'products' => function ($query) {
            $query->latest();
        }
    ])->withCount('products')->get();

    $supplier = null;

    if ($request->filled('supplier')) {
        $supplier = Supplier::find($request->supplier);
    }

    return view('products.index', compact(
        'products',
        'categories',
        'supplier'
    ));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $categories = Category::all();
$suppliers = Supplier::all();

return view('products.create', compact('categories', 'suppliers'));
}

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)
{
    $request->validate([
        'category_id' => 'required',
        'supplier_id' => 'nullable|exists:suppliers,id',
        'name'        => 'required',
        'stock'       => 'required|numeric',
        'unit'        => 'required',
        'price'       => 'required|numeric',
        'min_stock'   => 'required|numeric',
        'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $foto = null;

    if ($request->hasFile('foto')) {
        $foto = $request->file('foto')->store('products', 'public');
    }

    Product::create([
        'category_id' => $request->category_id,
        'supplier_id' => $request->supplier_id,
        'name'        => $request->name,
        'stock'       => $request->stock,
        'unit'        => $request->unit,
        'price'       => $request->price,
        'min_stock'   => $request->min_stock,
        'foto'        => $foto,
    ]);

    return redirect()->route('products.index')
        ->with('success', 'Produk berhasil ditambahkan.');
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $product = Product::findOrFail($id);
$categories = Category::all();
$suppliers = Supplier::all();

return view('products.edit', compact(
    'product',
    'categories',
    'suppliers'
));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        'category_id' => 'required',
        'supplier_id' => 'nullable|exists:suppliers,id',
        'name'        => 'required',
        'stock'       => 'required|numeric',
        'unit'        => 'required',
        'price'       => 'required|numeric',
        'min_stock'   => 'required|numeric',
        'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $product = Product::findOrFail($id);

    if ($request->hasFile('foto')) {

        if ($product->foto) {
            Storage::disk('public')->delete($product->foto);
        }

        $foto = $request->file('foto')->store('products', 'public');

        $product->foto = $foto;
    }

    $product->category_id = $request->category_id;
    $product->supplier_id = $request->supplier_id;
    $product->name        = $request->name;
    $product->stock       = $request->stock;
    $product->unit        = $request->unit;
    $product->price       = $request->price;
    $product->min_stock   = $request->min_stock;

    $product->save();

    return redirect()->route('products.index')
        ->with('success', 'Produk berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $product = Product::findOrFail($id);

    if ($product->foto) {
        Storage::disk('public')->delete($product->foto);
    }

    $product->delete();

    return redirect()->route('products.index')
        ->with('success', 'Produk berhasil dihapus.');
}
}
