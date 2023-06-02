@extends('layouts.default')

@section('contents')
    <div class="container mb-5 mt-3">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
            <div class="carousel-indicators">
                @foreach ($trendProducts as $index => $pro)
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $index }}"
                        class="{{ $index===0?'active':'' }}" aria-current="{{ $index===0?'true':'' }}" aria-label="Slide 1"></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach ($trendProducts as $index => $pro)
                    <div class="carousel-item {{ $index===0?'active':'' }}">
                        <img src="{{ asset('storage/imgs/products/' . $pro->id . '/' . $pro->image) }}"
                            class="d-block w-100" alt="{{ $pro->name }}">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $pro->name }}</h5>
                            <p class="text-truncate">{{ $pro->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="container mb-5 mt-3 d-flex justify-content-evenly">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Orders</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary h2">
                            <i class="bi bi-truck"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $orderNum }}</h1>
                <div class="mb-0">
                    <!-- <span class="badge text-primary bg-primary bg-opacity-10"> <i class="mdi mdi-arrow-bottom-right"></i> Orders </span>
                            <span class="text-muted">Since last week</span> -->
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">{{ Auth::user()->role_as === 1 ? 'Revenue' : 'Spending' }}</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary h2">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">${{ number_format($revenue, 2, '.', ',') }}</h1>
                <div class="mb-0">
                    <!-- <span class="badge text-primary bg-primary bg-opacity-10"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                            <span class="text-muted">Since last week</span> -->
                </div>
            </div>
        </div>
        @if (Auth::user()->role_as === 1)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Sales</h5>
                        </div>

                        <div class="col-auto">
                            <div class="stat text-primary h2">
                                <i class="bi bi-bag-check"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $products_paid }} <small>Products</small></h1>
                    <div class="mb-0">
                        <!-- <span class="badge text-primary bg-primary bg-opacity-10"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                                <span class="text-muted">Since last week</span> -->
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="container mb-5 mt-3">
        @if (Auth::user()->role_as === 1)
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-2">Statistical</h3>
                    <canvas id="orderChart" style="width:100%;"></canvas>
                    <canvas id="revenueChart" style="width:100%;"></canvas>
                </div>
            </div>
        @else
            <div class="row">
                <h2 class="text-center"><i class="fa-solid fa-fire fa-beat text-warning"></i>Trending Products</h2>
                <div class="d-flex flex-wrap">
                    @foreach ($trendProducts as $index => $pro)
                        @if ($index > 3)
                            @break
                        @endif
                        <div class="col-md-3 px-3 my-3">
                            <div class="card shadow">
                                <img src="{{ asset('storage/imgs/products/' . $pro->id . '/' . $pro->image) }}"
                                    class="card-img-top" alt="{{ $pro->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $pro->name }}</h5>
                                    <p class="card-text">{{ $pro->category->name }}</p>
                                    <p class="card-text">${{ number_format($pro->original_price, 2, '.', ',') }}</p>
                                    <a href="{{ route('orders.create') }}" class="btn btn-primary">Buy</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        <div class="row mt-5">
            <h2 class="text-center">New Products</h2>
            <div class="d-flex flex-wrap">
                @foreach ($newProducts as $index => $pro)
                    @if ($index > 3)
                    @break
                @endif
                <div class="col-md-3 px-3 my-3">
                    <div class="card shadow">
                        <img src="{{ asset('storage/imgs/products/' . $pro->id . '/' . $pro->image) }}"
                            class="card-img-top" alt="{{ $pro->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $pro->name }}</h5>
                            <p class="card-text">{{ $pro->category->name }}</p>
                            <p class="card-text">${{ number_format($pro->original_price, 2, '.', ',') }}</p>
                            <a href="{{ route('orders.create') }}" class="btn btn-primary">Buy</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
    const xValues = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
        'November', 'December'
    ];
    new Chart("orderChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                label: "Order",
                data: [
                    @foreach ($orderNums as $on)
                        {{ $on }},
                    @endforeach
                ],
                backgroundColor: "rgba(255,0,0,1)",
                borderColor: "rgba(255,0,0,0.3)",
                fill: false
            }]
        },
        options: {
            legend: {
                display: true
            },
            title: {
                display: true,
                text: 'Order Chart'
            }
        }
    });
    new Chart("revenueChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                label: "{{ Auth::user()->role_as === 1 ? 'Revenue' : 'Spending' }}",
                data: [
                    @foreach ($revenues as $r)
                        {{ $r }},
                    @endforeach
                ],
                backgroundColor: "rgba(0,0,255,1)",
                borderColor: "rgba(0,0,255,0.3)",
                fill: false
            }]
        },
        options: {
            legend: {
                display: true
            },
            title: {
                display: true,
                text: 'Revenue Chart',
            }
        }
    });
</script>
@endsection
