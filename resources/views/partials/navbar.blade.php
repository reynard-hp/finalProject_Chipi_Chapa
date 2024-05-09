<nav class="navbar navbar-expand-lg bg-primary navbar-dark px-3 fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Chipi Chapa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ $active === 'home' ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $active === 'list-item' ? 'active' : '' }}" href="/list-item">List
                        Barang</a>
                </li>
                @auth
                    @if (auth()->user()->role === 'user')
                        <li class="nav-item">
                            <a class="nav-link {{ $active === 'invoice' ? 'active' : '' }}" href="/invoice-form">Faktur</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $active === 'history' ? 'active' : '' }}" href="/history">History</a>
                        </li>
                    @endif
                @endauth
                @auth
                    @if (auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ $active === 'dashboard' ? 'active' : '' }}"
                                href="/dashboard">Dashboard</a>
                        </li>
                    @endif
                @endauth
            </ul>
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ $active === 'login' ? 'active' : '' }}" href="/login">
                            <i class="fa-solid fa-right-to-bracket"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
