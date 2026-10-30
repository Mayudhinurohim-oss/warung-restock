<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Restock Warung</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Notiflix -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notiflix@3/dist/notiflix-3.2.8.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3/dist/notiflix-3.2.8.min.js"></script>

    <style>
        body {
            min-height: 100vh;
            background-image:
                linear-gradient(135deg, rgba(9, 15, 28, .78), rgba(17, 24, 39, .68)),
                url('{{ asset('image/background.jpeg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .admin-shell{
    display:flex;
    min-height:100vh;
    width:100%;
}

        .admin-sidebar{
    width:280px;
    flex-shrink:0;
    min-height:100vh;

    display:flex;
    flex-direction:column;

    padding:22px 18px;

    color:#fff;

    background:rgba(30,32,38,.78);

    border-right:1px solid rgba(255,255,255,.12);

    backdrop-filter:blur(14px);
}

        .brand-box {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 10px 18px;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            background: rgba(255, 255, 255, .16);
            border: 1px solid rgba(255, 255, 255, .18);
            font-size: 26px;
        }

        .brand-title {
            margin: 0;
            font-size: 18px;
            font-weight: 800;
            line-height: 1.2;
        }

        .brand-subtitle {
            color: rgba(255, 255, 255, .62);
            font-size: 13px;
        }

        .sidebar-divider {
            margin: 14px 0;
            border-color: rgba(255, 255, 255, .14);
        }

        .sidebar-menu{
    display:grid;
    gap:12px;
}

        .sidebar-link,
        .logout-btn {
            position: relative;
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            min-height: 50px;
            padding: 13px 16px;
            color: rgba(255, 255, 255, .78);
            border: 1px solid transparent;
            border-radius: 18px;
            background: transparent;
            font-weight: 700;
            text-decoration: none;
            transition: transform .22s ease, box-shadow .22s ease, background .22s ease, color .22s ease, border-color .22s ease;
        }

        .sidebar-link i,
        .logout-btn i {
            width: 24px;
            color: rgba(255, 255, 255, .86);
            font-size: 20px;
            transition: transform .22s ease;
        }

        .sidebar-link:hover,
.logout-btn:hover{
    color:#fff;
    background:rgba(255,255,255,.08);
    border-color:rgba(255,255,255,.08);
    transform:translateX(5px);
}

        .sidebar-link:hover i,
        .logout-btn:hover i {
            transform: scale(1.18);
        }

        .sidebar-link:active,
        .logout-btn:active {
            transform: scale(.96);
            box-shadow: 0 8px 18px rgba(0, 0, 0, .18);
        }

        .sidebar-link.active{
    color:#fff;
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
    border:1px solid rgba(59,130,246,.4);
    box-shadow:
        0 0 25px rgba(37,99,235,.35),
        inset 0 1px 0 rgba(255,255,255,.15);
}

.sidebar-link.active i{
    color:#fff;
}

.sidebar-link.active::before{
    content:"";
    position:absolute;
    left:0;
    top:10px;
    bottom:10px;
    width:4px;
    background:#60a5fa;
    border-radius:0 5px 5px 0;
}

        .logout-btn {
            border: 0;
            text-align: left;
        }

        .logout-btn:hover {
            color: #fff;
        }

        .user-box {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: auto;
            padding: 14px;
            border-radius: 18px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .12);
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
            border-radius: 14px;
            color: #fff;
            background: rgba(13, 110, 253, .9);
            font-size: 20px;
        }

        .menu-title{
    color:#8b949e;
    font-size:12px;
    text-transform:uppercase;
    font-weight:600;
    letter-spacing:1px;
    margin:20px 15px 10px;
}

        .admin-main{
    flex:1;
    display:flex;
    flex-direction:column;
    min-width:0;
}

        .admin-navbar{
    display:none;
}

        .admin-navbar h4 {
            color: #fff;
            font-weight: 800;
            margin: 0;
        }

       .content-wrap{
    flex:1;
    padding:26px;
    overflow:auto;
}

.content-panel{
    display:contents;
}

        @media (max-width: 991.98px) {
.admin-shell{flex-direction:column;}
.admin-sidebar{width:100%;min-height:auto;padding:22px 18px;}
.sidebar-menu{grid-template-columns:repeat(2,minmax(0,1fr));}
.user-box{margin-top:16px;}
}
@media (max-width:575.98px){
.admin-sidebar,.content-wrap{padding:16px;}
.sidebar-menu{grid-template-columns:1fr;}
.admin-navbar{padding:0 18px;}
.admin-navbar h4{font-size:19px;}
.content-panel{padding:18px;}
}
</style>
</head>

<body>
    <div class="admin-shell d-flex">
        <aside class="admin-sidebar">
            <div class="brand-box">
                <div class="brand-icon">🏪</div>
                <div>
                    <h4 class="brand-title">Warung Restock</h4>
                    <div class="brand-subtitle">Sistem Restock Warung</div>
                </div>
            </div>

            <hr class="sidebar-divider">

            <nav class="sidebar-menu">
                <a href="{{ route('dashboard') }}"
                   class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('categories.index') }}"
                   class="sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i>
                    <span>Categories</span>
                </a>

                <a href="{{ route('products.index') }}"
   class="sidebar-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
    <i class="bi bi-box-seam"></i>
    <span>Produk</span>
</a>

                <a href="{{ route('suppliers.index') }}"
   class="sidebar-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
    <i class="bi bi-truck"></i>
    <span>Supplier</span>
</a>

            <div class="menu-title">
    Transaksi
</div>

<a href="{{ route('barang-masuk.index') }}"
   class="sidebar-link {{ request()->routeIs('barang-masuk.*') ? 'active' : '' }}">
    <i class="bi bi-box-arrow-in-down"></i>
    <span>Barang Masuk</span>
</a>

<a href="{{ route('barang-keluar.index') }}"
   class="sidebar-link {{ request()->routeIs('barang-keluar.*') ? 'active' : '' }}">
    <i class="bi bi-box-arrow-up"></i>
    <span>Barang Keluar</span>
</a>

            <hr class="sidebar-divider">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>

            <div class="user-box">
                <div class="user-avatar">
                    <i class="bi bi-person"></i>
                </div>
                <div class="min-w-0">
                    <div class="fw-bold text-white">{{ Auth::user()->name }}</div>
                    <div class="brand-subtitle">Admin</div>
                </div>
            </div>
        </aside>

        <main class="admin-main flex-grow-1">
            <nav class="admin-navbar">
            </nav>

            <div class="content-wrap">
    @yield('content')
</div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('scripts')
</body>
</html>
