@extends('layouts.admin')

@section('content')


<div class="dashboard-header">

    <div class="row align-items-center">

        <div class="col-lg-8">

            <h2 class="dashboard-title">
                <i class="bi bi-shop me-2"></i>
                Dashboard Admin
            </h2>

            <p class="dashboard-subtitle">
                Selamat datang kembali,
                <strong>{{ Auth::user()->name }}</strong>!
            </p>

        </div>

        <div class="col-lg-4 text-end">

            <div class="dashboard-date">

                <i class="bi bi-calendar3"></i>

                {{ now()->translatedFormat('d F Y') }}

            </div>

        </div>

    </div>

</div>

<div class="row g-4">

    <!-- Total Produk -->
    <div class="col-lg-3 col-md-6">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <div class="stat-title">Total Produk</div>
                        <div class="stat-value">{{ $products }}</div>
                        <div class="stat-desc">Semua Produk</div>
                        <div class="stat-growth">
                           
                        </div>
                    </div>

                    <div class="stat-icon icon-blue">
                        <i class="bi bi-box-seam"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Total Kategori -->
    <div class="col-lg-3 col-md-6">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <div class="stat-title">Total Kategori</div>
                        <div class="stat-value">{{ $categories }}</div>
                        <div class="stat-desc">Semua Kategori</div>
                        <div class="stat-growth">
                         
                        </div>
                    </div>

                    <div class="stat-icon icon-green">
                        <i class="bi bi-tags"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Supplier -->
    <div class="col-lg-3 col-md-6">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <div class="stat-title">Supplier</div>
                        <div class="stat-value">{{ $suppliers }}</div>
                        <div class="stat-desc">Supplier Aktif</div>
                        <div class="stat-growth">
                         
                        </div>
                    </div>

                    <div class="stat-icon icon-purple">
                        <i class="bi bi-truck"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Restock -->
    <div class="col-lg-3 col-md-6">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <div class="stat-title">Perlu Restock</div>
                        <div class="stat-value">{{ $restockItems }}</div>
                        <div class="stat-desc">Barang Menipis</div>
                        <div class="stat-danger">
                            <i class="bi bi-exclamation-circle"></i> Prioritas
                        </div>
                    </div>

                    <div class="stat-icon icon-red">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>


<div class="row g-4 mt-4">

    <!-- Quick Action -->
<div class="col-lg-4">

    <div class="card dashboard-card h-100" id="grafikTransaksi">

        <div class="card-header">
            <i class="bi bi-lightning-charge-fill text-warning me-2"></i>
            Quick Action
        </div>

        <div class="card-body">

            <div class="d-grid gap-3">

                <!-- Tambah Produk -->
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>
                    Tambah Produk
                </a>

                <!-- Barang Masuk -->
                <a href="{{ route('barang-masuk.create') }}" class="btn btn-info text-white">
                    <i class="bi bi-box-arrow-in-down me-2"></i>
                    Barang Masuk
                </a>

                <!-- Barang Keluar -->
                <a href="{{ route('barang-keluar.create') }}" class="btn btn-danger">
                    <i class="bi bi-box-arrow-up me-2"></i>
                    Barang Keluar
                </a>

                <!-- Kategori -->
                <a href="{{ route('categories.index') }}" class="btn btn-success">
                    <i class="bi bi-tags me-2"></i>
                    Kategori
                </a>

            </div>

        </div>

    </div>

</div>

    <!-- Produk Terbaru -->
    <div class="col-lg-8">

        <div class="card dashboard-card h-100">

            <div class="card-header d-flex justify-content-between align-items-center">

                <span>
                    <i class="bi bi-box-seam me-2 text-primary"></i>
                    Produk Terbaru
                </span>

                <a href="{{ route('products.index') }}" class="lihat-semua">
    Lihat Semua
</a>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th>Produk</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga</th>
                            </tr>
                        </thead>

                        <tbody>

                        @forelse($latestProducts as $product)

                            <tr>

                                <td>

    <div class="d-flex align-items-center gap-2">

        @if($product->foto)

            <img src="{{ asset('storage/'.$product->foto) }}"
                 width="32"
                 height="32"
                 class="rounded"
                 style="object-fit:cover;">

        @endif

        <span>{{ $product->name }}</span>

    </div>

