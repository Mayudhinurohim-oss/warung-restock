<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class CategoryController extends Controller
{
  public function index()
{
    $categories = Category::withCount('products')->get();

    $totalProduk = Product::count();

    return view('categories.index', compact(
        'categories',
        'totalProduk'
    ));
}

    public function create()
    {
        return view('categories.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|max:100',
        'deskripsi' => 'nullable',
    ]);

    Category::create([
        'nama' => $request->nama,
        'deskripsi' => $request->deskripsi,
    ]);

    return redirect()->route('categories.index')
        ->with('success', 'Kategori berhasil ditambahkan.');
}
    public function show(Category $category)
    {
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
{
    $request->validate([
        'nama' => 'required|max:100',
        'deskripsi' => 'nullable',
    ]);

    $category->update([
        'nama' => $request->nama,
        'deskripsi' => $request->deskripsi,
    ]);

    return redirect()->route('categories.index')
        ->with('success', 'Kategori berhasil diubah.');
}

   
}