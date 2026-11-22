<nav class="navbar bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Monster Hunter</a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('monsterhunters.*') ? 'active' : '' }}"
                       href="{{ route('monsterhunters.index') }}">All Games</a>
                </li>
            </ul>
        </div>
        <div class="d-flex align-items-center gap-2">
            @guest
                <a class="btn btn-outline-light" href="{{ route('login') }}">Log in</a>
                <a class="btn btn-light" href="{{ route('register') }}">Register</a>
            @endguest

            @auth
                <span class="text-white">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">Log out</button>
                </form>
            @endauth
        </div>
    </div>
</nav>