<header class="header flex justify-between p-4">
  <div class="flex items-center">
    <div class="flex items-center space-x-4 mr-18">
        <a href="/" class="logo">Cook helper</a>
    </div>
    <nav class="flex items-center space-x-4 header-nav">
        <a href="/recipes">Recepten</a>
        <a href="/planning">Planning</a>
        <a href="/ingredients">Ingrediënten</a>
        <a href="/about">About</a>
    </nav>
  </div>
  <div>
    @auth
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="header-link">Logout</button>
        </form>
    @else
        <a href="{{ route('login') }}" class="header-link">Login</a>
        <a href="{{ route('register') }}" class="header-link">Register</a>
    @endauth
</header>
