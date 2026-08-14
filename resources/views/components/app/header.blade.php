<header class="header">
    <div class="header-inner">
        <div class="header-brand-row">
            <a href="/" class="logo">Cook helper</a>
        </div>

        <input type="checkbox" id="mobile-menu-toggle" class="header-menu-checkbox" hidden>
        <label class="header-menu-toggle" for="mobile-menu-toggle" aria-label="Open navigation menu">
            <span></span>
            <span></span>
            <span></span>
        </label>

        <nav class="header-nav" aria-label="Primary navigation">
            <a href="/recipes" class="header-link">Recepten</a>
            <a href="/planning" class="header-link">Planning</a>
            <a href="/ingredients" class="header-link">Ingrediënten</a>
            <a href="/about" class="header-link">About</a>
        </nav>

        <div class="header-actions">
            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="header-link header-button">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="header-link">Login</a>
                <a href="{{ route('register') }}" class="header-link header-button">Register</a>
            @endauth
        </div>
    </div>
</header>
