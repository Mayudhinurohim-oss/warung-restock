@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="fw-bold text-white" style="text-shadow:2px 2px 5px rgba(0,0,0,.7);">
            <i class="bi bi-box-seam"></i> Tambah Produk
        </h2>

        <p class="text-white" style="text-shadow:1px 1px 4px rgba(0,0,0,.7);">
            Tambahkan data produk baru.
        </p>
    </div>

    <div class="card border-0 shadow-lg"
        style="background: rgba(255,255,255,.90); border-radius:20px;">

        <div class="card-body p-4">

            <form method="POST"
                  action="{{ route('products.store') }}"
                  enctype="multipart/form-data">

                @csrf

                <!-- Foto -->
                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Foto Produk
                    </label>

                    <input
                        type="file"
                        name="foto"
                        class="form-control"
                        accept="image/*">

                </div>

                <div class="row">

                    <!-- Nama Produk -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            Nama Produk
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="Masukkan nama produk"
                            value="{{ old('name') }}"
                            required>

                    </div>

                    <!-- Kategori -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            Kategori
                        </label>

                        <select
                            name="category_id"
                            class="form-select"
                            required>

                            <option value="">
                                -- Pilih Kategori --
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>

                                    {{ $category->nama }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Supplier -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            Supplier
                        </label>

                        <select
                            name="supplier_id"
                            class="form-select">

                            <option value="">
                                -- Pilih Supplier --
                            </option>

                            @foreach($suppliers as $supplier)

                                <option
                                    value="{{ $supplier->id }}"
                                    {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>

                                    {{ $supplier->nama_supplier }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Stok -->
                    <div class="col-md-4 mb-3">

                        <label class="form-label fw-bold">
                            Stok
                        </label>

                        <input
                            type="number"
                            name="stock"
                            class="form-control"
                            value="{{ old('stock',0) }}"
                            required>

                    </div>

                    <!-- Satuan -->
                    <div class="col-md-4 mb-3">

                        <label class="form-label fw-bold">
                            Satuan
                        </label>

                        <input
                            type="text"
                            name="unit"
                            class="form-control"
                            placeholder="pcs / dus / botol"
                            value="{{ old('unit') }}"
                            required>

                    </div>

                    <!-- Minimum Stok -->
                    <div class="col-md-4 mb-3">

                        <label class="form-label fw-bold">
                            Minimum Stok
                        </label>

                        <input
                            type="number"
                            name="min_stock"
                            class="form-control"
                            value="{{ old('min_stock',0) }}"
                            required>

                    </div>

                    <!-- Harga