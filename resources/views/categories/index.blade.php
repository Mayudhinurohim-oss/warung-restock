@extends('layouts.admin')

@section('content')

<style>

/* ==========================================
   CATEGORY HEADER
========================================== */

.category-list-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:22px 28px;
    background:#202938;
    border-bottom:1px solid rgba(255,255,255,.05);
}

.category-list-header h4{
    color:#fff;
    font-weight:700;
}

.category-list-header small{
    color:#9ca3af;
}

/* ==========================================
   CATEGORY CARD
========================================== */

.list-card{
    margin-top:10px;
    background:#161b22;
    border:1px solid rgba(255,255,255,.08);
    border-radius:20px;
    overflow:hidden;
    transition:.3s;
}

.list-card:hover{
    box-shadow:
        0 0 1px rgba(37,99,235,.35),
        0 0 20px rgba(37,99,235,.15);
}

/* ==========================================
   TABLE
========================================== */

.category-table{
    margin:0;
    border-collapse:separate;
    border-spacing:0;
    color:#fff;
    background:#161b22;
}

.category-table>:not(caption)>*>*{
    background:#161b22;
    color:#fff;
}

.category-table thead th:first-child{
    border-top-left-radius:20px;
}

.category-table thead th:last-child{
    border-top-right-radius:20px;
}

.category-table thead th{
    background:#202938 !important;
    color:#cbd5e1 !important;
    padding:18px;
    border:none;
    font-weight:600;
}

.category-table tbody td{
    background:#161b22 !important;
    color:#fff !important;
    padding:18px;
    vertical-align:middle;
    border-top:1px solid rgba(255,255,255,.05);
    border-bottom:1px solid rgba(255,255,255,.05);
}

.category-table tbody tr{
    transition:.3s;
}

.category-table tbody tr:hover td{
    background:#1f2937 !important;
}

/* ==========================================
   CATEGORY ICON
========================================== */

.category-icon{
    width:52px;
    height:52px;
    border-radius:16px;
    overflow:hidden;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#2563eb20;
    transition:.3s;
}

.category-icon img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.category-table tbody tr:hover .category-icon{
    transform:scale(1.1);
}

/* ==========================================
   TEXT
========================================== */

.category-name{
    color:#fff;
    font-weight:700;
}

.category-page{
    color:#fff;
}

/* ==========================================
   EMPTY STATE
========================================== */

.empty-category{
    padding:40px;
    text-align:center;
}

.empty-category i{
    font-size:42px;
    color:#b7c0d0;
}

</style>

<div class="dashboard-header">

    <div class="row align-items-center">

        <div class="col-lg-8">

            <h2 class="dashboard-title">
                <i class="fa-solid fa-tags me-2"></i>
                Data Kategori
            </h2>

            <p class="dashboard-subtitle">
                Kelola kategori barang yang tersedia di warung.
            </p>

        </div>

    </div>

</div>

<div class="row g-4 mb-4">

    <!-- Total Kategori -->
    <div class="col-lg-6 col-md-6">

        <div class="card stat-card h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-title">
                            Total Kategori
                        </div>

                        <div class="stat-value">
                            {{ $categories->count() }}
                        </div>

                        <div class="stat-desc">
                            Kategori Terdaftar
                        </div>

                        <div class="stat-growth">
                            <i class="bi bi-check-circle"></i>
                            Aktif
                        </div>

                    </div>

                    <div class="stat-icon icon-blue">
                        <i class="fa-solid fa-tags"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Total Barang -->
    <div class="col-lg-6 col-md-6">

        <div class="card stat-card h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-title">
                            Total Barang
                        </div>

                        <div class="stat-value">
                            {{ $totalProduk }}
                        </div>

                        <div class="stat-desc">
                            Barang Terdaftar
                        </div>

                        <div class="stat-growth">
                            <i class="bi bi-box-seam"></i>
                            Tersedia
                        </div>

                    </div>

                    <div class="stat-icon icon-green">
                        <i class="fa-solid fa-box"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="list-card">

    <div class="category-list-header">

    <div>

        <h4 class="mb-1">
            <i class="fa-solid fa-table-list me-2"></i>
            Daftar Kategori
        </h4>

        <small class="text-secondary">
            Seluruh kategori barang warung yang tersedia
        </small>

    </div>

    <span class="badge bg-primary rounded-pill px-3 py-2">
        {{ $categories->count() }} Kategori
    </span>

</div>

    <div class="table-responsive">

        <table class="table category-table table-hover align-middle">

            <thead>

                <tr>
                    <th style="width:70px">No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th style="width:170px">Total Barang</th>
                </tr>

            </thead>

            <tbody>

                @forelse($categories as $category)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>

                        <div class="d-flex align-items-center">

                            <div class="category-icon me-3">

                                @switch(strtolower($category->nama))

                             @case('makanan')
                              <img src="{{ asset('image/categories/makanan.png') }}" alt="Makanan">
                             @break

                             @case('minuman')
                                <img src="{{ asset('image/categories/minuman.png') }}" alt="Minuman">
                              @break

                              @case('rokok')
                              <img src="{{ asset('image/categories/rokok.png') }}" alt="Rokok">
                              @break

                              @case('sembako')
                              <img src="{{ asset('image/categories/sembako.png') }}" alt="Sembako">
                              @break

                              @default
                              <img src="{{ asset('image/categories/default.png') }}" alt="Kategori">

                                 @endswitch

                            </div>

                            <div>

                                <div class="category-name">
                                    {{ $category->nama }}
                                </div>

                                <small style="color:#9ca3af;">
                                    Kategori Produk
                                    </small>

                            </div>

                        </div>

                    </td>

                    <td>

                        {{ $category->deskripsi ?: '-' }}

                    </td>

                    <td>

                        <span class="badge bg-primary rounded-pill px-3 py-2">
    {{ $category->products_count }} Barang
</span>

                    </td>

                </tr>

                @empty

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection