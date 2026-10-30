@extends('layouts.admin')

@section('content')

<div class="product-header">

    <div class="product-header-left">

        <div class="product-icon">
            <i class="bi bi-truck"></i>
        </div>

        <div>

            <h1 class="product-title">
                Data Supplier
            </h1>

            <p class="product-subtitle">
                Kelola seluruh supplier yang bekerja sama dengan warung.
            </p>

        </div>

    </div>

    <a href="{{ route('suppliers.create') }}"
       class="btn-add-product">

        <i class="bi bi-plus-circle-fill me-2"></i>
        Tambah Supplier

    </a>

</div>

<section class="product-category">

    <div class="category-top">

        <div class="category-title">

            <i class="bi bi-truck"></i>

            <div>

                <h3>Daftar Supplier</h3>

                <span>Supplier Aktif</span>

            </div>

        </div>

        <div class="category-count">

            {{ $suppliers->count() }}

            <small>Supplier</small>

        </div>

    </div>

    <div class="table-responsive">

        <table class="product-table">

            <thead>

                <tr>

                    <th width="60">No</th>
                    <th>Nama Supplier</th>
                    <th>Kontak</th>
                    <th>Alamat</th>
                    <th width="120">Produk</th>
                    <th width="120" class="text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($suppliers as $supplier)

                <tr>

                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td>

                        <a href="{{ route('products.index',['supplier'=>$supplier->id]) }}"
                           class="fw-semibold text-decoration-none text-primary">

                            {{ $supplier->nama_supplier }}

                        </a>

                    </td>

                    <td>

                        {{ $supplier->kontak }}

                    </td>

                    <td>

                        {{ $supplier->alamat }}

                    </td>

                    <td>

                        <span class="badge-category">

                            {{ $supplier->products_count }} Produk

                        </span>

                    </td>

                    <td class="text-center">

                        <div class="action-group">

                            <a href="{{ route('suppliers.edit',$supplier->id) }}"
                               class="btn-action btn-edit">

                                <i class="bi bi-pencil-fill"></i>

                            </a>

                            <form action="{{ route('suppliers.destroy',$supplier->id) }}"
                                  method="POST"
                                  class="d-inline form-hapus">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn-action btn-delete">

                                    <i class="bi bi-trash-fill"></i>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center py-5">

                        <i class="bi bi-truck display-5 text-secondary"></i>

                        <p class="mt-3 mb-0">
                            Belum ada data suppliers.
                        </p>

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</section>

@push('scripts')

<script>

document.querySelectorAll('.form-hapus').forEach(function(form){

    form.addEventListener('submit',function(e){

        e.preventDefault();

        Notiflix.Confirm.show(

            'Hapus Supplier',

            'Supplier yang dihapus tidak dapat dikembalikan.',

            'Hapus',

            'Batal',

            function(){

                form.submit();

            },

            function(){},

            {

                width:'360px',

                borderRadius:'14px',

                titleColor:'#111827',

                messageColor:'#6B7280',

                okButtonBackground:'#dc3545',

                cancelButtonBackground:'#6c757d',

                cssAnimationStyle:'fade'

            }

        );

    });

});

</script>

@endpush

@endsection