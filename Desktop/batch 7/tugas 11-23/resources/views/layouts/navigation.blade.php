<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm py-3">
    <div class="container">
        <div class="d-flex align-items-center">
            <a class="navbar-brand fw-bold me-4" href="{{ url('/') }}">🦖 DinoMarket</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white {{ Request::is('/') ? 'fw-bold border-bottom border-warning' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-white ps-3 {{ Request::is('dashboard') ? 'fw-bold border-bottom border-warning' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white ps-3 {{ Request::is('admin*') ? 'fw-bold border-bottom border-warning' : '' }}" href="{{ route('admin.dashboard') }}">Admin Panel</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>

        {{-- SEARCH BAR --}}
        <form action="{{ url('/') }}" method="GET" class="d-flex mx-auto d-none d-md-flex" style="width: 30%;">
            <div class="input-group">
                <input type="text" name="search" class="form-control border-0 shadow-sm" placeholder="Cari barang..." value="{{ request('search') }}">
                <button class="btn btn-success shadow-sm" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>

        <div class="d-flex align-items-center justify-content-end">
            @auth
                {{-- ✅ ICON WISHLIST (HATI) --}}
                <a href="{{ route('wishlist.index') }}" class="text-white me-3 fs-5 position-relative">
                    <i class="fa-solid fa-heart {{ \App\Models\Wishlist::where('user_id', Auth::id())->exists() ? 'text-danger' : '' }}"></i>
                    @php $wishCount = \App\Models\Wishlist::where('user_id', Auth::id())->count(); @endphp
                    @if($wishCount > 0)
                        <span class="position-absolute translate-middle badge rounded-pill bg-warning text-dark" style="font-size: 0.6rem; top: -5px; right: -10px;">
                            {{ $wishCount }}
                        </span>
                    @endif
                </a>
                
                {{-- ✅ ICON KERANJANG --}}
                <a href="{{ route('cart.index') }}" class="text-white me-4 fs-5 position-relative">
                    <i class="fas fa-shopping-cart"></i>
                    @php $cartCount = \App\Models\Cart::where('user_id', Auth::id())->count(); @endphp
                    @if($cartCount > 0)
                        <span class="position-absolute translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem; top: -5px; right: -10px;">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                {{-- USER DROPDOWN --}}
                <div class="dropdown border-start ps-3">
                    <button class="btn btn-success btn-sm dropdown-toggle shadow-sm px-3 rounded-pill" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 rounded-3">
                        <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="fas fa-user-cog me-2 text-muted"></i>Profil Saya</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('wishlist.index') }}"><i class="fas fa-heart me-2 text-muted"></i>Wishlist Saya</a></li>
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
            @else
                {{-- ✅ TOMBOL LOGIN & DAFTAR (Muncul jika belum login) --}}
                <div class="d-flex border-start ps-3 gap-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm px-3 rounded-pill">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm px-3 rounded-pill">Daftar</a>
                </div>
            @endauth
        </div>
    </div>
</nav>