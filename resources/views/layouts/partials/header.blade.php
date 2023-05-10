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
                    <a class="nav-link {{ str_contains(Route::currentRouteName(), 'home')?'active':'' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(Route::currentRouteName(), 'customer')?'active':'' }}" href="{{ route('customer.list') }}">Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(Route::currentRouteName(), 'product')?'active':'' }}" href="{{ route('product.list') }}">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(Route::currentRouteName(), 'order')?'active':'' }}" href="{{ route('order.list') }}">Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(Route::currentRouteName(), 'shipping')?'active':'' }}" href="{{ route('shipping.list') }}">Shipping</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(Route::currentRouteName(), 'payment')?'active':'' }}" href="{{ route('payment.list') }}">Payment</a>
                </li>
            </ul>

        </div>
    </div>
</nav>