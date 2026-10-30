@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="fw-bold text-white" style="text-shadow:2px 2px 5px rgba(0,0,0,.7);">
            <i class="bi bi-truck"></i> Tambah Suppliers
        </h2>

        <p class="text-white" style="text-shadow:1px 1px 4px rgba(0,0,0,.7);">
            Tambahkan data suppliers baru.
        </p>
    </div>

    <div class="card border-0 shadow-lg"
         style="background:rgba(255,255,255,.90);border-radius:20px;">

        <div class="card-body p-4">

            <form action="{{ route('suppliers.store') }}" method="POST">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            Nama Suppliers
                        </label>

                        <input
                            type="text"
                            name="nama_supplier"
                            class="form-control"
                            placeholder="Masukkan nama supplier"
                            value="{{ old('nama_supplier') }}"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            Kontak
                        </label>

                        <input
                            type="text"
                            name="kontak"
                            class="form-control"
                            placeholder="081234567890"
                            value="{{ old('kontak') }}"
                            required>

                    </div>

                    <div class="col-12 mb-4">

                        <label class="form-label fw-bold">
                            Alamat
                        </label>

                        <textarea
                            name="alamat"
                            class="form-control"
                            rows="4"
                            placeholder="Masukkan alamat supplier"
                            required>{{ old('alamat') }}</textarea>

                    </div>

                </div>

                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('suppliers.index') }}"
                       class="btn btn-secondary">

                        <i class="bi bi-arrow-left"></i>
                        Kembali

                    </a>

                    <button
                        type="submit"
                        class="btn btn-success">

                        <i class="bi bi-check-circle"></i>
                        Simpan Suppliers

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection