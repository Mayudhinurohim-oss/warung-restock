@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="fw-bold text-white" style="text-shadow:2px 2px 5px rgba(0,0,0,.7);">
            <i class="bi bi-plus-circle"></i> Tambah Kategori
        </h2>

        <p class="text-white" style="text-shadow:1px 1px 4px rgba(0,0,0,.7);">
            Tambahkan kategori baru untuk mengelompokkan barang.
        </p>
    </div>

    <div class="card border-0 shadow-lg"
        style="background:rgba(255,255,255,.75); backdrop-filter:blur(10px); border-radius:20px;">

        <div class="card-body p-4">

            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Kategori</label>

                    <input type="text"
                        name="nama"
                        class="form-control"
                        placeholder="Masukkan nama kategori"
                        required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Deskripsi</label>

                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="4"
                        placeholder="Masukkan deskripsi"></textarea>
                </div>

                <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>

            </form>

        </div>

    </div>

</div>

@endsection