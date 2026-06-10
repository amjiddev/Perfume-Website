<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
             <img src="{{ asset('frontend/images/loogo.jpeg') }}" alt="Perfumes for Men">
        </a>
        
        <div class="navbar-right-section">
            <!-- Mobile Cart Icon - Show only on mobile -->
            <a href="#" class="navbar-cart-link navbar-cart-link-mobile" title="View Cart" onclick="openCartDrawer(event); return false;">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-badge" id="cartBadgeMobile" style="display: none;">0</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item dropdown" id="shopDropdown">
                    <div class="shop-dropdown-wrapper">
                        <a class="nav-link shop-text {{ request()->routeIs('shop') ? 'active' : '' }}" href="{{ route('shop') }}" role="button">
                            Shop
                        </a>
                        <a class="nav-link shop-dropdown-toggle" href="#" id="shopDropdownToggle" role="button" aria-expanded="false" onclick="toggleShopDropdown(event)">
                            <i class="fas fa-chevron-down"></i>
                        </a>
                    </div>
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
            <div class="navbar-icons navbar-icons-desktop">
                <a href="#" class="navbar-cart-link" title="View Cart" onclick="openCartDrawer(event); return false;">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-badge" id="cartBadge" style="display: none;">0</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    // Shop Dropdown Management
    const shopDropdown = document.getElementById('shopDropdown');
    const shopDropdownMenu = shopDropdown ? shopDropdown.querySelector('.dropdown-menu') : null;
    const shopDropdownToggle = shopDropdown ? shopDropdown.querySelector('.shop-dropdown-toggle') : null;
    
    function toggleShopDropdown(event) {
        event.preventDefault();
        event.stopPropagation();
        
        if (!shopDropdownMenu || !shopDropdownToggle) return;
        
        const isDesktop = window.innerWidth > 1024;
        
        // Only toggle on mobile/tablet
        if (!isDesktop) {
            const isOpen = shopDropdownMenu.classList.contains('show');
            
            if (isOpen) {
                shopDropdownMenu.classList.remove('show');
                shopDropdownToggle.classList.remove('active');
            } else {
                shopDropdownMenu.classList.add('show');
                shopDropdownToggle.classList.add('active');
            }
        }
    }
    
    // Desktop hover behavior
    if (shopDropdown) {
        shopDropdown.addEventListener('mouseenter', function() {
            if (window.innerWidth > 1024 && shopDropdownMenu) {
                shopDropdownMenu.classList.add('show');
            }
        });
        
        shopDropdown.addEventListener('mouseleave', function() {
            if (window.innerWidth > 1024 && shopDropdownMenu) {
                shopDropdownMenu.classList.remove('show');
            }
        });
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!shopDropdown) return;
        
        const isDesktop = window.innerWidth > 1024;
        
        // Only handle outside clicks on mobile/tablet
        if (!isDesktop && !shopDropdown.contains(event.target)) {
            if (shopDropdownMenu) shopDropdownMenu.classList.remove('show');
            if (shopDropdownToggle) shopDropdownToggle.classList.remove('active');
        }
    });
    
    // Prevent menu from closing when clicking menu items on mobile
    if (shopDropdownMenu) {
        shopDropdownMenu.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    }
</script>
