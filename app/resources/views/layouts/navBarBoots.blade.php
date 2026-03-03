<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Prieto Eats</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav w-100 mb-2 mb-lg-0">
                @auth
                    {{-- menu ADMIN --}}
                    @if(Auth::user()->isAdmin())
                    <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">
                            Home
                            </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" aria-current="page" data-bs-toggle="dropdown" href="{{ route('admin.products.index') }}">
                            Productos
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="nav-link " aria-current="page"  href="{{ route('admin.products.index') }}">
                                    Listado Productos
                                </a>
                            </li>
                        </ul>

                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" aria-current="page" data-bs-toggle="dropdown" href="{{ route('admin.products.index') }}">
                            Ofertas
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="nav-link " aria-current="page"  href="{{ route('admin.offers.index') }}">
                                    Listado Ofertas
                                </a>
                            </li>
                        </ul>

                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">
                            Home
                            </a>
                        </li>
                        {{-- menu cliente --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('cart.orders') }}">Pedidos</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                <li class="nav-item ms-lg-auto">
                    <a class="nav-link" href="{{ route('cart.index') }}">Carrito</a>
                </li>
                @endauth


                @guest
                    <li class="nav-item ms-lg-auto">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">¡Regístrate!</a>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</nav>
