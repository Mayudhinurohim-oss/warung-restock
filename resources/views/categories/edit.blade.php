@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="fw-bold text-white" style="text-shadow:2px 2px 5px rgba(0,0,0,.7);">
            <i class="bi bi-pencil-square"></i> Edit Kategori
        </h2>

        <p class="text-white" style="text-shadow:1px 1px 4px rgba(0,0,0,.7);">
            Perbarui data kategori.
        </p>
    </div>

    <div class="card border-0 shadow-lg"
style="
background: linear-gradient(135deg,#f8fbff,#eef5ff);
border-radius:20px;
border:1px solid #dbeafe;
">

        <div class="card-body p-4">

            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Kategori</label>

                    <input type="text"
                        name="nama"
                        class="form-control"
                        value="{{ old('nama', $category->nama) }}"
                        required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Deskripsi</label>

                    <textarea
                        name="deskripsi"
                        rows="4"
                        class="form-control">{{ old('deskripsi', $category->deskripsi) }}</textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('categories.index') }}"
                        class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button type="submit"
                        class="btn btn-warning text-white">
                        <i class="bi bi-pencil-square"></i> Update
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection