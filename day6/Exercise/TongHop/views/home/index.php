<?php

use DataAccessLayer\OrderDAO;
use DataAccessLayer\OrderDetailDAO;

$page = 'home';
require '../components/header.php';
include '../../dal/OrderDAO.php';
include '../../dal/PaymentDAO.php';
include '../../dal/ShippingDAO.php';
include '../../dal/OrderDetailDAO.php';
include '../../dal/CustomerDAO.php';

$orders = OrderDAO::count($conn);
$revenue = OrderDAO::getAmountSum($conn) ?? 0;
$products = OrderDetailDAO::getQuantitySum($conn) ?? 0;
$stat = '';

for ($i=1; $i <= 12; $i++) { 
    $stat .= OrderDAO::getAmountSumInMonth($conn
            , date('Y-m-d H:i:s', mktime(0,0,0,$i, 1, date('Y')))
            , date('Y-m-d H:i:s', mktime(0,0,0,$i+1, 1, date('Y')))) ?? '0';
    $stat .= $i==12?'':',';            
    // echo date('Y-m-d H:i:s', mktime(0,0,0,$i, 1, date('Y'))) . ' - ';
    // echo date('Y-m-d H:i:s', mktime(0,0,0,$i+1, 1, date('Y'))) . '<br>';          
}

?>

<div class="container mb-5 mt-3 d-flex justify-content-evenly">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col mt-0">
                    <h5 class="card-title">Orders</h5>
                </div>

                <div class="col-auto">
                    <div class="stat text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <h1 class="mt-1 mb-3"><?php echo number_format($orders); ?></h1>
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
                    <div class="stat text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                        <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                        <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                        <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                    </svg>
                    </div>
                </div>
            </div>
            <h1 class="mt-1 mb-3">$ <?php echo number_format($revenue, 2); ?></h1>
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
                    <div class="stat text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                    </svg>
                    </div>
                </div>
            </div>
            <h1 class="mt-1 mb-3"><?php echo number_format($products); ?></h1>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
    const xValues = ['January', 'February', 'March', 'April', 'May', 'June'
        , 'July', 'August', 'September', 'October', 'November', 'December'];
    new Chart("myChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                    label: "Revenue",
                    data: [<?php echo $stat;?>],
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

<?php require '../components/footer.php'; ?>