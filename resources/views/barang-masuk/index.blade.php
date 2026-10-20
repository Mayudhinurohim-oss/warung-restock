@extends('layouts.admin')

@section('content')

<div class="product-header">

    <div class="product-header-left">

        <div class="product-icon">
            <i class="bi bi-box-arrow-in-down"></i>
        </div>

        <div>
            <h1 class="product-title">Barang Masuk</h1>
            <p class="product-subtitle">
                Kelola seluruh transaksi barang masuk.
            </p>
        </div>

    </div>

    <a href="{{ route('barang-masuk.create') }}" class="btn-add-product">
        <i class="bi bi-plus-circle-fill me-2"></i>
        Tambah Barang Masuk
    </a>

</div>

<div class="dashboard-card mt-4">

    <div class="card-header d-flex justify-content-between align-items-center">

        <div class="fw-bold text-white">
            <i class="bi bi-box-arrow-in-down me-2"></i>
            Daftar Barang Masuk
        </div>

        <span class="badge bg-primary">
            {{ $barangMasuk->count() }} Transaksi
        </span>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-dark table-hover align-middle mb-0">

                <thead>

                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Supplier</th>
                    <th>Keterangan</th>
                    <th width="90">Aksi</th>
                </tr>

                </thead>

                <tbody>

                @forelse($barangMasuk as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                        </td>

                        <td>

                            <div class="d-flex align-items-center gap-2">

                                @if($item->product->foto)

                                    <img src="{{ asset('storage/'.$item->product->foto) }}"
                                         width="45"
                                         height="45"
                                         class="rounded"
                                         style="object-fit:cover;">

                                @else

                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                         style="width:45px;height:45px;">

                                        <i class="bi bi-image"></i>

                                    </div>

                                @endif

                                <span class="fw-semibold">
                                    {{ $item->product->name }}
                                </span>

                            </div>

                        </td>

                        <td>
                            <span class="badge bg-success">
                                +{{ $item->jumlah }}
                            </span>
                        </td>

                        <td>
                            {{ $item->supplier ?? '-' }}
                        </td>

                        <td>
                            {{ $item->keterangan ?? '-' }}
                        </td>

                        <td>

                            <form action="{{ route('barang-masuk.destroy',$item->id) }}"
                                  method="POST"
                                  class="form-hapus">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center py-5">

                            <i class="bi bi-inbox display-5 text-secondary"></i>

                            <p class="mt-3 text-muted">

                                Belum ada data barang masuk.

                            </p>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@push('scripts')

<script>

document.querySelectorAll('.form-hapus').forEach(function(form){

    form.addEventListener('submit',function(e){

        e.preventDefault();

        Swal.fire({

            title:'Hapus Data?',

            text:'Data barang masuk akan dihapus.',

            icon:'warning',

            showCancelButton:true,

            confirmButtonColor:'#dc3545',

            cancelButtonColor:'#6b7280',

            confirmButtonText:'Ya, Hapus',

            cancelButtonText:'Batal'

        }).then((result)=>{

            if(result.isConfirmed){

                form.submit();

            }

        });

    });

});

</script>

@endpush

@endsection