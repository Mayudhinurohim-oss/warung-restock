@extends('layouts.admin')

@section('content')

<div class="product-header">

    <div class="product-header-left">

        <div class="product-icon">
            <i class="bi bi-box-arrow-in-down"></i>
        </div>

        <div>
            <h1 class="product-title">Tambah Barang Masuk</h1>
            <p class="product-subtitle">
                Tambahkan transaksi barang masuk ke dalam stok.
            </p>
        </div>

    </div>

    <a href="{{ route('barang-masuk.index') }}" class="btn-add-product">
        <i class="bi bi-arrow-left-circle-fill me-2"></i>
        Kembali
    </a>

</div>

<div class="dashboard-card mt-4">

    <div class="card-header">

        <i class="bi bi-pencil-square me-2"></i>

        Form Barang Masuk

    </div>

    <div class="card-body">

        <form action="{{ route('barang-masuk.store') }}" method="POST">

            @csrf

            <div class="row">

                <!-- Produk -->
                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Produk
                    </label>

                    <select
                        name="product_id"
                        class="form-select @error('product_id') is-invalid @enderror">

                        <option value="">
                            -- Pilih Produk --
                        </option>

                        @foreach($products as $product)

                            <option
                                value="{{ $product->id }}"
                                {{ old('product_id') == $product->id ? 'selected' : '' }}>

                                {{ $product->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('product_id')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

                <!-- Jumlah -->
                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Jumlah
                    </label>

                    <input
                        type="number"
                        min="1"
                        name="jumlah"
                        value="{{ old('jumlah') }}"
                        class="form-control @error('jumlah') is-invalid @enderror">

                    @error('jumlah')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

                <!-- Tanggal -->
                <div class="col-md-6 mb-4">

                    <label class="form-label">

                        Tanggal

                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        value="{{ old('tanggal', date('Y-m-d')) }}"
                        class="form-control @error('tanggal') is-invalid @enderror">

                    @error('tanggal')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

                <!-- Keterangan -->
                <div class="col-md-6 mb-4">

                    <label class="form-label">

                        Keterangan

                    </label>

                    <input
                        type="text"
                        name="keterangan"
                        value="{{ old('keterangan') }}"
                        class="form-control">

                </div>

            </div>

            <hr class="border-secondary">

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="{{ route('barang-masuk.index') }}"
                    class="btn btn-secondary">

                    <i class="bi bi-x-circle me-2"></i>

                    Batal

                </a>

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="bi bi-check-circle me-2"></i>

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection