@extends('layouts.default')

@section('contents')
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
                        <h5 class="card-title">Revenue</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary h2">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">$ 166666</h1>
                <div class="mb-0">
                    <!-- <span class="badge text-primary bg-primary bg-opacity-10"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                    <span class="text-muted">Since last week</span> -->
                </div>
            </div>
        </div>
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
                <h1 class="mt-1 mb-3">123 <small>Products</small></h1>
                <div class="mb-0">
                    <!-- <span class="badge text-primary bg-primary bg-opacity-10"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                    <span class="text-muted">Since last week</span> -->
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5 mt-3">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title mb-2">Statistical</h3>
                <canvas id="myChart" style="width:100%;"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
        const xValues = ['January', 'February', 'March', 'April', 'May', 'June'
            , 'July', 'August', 'September', 'October', 'November', 'December'];
        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                        label: "Order",
                        data: [2, 4, 3, 6, 3, 1, 8, 5, 3, 8, 5, 4],
                        backgroundColor: "rgba(255,0,0,1)",
                        borderColor: "rgba(255,0,0,0.3)",
                        fill: false
                    }, {
                        label: "Revenue",
                        data: [1, 2, 4, 3, 2, 5, 7, 2, 4, 4, 2, 1],
                        backgroundColor: "rgba(0,0,255,1)",
                        borderColor: "rgba(0,0,255,0.3)",
                        fill: false
                    }]
            },
            options: {
                legend: {display: true}
            }
        });
    </script>
@endsection
