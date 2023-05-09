<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">TNA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @yield('home')" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('customer')" href="{{ route('customer.list') }}">Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('product')" href="{{ route('product.list') }}">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('order')" href="{{ route('order.list') }}">Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('shipping')" href="{{ route('shipping.list') }}">Shipping</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('payment')" href="{{ route('payment.list') }}">Payment</a>
                </li>
            </ul>

        </div>
    </div>
</nav>