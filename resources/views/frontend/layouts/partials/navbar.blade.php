<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
             <img src="{{ asset('frontend/images/loogo.jpeg') }}" alt="Perfumes for Men">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item dropdown" onmouseenter="this.querySelector('.dropdown-menu').classList.add('show')" onmouseleave="this.querySelector('.dropdown-menu').classList.remove('show')">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('shop') ? 'active' : '' }}" href="{{ route('shop') }}" id="shopDropdown" role="button" aria-expanded="false">
                        Shop <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="shopDropdown">
                        <li><a class="dropdown-item" href="{{ route('perfumes') }}">Perfumes</a></li>
                        <li><a class="dropdown-item" href="{{ route('attar') }}">Attar</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>
            <div class="navbar-icons">
                <a href="#" class="navbar-cart-link" title="View Cart">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-badge" id="cartBadge" style="display: none;">0</span>
                </a>
            </div>
        </div>
    </div>
</nav>
