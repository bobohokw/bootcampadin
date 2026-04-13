<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 shadow-sm">
    <div class="container-fluid">
        {{-- Logo DinoMarket --}}
        <a class="navbar-brand fw-bold" href="/">🦕 DinoMarket</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            {{-- Form Pencarian (Tugas 16) --}}
            <form class="d-flex mx-auto my-2 my-lg-0" action="{{ route('product.index') }}" method="GET" style="width: 40%;">
                <input class="form-control me-2 rounded-pill" type="search" name="search" placeholder="Cari produk dino..." value="{{ request('search') }}">
                <button class="btn btn-success rounded-pill" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a href="{{ route('product.index') }}" class="nav-link">Katalog</a>
                </li>

                {{-- CEK APAKAH USER SUDAH LOGIN --}}
                @auth
                    <li class="nav-item">
                        <a href="{{ route('cart.index') }}" class="nav-link position-relative">
                            <i class="fas fa-shopping-cart"></i> Cart
                        </a>
                    </li>

                    {{-- MENU KHUSUS ADMIN (TUGAS 20) --}}
                    @if(Auth::user()->role == 'admin')
                        <li class="nav-item dropdown ms-lg-3">
                            <a class="nav-link dropdown-toggle btn btn-outline-warning text-warning px-3 rounded-pill shadow-sm" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-shield me-1"></i> Admin
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow mt-2">
                                <li><h6 class="dropdown-header">Manajemen Barang</h6></li>
                                <li><a class="dropdown-item" href="{{ route('products.create') }}"><i class="fas fa-plus-circle me-2"></i>Tambah Produk</a></li>
                                <li><a class="dropdown-item" href="{{ route('categories.create') }}"><i class="fas fa-tags me-2"></i>Tambah Kategori</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('products.list') }}"><i class="fas fa-list me-2"></i>Daftar Produk</a></li>
                                <li><a class="dropdown-item" href="{{ route('categories.index') }}"><i class="fas fa-folder me-2"></i>Daftar Kategori</a></li>
                            </ul>
                        </li>
                    @endif

                    {{-- Profil User & Logout --}}
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    {{-- JIKA BELUM LOGIN --}}
                    <li class="nav-item ms-lg-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-light rounded-pill px-4">Login</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-4">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>