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
        style="
        background: rgba(255,255,255,.90);
        border-radius:20px;
        ">

        <div class="card-body p-4">

            <form method="POST"
      action="{{ route('products.store') }}"
      enctype="multipart/form-data">

                @csrf

                <div class="mb-3">

    <label class="form-label">
        Foto Produk
    </label>

    <input
        type="file"
        name="foto"
        class="form-control"
        accept="image/*">

</div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            Nama Produk
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="Masukkan nama produk"
                            required>
                    </div>

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

                                <option value="{{ $category->id }}">
                                    {{ $category->nama }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">
                            Stok
                        </label>

                        <input
                            type="number"
                            name="stock"
                            class="form-control"
                            value="0"
                            required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">
                            Satuan
                        </label>

                        <input
                            type="text"
                            name="unit"
                            class="form-control"
                            placeholder="pcs / dus / botol"
                            required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">
                            Minimum Stok
                        </label>

                        <input
                            type="number"
                            name="min_stock"
                            class="form-control"
                            value="0"
                            required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold">
                            Harga
                        </label>

                        <input
                            type="number"
                            name="price"
                            class="form-control"
                            placeholder="Contoh: 3500"
                            required>
                    </div>

                </div>

                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('products.index') }}"
                        class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-check-circle"></i>
                        Simpan Product

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection