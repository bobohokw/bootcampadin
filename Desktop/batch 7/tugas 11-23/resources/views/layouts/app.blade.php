<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DinoMarket</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { background-color: #f8f9fa; display: flex; flex-direction: column; min-height: 100vh; }
        main { flex: 1; }
        .nav-link:hover { color: #ffc107 !important; }
        .badge-cart, .badge-wishlist { font-size: 0.6rem; padding: 0.25em 0.45em; top: -5px !important; right: -10px !important; }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm py-3">
        <div class="container">
            <div class="d-flex align-items-center">
                <a class="navbar-brand fw-bold me-4" href="/">🦖 DinoMarket</a>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white {{ Request::is('/') ? 'fw-bold border-bottom border-warning' : '' }}" href="/">Home</a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <a class="nav-link text-white ps-3 {{ Request::is('products*') ? 'fw-bold border-bottom border-warning' : '' }}" href="{{ route('products.list') }}">List Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white ps-3 {{ Request::is('categories*') ? 'fw-bold border-bottom border-warning' : '' }}" href="{{ route('categories.index') }}">List Kategori</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>

            {{-- SEARCH BAR --}}
            <form action="/" method="GET" class="d-flex mx-auto d-none d-md-flex" style="width: 30%;">
                <div class="input-group">
                    <input type="text" name="search" class="form-control border-0 shadow-sm" placeholder="Cari barang..." value="{{ request('search') }}">
                    <button class="btn btn-success shadow-sm" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>

            <div class="d-flex align-items-center justify-content-end">
                {{-- ✅ WISHLIST (HATI) --}}
                <a href="{{ route('wishlist.index') }}" class="text-white me-3 fs-5 position-relative">
                    <i class="fa-solid fa-heart {{ \App\Models\Wishlist::where('user_id', auth()->id())->exists() ? 'text-danger' : '' }}"></i>
                    @auth
                        @php $wishQty = \App\Models\Wishlist::where('user_id', auth()->id())->count(); @endphp
                        @if($wishQty > 0)
                            <span class="position-absolute translate-middle badge rounded-pill bg-warning text-dark badge-wishlist">
                                {{ $wishQty }}
                            </span>
                        @endif
                    @endauth
                </a>
                
                {{-- ✅ KERANJANG --}}
                <a href="{{ route('cart.index') }}" class="text-white me-4 fs-5 position-relative">
                    <i class="fas fa-shopping-cart"></i>
                    @auth
                        @php $totalQty = \App\Models\Cart::where('user_id', auth()->id())->sum('qty'); @endphp
                        @if($totalQty > 0)
                            <span class="position-absolute translate-middle badge rounded-pill bg-danger badge-cart">
                                {{ $totalQty }}
                            </span>
                        @endif
                    @endauth
                </a>
                
                @guest
                    <div class="d-flex border-start ps-3 gap-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm px-3 rounded-pill">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm px-3 rounded-pill">Daftar</a>
                    </div>
                @else
                    <div class="dropdown border-start ps-3">
                        <button class="btn btn-success btn-sm dropdown-toggle shadow-sm px-3 rounded-pill" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 rounded-3">
                            @if(Auth::user()->role == 'admin')
                                <li><h6 class="dropdown-header text-success fw-bold">ADMIN PANEL</h6></li>
                                <li><a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-line me-2 text-success"></i>Dashboard Admin</a></li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            <li><a class="dropdown-item py-2" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt me-2 text-muted"></i>Dashboard User</a></li>
                            <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="fas fa-user-cog me-2 text-muted"></i>Profil Saya</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger fw-bold border-0 bg-transparent w-100 text-start">
                                        <i class="fas fa-sign-out-alt me-2"></i>Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <main>@yield('content')</main>

    <footer class="bg-white py-4 mt-5 border-top text-center text-muted small">
        <p class="mb-1 fw-bold">🦖 DinoMarket</p>
        <p>&copy; 2026 DinoMarket Team - Tugas Pemrograman Web Laravel.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>