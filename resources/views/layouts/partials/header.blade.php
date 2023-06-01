<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">TNA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @auth
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ str_contains(Route::currentRouteName(), 'home')?'active':'' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    @can('viewAny', App\Models\User::class)
                        <li class="nav-item">
                            <a class="nav-link {{ str_contains(Route::currentRouteName(), 'users')?'active':'' }}" href="{{ route('users.index') }}">Users</a>
                        </li>
                    @endcan
                    <li class="nav-item">
                        <a class="nav-link {{ str_contains(Route::currentRouteName(), 'categories')?'active':'' }}" href="{{ route('categories.index') }}">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ str_contains(Route::currentRouteName(), 'products')?'active':'' }}" href="{{ route('products.index') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ str_contains(Route::currentRouteName(), 'orders')?'active':'' }}" href="{{ route('orders.index') }}">Order</a>
                    </li>
                    @can('viewAny', App\Models\Ship::class)
                        <li class="nav-item">
                            <a class="nav-link {{ str_contains(Route::currentRouteName(), 'ships')?'active':'' }}" href="{{ route('ships.index') }}">Shipping</a>
                        </li>
                    @endcan
                    @can('viewAny', App\Models\Payment::class)
                        <li class="nav-item">
                            <a class="nav-link {{ str_contains(Route::currentRouteName(), 'payments')?'active':'' }}" href="{{ route('payments.index') }}">Payment</a>
                        </li>
                    @endcan
                </ul>
            </div>
        @endauth

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('login') ? 'active' : '' }}"
                            href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('register') ? 'active' : '' }}"
                            href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('users.edit', ['user' => Auth::id()]) }}">Profile</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
