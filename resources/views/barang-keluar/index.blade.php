@extends('layouts.admin')

@section('content')

<div class="product-header">

    <div class="product-header-left">

        <div class="product-icon">
            <i class="bi bi-box-arrow-up"></i>
        </div>

        <div>

            <h1 class="product-title">
                Barang Keluar
            </h1>

            <p class="product-subtitle">
                Kelola seluruh transaksi barang keluar.
            </p>

        </div>

    </div>

    <a href="{{ route('barang-keluar.create') }}"
       class="btn-add-product">

        <i class="bi bi-plus-circle-fill me-2"></i>

        Tambah Barang Keluar

    </a>

</div>

<div class="dashboard-card mt-4">

    <div class="card-header d-flex justify-content-between align-items-center">

        <div class="fw-bold text-white">

            <i class="bi bi-box-arrow-up me-2"></i>

            Daftar Barang Keluar

        </div>

        <span class="badge bg-primary">

            {{ $barangKeluar->count() }} Transaksi

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
                    <th>Keterangan</th>
                    <th>Aksi</th>

                </tr>

                </thead>

                <tbody>

                @forelse($barangKeluar as $item)

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
                                     style="width:45px;height:45px">

                                    <i class="bi bi-image"></i>

                                </div>

                            @endif

                            {{ $item->product->name }}

                        </div>

                    </td>

                    <td>

                        {{ $item->jumlah }}

                    </td>

                    <td>

                        {{ $item->keterangan ?? '-' }}

                    </td>

                    <td>

                        <form action="{{ route('barang-keluar.destroy',$item->id) }}"
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

                    <td colspan="6" class="text-center py-5">

                        Belum ada transaksi.

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

document.querySelectorAll('.form-hapus').forEach(form=>{

form.addEventListener('submit',function(e){

e.preventDefault();

Swal.fire({

title:'Hapus transaksi?',

text:'Data akan dihapus.',

icon:'warning',

showCancelButton:true,

confirmButtonText:'Ya',

cancelButtonText:'Batal'

}).then((r)=>{

if(r.isConfirmed){

form.submit();

}

});

});

});

</script>

@endpush

@endsection