</td>

                                <td>
                                    <span class="badge bg-primary">
                                        {{ $product->category->nama }}
                                    </span>
                                </td>

                                <td>

                                    @if($product->stock <= $product->min_stock)

                                        <span class="badge bg-danger">
                                            {{ $product->stock }}
                                        </span>

                                    @else

                                        <span class="badge bg-success">
                                            {{ $product->stock }}
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    Rp {{ number_format($product->price,0,',','.') }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    Belum ada produk.
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="row g-4 mt-4">

    <!-- Grafik -->
    <div class="col-lg-8">

        <div class="card dashboard-card h-100">

            <div class="card-header d-flex justify-content-between align-items-center">

                <span>
                    <i class="bi bi-bar-chart-line-fill text-primary me-2"></i>
                    Grafik Transaksi
                </span>

                <select id="bulanFilter" class="chart-select">

        <option value="">Semua Bulan</option>

        @foreach([
            1=>'Januari',
            2=>'Februari',
            3=>'Maret',
            4=>'April',
            5=>'Mei',
            6=>'Juni',
            7=>'Juli',
            8=>'Agustus',
            9=>'September',
            10=>'Oktober',
            11=>'November',
            12=>'Desember'
        ] as $key => $nama)

            <option value="{{ $key }}"
                {{ request('bulan') == $key ? 'selected' : '' }}>

                {{ $nama }}

            </option>

        @endforeach

    </select>


            </div>

            <div class="card-body">

               <div style="height:420px;">
                    <canvas id="chartTransaksi"></canvas>
                </div>

            </div>

        </div>

    </div>

    <!-- Restock -->
<div class="col-lg-4">

    <div class="card dashboard-card h-100">

    <div class="card-header d-flex justify-content-between align-items-center">

        <span>
            <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>
            Barang Restock
        </span>

        <a href="{{ route('products.index') }}" class="lihat-semua">
    Lihat Semua
</a>

    </div>

    <div class="table-responsive">

        <table class="table table-dark align-middle mb-0">

            <thead>

                <tr>
                    <th>Produk</th>
                    <th>Stok</th>
                    <th>Minimal</th>
                    <th>Saran Restock</th>
                </tr>

            </thead>

            <tbody>

            @forelse($restockProducts as $product)

                <tr>

                    <td>

                      <div class="d-flex align-items-center gap-2">

    @if($product->foto)

        <img src="{{ asset('storage/'.$product->foto) }}"
             width="32"
             height="32"
             class="rounded"
             style="object-fit: cover;">

    @else

        <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
             style="width:32px;height:32px;">
            <i class="bi bi-image text-white"></i>
        </div>

    @endif

    <span>{{ $product->name }}</span>

</div>

                    </td>

                    <td>

                        <span class="text-danger fw-bold">
                            {{ $product->stock }}
                        </span>

                    </td>

                    <td>

                        {{ $product->min_stock }}

                    </td>

                    <td>

                        {{ max($product->min_stock * 2, $product->min_stock - $product->stock + 10) }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4" class="text-center py-4">

                        Tidak ada barang yang perlu direstock.

                    </td>

                </tr>

            @endforelse

            </tbody>

               </table>

    </div>

</div>

</div>


<div class="row g-4 mt-4">

    <div class="col-lg-6">

        <div class="card dashboard-card h-100">

            <div class="card-header">
                <i class="bi bi-info-circle-fill text-primary me-2"></i>
                Informasi Sistem
            </div>

            <div class="card-body">

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span>Nama User</span>
                    <strong>{{ Auth::user()->name }}</strong>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span>Role</span>
                    <strong>Admin</strong>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span>Total Barang</span>
                    <strong>{{ $products }}</strong>
                </div>

                <div class="d-flex justify-content-between py-2">
                    <span>Total Kategori</span>
                    <strong>{{ $categories }}</strong>
                </div>

            </div>

        </div>

    </div>


            <div class="card-body text-center py-5">

                <i class="bi bi-check-circle-fill text-success display-4"></i>

                <h5 class="mt-3">
                    Dashboard Siap Digunakan
                </h5>

                <p class="text-muted mb-0">
                    Seluruh menu siap digunakan untuk mengelola data warung.
                </p>

            </div>

        </div>

    </div>

</div>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {

    const canvas = document.getElementById('chartTransaksi');

    if (!canvas) {
        console.log("Canvas tidak ditemukan");
        return;
    }

    const ctx = canvas.getContext('2d');

    console.log(@json($chartMasuk));
    console.log(@json($chartKeluar));

    new Chart(ctx,{
        type:'line',
        data:{
            labels:@json($labels),
            datasets:[
                {
                    label:'Barang Masuk',
                    data:@json($chartMasuk),
                },
                {
                    label:'Barang Keluar',
                    data:@json($chartKeluar),
                }
            ]
        }
    });

document.getElementById('bulanFilter').addEventListener('change', function () {

    let bulan = this.value;

    if (bulan === "") {
        window.location.href = "/dashboard";
    } else {
        window.location.href = "/dashboard?bulan=" + bulan;
    }

});

});
</script>
@endpush
@endsection