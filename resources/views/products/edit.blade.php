@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="fw-bold text-white" style="text-shadow:2px 2px 5px rgba(0,0,0,.7);">
            <i class="bi bi-pencil-square"></i> Edit Produk
        </h2>

        <p class="text-white" style="text-shadow:1px 1px 4px rgba(0,0,0,.7);">
            Ubah data produk.
        </p>
    </div>

    <div class="card border-0 shadow-lg"
        style="background: rgba(255,255,255,.90); border-radius:20px;">

        <div class="card-body p-4">

            <form method="POST"
                  action="{{ route('products.update',$product->id) }}"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <!-- Foto -->
                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Foto Produk
                    </label>

                    @if($product->foto)

                        <div class="mb-3">

                            <img id="preview"
                                 src="{{ asset('storage/'.$product->foto) }}"
                                 width="120"
                                 height="120"
                                 class="rounded shadow"
                                 style="object-fit:cover;">

                        </div>

                    @else

                        <img id="preview"
                             width="120"
                             height="120"
                             class="rounded shadow d-none"
                             style="object-fit:cover;">

                    @endif

                    <input
                        type="file"
                        name="foto"
                        class="form-control"
                        accept="image/*"
                        onchange="previewFoto(event)">

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
                            value="{{ old('name',$product->name) }}"
                            placeholder="Masukkan nama produk"
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
                                    {{ old('category_id',$product->category_id) == $category->id ? 'selected' : '' }}>

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
                                    {{ old('supplier_id',$product->supplier_id) == $supplier->id ? 'selected' : '' }}>

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
                            value="{{ old('stock',$product->stock) }}"
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
                            value="{{ old('unit',$product->unit) }}"
                            placeholder="pcs / dus / botol"
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
                            value="{{ old('min_stock',$product->min_stock) }}"
                            required>

                    </div>

                    <!-- Harga -->
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-bold">
                            Harga
                        </label>

                        <input
                            type="number"
                            name="price"
                            class="form-control"
                            value="{{ old('price',$product->price) }}"
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

                        <i class="bi bi-save"></i>
                        Update Produk

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@push('scripts')
<script>
function previewFoto(event){

    const preview = document.getElementById('preview');

    preview.src = URL.createObjectURL(event.target.files[0]);

    preview.classList.remove('d-none');

}
</script>
@endpush

@endsection