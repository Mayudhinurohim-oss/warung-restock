@extends('layouts.admin')

@section('content')

<!-- =======================================================
    PRODUCT HEADER
======================================================= -->

<div class="product-header">

    <div class="product-header-left">

        <div class="product-icon">
            <i class="bi bi-box-seam-fill"></i>
        </div>

        <div>

            <h1 class="product-title">
                Data Produk
            </h1>

            <p class="product-subtitle">
                Kelola seluruh produk warung berdasarkan kategori.
            </p>

        </div>

    </div>

    <a href="{{ route('products.create') }}"
       class="btn-add-product">

        <i class="bi bi-plus-circle-fill me-2"></i>

        Tambah Produk

    </a>

</div>

<!-- =======================================================
    CATEGORY LOOP
======================================================= -->

@foreach($categories as $category)

@if($category->products->count())

<section class="product-category">

    <div class="category-top">

        <div class="category-title">

            @switch($category->nama)

                @case('Makanan')
                    <i class="fa-solid fa-pizza-slice"></i>
                    @break

                @case('Minuman')
                    <i class="fa-solid fa-wine-glass"></i>
                    @break

                @case('Rokok')
                    <i class="fa-solid fa-smoking"></i>
                    @break

                @case('Sembako')
                    <i class="fa-solid fa-basket-shopping"></i>
                    @break

                @default
                    <i class="fa-solid fa-box"></i>

            @endswitch

            <div>

                <h3>

                    {{ $category->nama }}

                </h3>

                <span>

                    Daftar Produk Kategori

                </span>

            </div>

        </div>

        <div class="category-count">

            {{ $category->products_count }}

            <small>Produk</small>

        </div>

    </div>

    <div class="table-responsive">

        <table class="product-table">

            <thead>

                <tr>

                    <th width="60">No</th>

                    <th>Supplier</th>

                    <th>Produk</th>

                    <th>Kategori</th>

                    <th width="90">Stok</th>

                    <th width="110">Satuan</th>

                    <th width="170">Harga</th>

                    <th width="90">Min</th>

                    <th width="120" class="text-center">

                        Aksi

                    </th>

                </tr>

            </thead>

            <tbody>

@foreach($category->products as $product)

<tr>

    <!-- Nomor -->
    <td class="text-center">
        {{ $loop->iteration }}
    </td>

    <!-- Produk -->
    <td>

        <div class="product-info">

            @if($product->foto)

                <img
                    src="{{ asset('storage/'.$product->foto) }}"
                    class="product-image"
                    alt="{{ $product->name }}">

            @else

                <div class="product-image product-image-empty">

                    <i class="bi bi-image"></i>

                </div>

            @endif

            <div class="product-detail">

    <h6 class="mb-0">
        {{ $product->name }}
    </h6>

</div>
        </div>

    </td>

    <!-- Kategori -->
    <td>

        <span class="badge-category">

            {{ $product->category->nama }}

        </span>

    </td>

    <td>

    @if($product->supplier)

        <span class="badge bg-info text-dark">

            {{ $product->supplier->nama_supplier }}

        </span>

    @else

        <span class="text-muted">

            -

        </span>

    @endif

</td>

    <!-- Stok -->
    <td>

        @if($product->stock <= 0)

            <span class="badge-stock badge-stock-danger">

                {{ $product->stock }}

            </span>

        @elseif($product->stock <= $product->min_stock)

            <span class="badge-stock badge-stock-warning">

                {{ $product->stock }}

            </span>

        @else

            <span class="badge-stock badge-stock-success">

                {{ $product->stock }}

            </span>

        @endif

    </td>

    <!-- Satuan -->
    <td>

        {{ $product->unit }}

    </td>

    <!-- Harga -->
    <td>

        <span class="product-price">

            Rp {{ number_format($product->price,0,',','.') }}

        </span>

    </td>

    <!-- Minimal -->
    <td>

        {{ $product->min_stock }}

    </td>

    <!-- Tombol -->
    <td class="text-center">

        <div class="action-group">

            <a href="{{ route('products.edit',$product->id) }}"
               class="btn-action btn-edit">

                <i class="bi bi-pencil-fill"></i>

            </a>

            <form
                action="{{ route('products.destroy',$product->id) }}"
                method="POST"
                class="d-inline form-hapus">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="btn-action btn-delete">

                    <i class="bi bi-trash-fill"></i>

                </button>

            </form>

        </div>

    </td>

</tr>

@endforeach

</tbody>

</table>

</div>

</section>

@endif

@endforeach

@push('scripts')

<script>
document.querySelectorAll('.form-hapus').forEach(function(form){

    form.addEventListener('submit', function(e){

        e.preventDefault();

        Notiflix.Confirm.show(
            'Hapus Produk',
            'Data yang dihapus tidak dapat dikembalikan.',
            'Hapus',
            'Batal',

            function okCb() {
                form.submit();
            },

            function cancelCb() {
                // Tidak melakukan apa-apa
            },

            {
                width: '360px',
                borderRadius: '14px',
                titleColor: '#111827',
                messageColor: '#6B7280',
                okButtonBackground: '#dc3545',
                okButtonColor: '#fff',
                cancelButtonBackground: '#6c757d',
                cancelButtonColor: '#fff',
                cssAnimationStyle: 'fade'
            }
        );

    });

});
</script>

@endpush
@endsection